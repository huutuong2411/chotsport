<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User\Rating;
use App\Models\User\Comment;
use Illuminate\Support\Facades\Auth;
use App\Models\user\Order_detail;
class FeedbackController extends Controller
{
	public function show(string $id)
    {
        
        $Product= Order_detail::where('id_order',$id)
            ->join('product_details', 'order_details.id_product_detail', '=', 'product_details.id')
            ->join('products', 'product_details.id_product', '=', 'products.id')
            ->select('products.*','order_details.price as orderprice')->groupBy('products.id')
            ->get();
        $id_order=$id;
        return view('User.feedback.feedback',compact('Product','id_order'));
    }




    public function store(Request $request, string $id)
    {
        $id_user= Auth::user()->id;
        foreach ($request->all() as $index => $value) {
        	if (strpos($index,"product_rating") === 0) {
        		$id_product = str_replace('product_rating', '', $index);
        		$rating= Rating::create([
	            'id_user' => $id_user,
                'id_order' => $id,
	            'id_product' => $id_product,
	            'star'=>$value
	        	]);
        	}
        	if (strpos($index,"product_comment") === 0) {
        		$id_product = str_replace('product_comment','', $index);
        		$comment= Comment::create([
	            'id_user' => $id_user,
                'id_order' => $id,
	            'id_product' => $id_product,
	            'message'=>$value
	        	]);
        	}
       	}
       	return redirect()->route('user.order')->with('success',__('Đánh giá sản phẩm thành công'));
    }
}
