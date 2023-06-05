<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User\Order;
use App\Models\User\Order_detail;
use App\Models\admin\Product_detail;
use App\Models\admin\Product;
class AdminOrderController extends Controller
{
   	public function index()
    {
    	$order = Order::orderBy('created_at', 'desc')->get();
 
        return view('Admin.order.order',compact('order'));
    }

    public function changeorder(Request $request, string $id)
    {
        $order=Order::find($id);
        $order->status= $request->status;

        if($request->status==3){
            $Order_detail=Order_detail::where('id_order',$id)->get();
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
            
        }

        if($order->update()){
            return redirect()->back()->with('success',__('Thay đổi trạng thái đơn hàng thành công'));    
        } else {
            return redirect()->back()->withErrors('Thay đổi trạng thái đơn hàng không thành công');
        }

        
    }

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
        return response()->json(['order'=>$order,'orderDetail'=>$orderDetail,'full_address'=>$full_address]);
        
    }
}
