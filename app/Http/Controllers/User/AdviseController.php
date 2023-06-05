<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Size;
use App\Models\admin\Brand;
class AdviseController extends Controller
{
    public function AdviseSize(Request $request)
    {
    	if($request->has('length')&&$request->has('width')){
    		$shoelength = $request->isChecked=='true'? ($request->length + 0.5) : ($request->length + 1);
    		$check=$request->isChecked;
    		$footlength = $request->isChecked=='true'? $request->length - 0.5 : $request->length;
    		$ratio= $footlength/$request->width;
    		$brand= Brand::all();
    		$truesize=[];
    		foreach ($brand as $value) {
    			$size = Size::join('brand', 'size.id_brand', '=', 'brand.id')
	            ->select('brand.name as brand', 'size.size as size')
	            ->where('size.id_brand', $value->id)
	            ->orderByRaw('ABS(size.length - ?)', [$shoelength])
	            ->first();
	            $truesize[]=$size;
    		}
    		if ($ratio >= 2.71) {
				    $form = "Thon";
				} elseif ($ratio >= 2.6) {
				    $form = "Vừa";
				} elseif ($ratio >= 2.5) {
				    $form = "Bè";
				} elseif ($ratio >= 2.37) {
				    $form = "Bè nhiều";
				} else {
				    $form = "Siêu bè";
				}
			return response()->json(['truesize'=>$truesize,'form'=>$form]);

    	}
        // $id_product_detail = $request->product_detail;
        // $cart=Session::get('cart');
        // if(isset($cart[$id_product_detail])){
        //     $cart[$request->product_detail]['cartQty']+=$request->qty;
        // } else {
        // $cart[$request->product_detail] = array(
        //     'id_product_detail'=>$id_product_detail,
        //     'id_product'=>$request->id_product,
        //     'Name_product'=>$request->name_product,
        //     'Sizename'=>$request->sizename,
        //     'cartPrice'=>$request->price,
        //     'cartQty'=>$request->qty,
        //     'cartImg'=>$request->imgsrc,
        // );
        // }
        // Session::put('cart',$cart);
        // $totalQty = 0;
        // foreach ($cart as $item) {
        //     $totalQty += $item['cartQty'];
        // }
        
        // return response()->json($request->length);
        
    }
}
