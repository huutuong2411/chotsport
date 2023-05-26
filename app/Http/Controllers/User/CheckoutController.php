<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\admin\Product_detail;
use App\Models\User\Order_detail;
use App\Models\User\Order;
use App\Models\City;
use App\Models\Address;
use Session;
use App\Mail\SendEmail;
use App\Utilities\VNpay;
use Mail;
class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    

    public function index()
    {
        $cart=Session::get('cart');
        $overQty= false;
        $id_overQty = [];
        foreach($cart as $key => $value){
            if($value['cartQty'] > Product_detail::find($key)->size_qty){
               $overQty= true; 
               $id_overQty[]=[
                'id_product_detail'=>$key,
                'realQty'=>Product_detail::find($key)->size_qty
               ]; 
            }
        }
        if($overQty){
            return view ('user.checkout.checkoutError',compact('id_overQty'));
        }else{
            $idAddress= Auth::user()->address;
            $full_address="";
            if($idAddress){
                $province=$idAddress->ward->district->city->name;
                $district=$idAddress->ward->district->name;
                $ward=$idAddress->ward->name;
                $address=$idAddress->address;
                $full_address= $address.', '.$ward.', '.$district.', '.$province;
            }
            $city=City::all();
            return view ('user.checkout.checkout',compact('full_address','city'));
        }
        
    }

    /**
     * Show the form for creating a new resource.
     */
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // xử lý trả về Ajax
        if(!empty($request->id_city)){
        $district= City::find($request->id_city)->district;
        return response()->json($district);
        }
        if(!empty($request->id_district)){
        $ward= District::find($request->id_district)->ward;
        return response()->json($ward);
        }
       
        // gọi cart và tính tổng qty
        $cart=Session::get('cart');
        $sum_money = 0;
        foreach ($cart as $item) {
            $sum_money += $item['cartQty']*$item['cartPrice'];
        }
       
        if($request->has('payment_method')){
            if($request->payment_method=='postpay'){
                $paymentstatus=0;
            }elseif($request->payment_method=='prepay'){
                 $paymentstatus=1;
            }
        }
        // xử lý địa chỉ
        // nếu đã có địa chỉ từ trước:
        if($request->has('full_address') && empty($request->chitiet)){
            $id_address = Auth::user()->id_address;
        }elseif(!empty($request->ward)){
                // check xem nếu trùng xã trùng địa chỉ thì thôi không tạo bảng address
                    $address = Address::updateOrCreate(
                        ['id_ward' => $request->ward, 'address' => $request->chitiet],
                        ['id_ward' => $request->ward, 'address' => $request->chitiet]
                    );
                    $id_address = $address->id;
        }   
        $error = false; // biến kiểm tra lỗi
        // xử lý thêm bảng order và odder_detail
        $newOrder= Order::create([
            'id_user' => Auth::user()->id,
            'id_address' => $id_address,
            'name' => $request->name,
            'email' => $request->email,
            'note' => $request->note,
            'phone' => $request->phone,
            'sum_money' => $sum_money,
            'status' => 0,
            'payment_status'=>$paymentstatus,
        ]);

        if($newOrder)
        {
            $newOrder->order_code = '#'.Str::random(4).$newOrder->id;
            $newOrder->save();
                    // xử lý lưu vào data để gửi email:
                    // lấy địa chỉ cụ thể:
            $province=$newOrder->address->ward->district->city->name;
            $district=$newOrder->address->ward->district->name;
            $ward=$newOrder->address->ward->name;
            $address=$newOrder->address->address;
            $full_address= $address.', '.$ward.', '.$district.', '.$province;

            $data =[]; //chứa thông tin email
            
            $data=[
                'name'=> $newOrder->name,
                'email'=>$newOrder->email,
                'order_code'=>$newOrder->order_code,
                'phone'=>$newOrder->phone,
                'sum_money' =>$newOrder->sum_money,
                'payment_status'=>$newOrder->payment_status,
                'address'=>$full_address,
            ];

            session(['data' => $data]);

            foreach ($cart as $item) 
            {
                $thisProductDetail = Product_detail::find($item['id_product_detail']);

                if (!$thisProductDetail || $thisProductDetail->size_qty < $item['cartQty']) {
                    return redirect()->back()->withErrors('Tồn kho không đủ số lượng, vui lòng cập nhật lại giỏ hàng');
                } else {
                            $thisProductDetail->decrement('size_qty', $item['cartQty']); //giảm số lượng của product_detail
                            
                            if ($thisProductDetail->size_qty === 0) {
                                $thisProductDetail->delete();
                            }
                        }
                        
                        $newOrder_detail = Order_detail::create([
                            'id_order' => $newOrder->id,
                            'id_product_detail' => $item['id_product_detail'],
                            'price' => $item['cartPrice'],
                            'qty' => $item['cartQty'],
                            'sum_money' => $item['cartQty'] * $item['cartPrice'],
                        ]);
                        if (!$newOrder_detail) {
                            $error = true;
                        }
                    }
                }else{
                 $error = true; 
        }
        if($paymentstatus==1){ //Nếu thanh toán online
            // Lấy URL thanh toán VNPAY
            $data_url= VNPAY::vnpay_create_payment([
                'vnp_TxnRef'=>$newOrder->id, //Mã đơn hàng
                'vnp_OrderInfo'=> 'Thanh toán đơn hàng', //Mô tả hoá đơn
                'vnp_Amount'=> $sum_money // Tổng tiền thanh toán
            ]);
            return redirect()->to($data_url);
        }
        if($error==false){
            //Gửi email 
            $data['subject']='Xác nhận đơn hàng';
            $this->sendEmail($this->data);
            $request->session()->forget('cart');
            return redirect()->route('user.order')->with('success',__('Tạo đơn hàng thành công'));
        }else{
            return redirect()->back()->withErrors('Có lỗi tạo đơn hàng, vui lòng thử lại');
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function vnPayCheck(Request $request)
    {
        //lấy data từ URL(do VNPay gửi về qua $vnp_Returnurl)
        $vnp_ResponseCode=$request->get('vnp_ResponseCode'); //mã phản hồi kết quả. 00= thành công;
        $vnp_TxnRef=$request->get('vnp_TxnRef'); //mã đơn hàng 
        $vnp_Amount=$request->get('vnp_Amount'); //số tiền thanh toán 
        // kiểm tra kết quả giao dịch:
        if($vnp_ResponseCode==00){ //nếu thành công
            //gửi email: 
            $data=Session::get('data');
            $data['subject']='Xác nhận đơn hàng';
             Session::put('data',$data);
            $this->sendEmail($data);
            $request->session()->forget('cart');
            return redirect()->route('user.order')->with('success',__('Tạo đơn hàng thành công'));
        }else{
            return redirect()->route('user.checkout')->withErrors('Có lỗi tạo đơn hàng, vui lòng thử lại');
        }
    }


     private function sendEmail($data)
    {
        Mail::to($data['email'])->send(new SendEmail($data));
    }
}
