<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User\Order;
use App\Models\User\Order_detail;
use App\Models\admin\Product;
use App\Models\admin\Product_detail;
use Illuminate\Support\Facades\Auth;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $order=Order::where('id_user',Auth::user()->id)->orderBy('id', 'desc')->get();
       
        return view ('User.order.myorder',compact('order'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
            
        $order = Order::find($id);

        $province=$order->address->ward->district->city->name;
        $district=$order->address->ward->district->name;
        $ward=$order->address->ward->name;
        $address=$order->address->address;
        $full_address= $address.', '.$ward.', '.$district.', '.$province;
   
        $orderDetail= Order_detail::where('id_order',$id)
            ->join('product_details', 'order_details.id_product_detail', '=', 'product_details.id')
            ->join('products', 'product_details.id_product', '=', 'products.id')
            ->join('size', 'product_details.id_size', '=', 'size.id')
            ->select('order_details.*','products.id as id_product','products.name as product_name','products.image as image','size.size as size_name')
            ->get();
        
        return view('User.order.show',compact('order','orderDetail','full_address'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function cancel(string $id)
    {
     
        $Order_detail=Order_detail::where('id_order',$id)->get();
        $thisOrder= Order::find($id); //gọi order
        $thisOrder->status=3; //gán status
        $thisOrder->save();  //lưu lại order

        if($thisOrder->update()){
            foreach($Order_detail as $value){
                $order_qty = $value->qty; //tìm số lượng của chi tiết đơn hàng
                $check_product_detail=Product_detail::withTrashed()->find($value->id_product_detail);
                // nếu id_product_detail đó đã bị xoá trước đó thì khôi phục rồi tăng số lượng
                $check_product_detail->restore();
                $check_product_detail->increment('size_qty', $order_qty); // tăng size_qty lên $quantity

                // Cập nhật số lượng trong bảng product
                $totalQty = Product_detail::where('id_product', $check_product_detail->id_product)->sum('size_qty');
                $product = Product::find($check_product_detail->id_product);
                $product->total_qty = $totalQty;
                $product->save();
            }
            return redirect()->route('user.order')->with('success',__('Huỷ đơn hàng thành công'));
        }else{
            return redirect()->route('user.order')->withErrors('Có lỗi xảy ra, vui lòng thử lại');
        }
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
