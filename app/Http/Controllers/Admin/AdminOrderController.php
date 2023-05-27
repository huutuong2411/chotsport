<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User\Order;
use App\Models\User\Order_detail;
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
        if($order->update()){
            return redirect()->route('admin.order')->with('success',__('Thay đổi trạng thái đơn hàng thành công'));    
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
        
        return view('admin.order.order_detail',compact('order','orderDetail','full_address'));
    }
}
