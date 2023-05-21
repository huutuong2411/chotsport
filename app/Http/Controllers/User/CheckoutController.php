<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\admin\Product_detail;
use App\Models\User\Order_detail;
use App\Models\User\Order;
use App\Models\City;
use App\Models\Address;
use Session;
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
    public function create()
    {
       
    }

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
        $newOrder= Order::create([
                'id_user' => Auth::user()->id,
                'id_address' => $id_address,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'sum_money' => $sum_money,
                'status' => 0,
                'payment_status'=>$paymentstatus,
            ]);
        if($newOrder)
        {
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
        if($error==false){
            $request->session()->forget('cart');
        }else{
            return redirect()->back()->withErrors('Có lỗi tạo đơn hàng, vui lòng thử lại');
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
