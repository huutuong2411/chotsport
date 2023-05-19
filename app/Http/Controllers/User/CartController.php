<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function checkcart()
    {
       dd(session()->all());
       //Session::flush('cart'); // lệnh này để xoá hết cart
    }

    public function index()
    {
       if(!empty(session()->get('cart'))) 
        {
            return view ('User.cart.cart');
        }else {
            return view ('User.cart.emptycart');
        }
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
    public function addcart(Request $request)
    {
        $id_product_detail = $request->product_detail;
        $cart=Session::get('cart');
        if(isset($cart[$id_product_detail])){
            $cart[$request->product_detail]['cartQty']+=$request->qty;
        } else {
        $cart[$request->product_detail] = array(
            'id_product_detail'=>$id_product_detail,
            'Name_product'=>$request->name_product,
            'Sizename'=>$request->sizename,
            'cartPrice'=>$request->price,
            'cartQty'=>$request->qty,
            'cartImg'=>$request->imgsrc,
        );
        }
        Session::put('cart',$cart);
        $totalQty = 0;
        foreach ($cart as $item) {
            $totalQty += $item['cartQty'];
        }
        
        return response()->json(['count'=>$totalQty,'success'=>'Thêm vào giỏ hàng thành công!']);
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
    public function updatecart(Request $request)
    {
        $cart=session()->get('cart'); 
        if($request->has(['id_cartChange','newQty'])) {
            if(isset($cart[$request->id_cartChange]))
            {
                $cart[$request->id_cartChange]['cartQty']=$request->newQty;
            }
        }
        if($request->has('id_cartDelete')) {
            if(isset($cart[$request->id_cartDelete]))
            {
                unset($cart[$request->id_cartDelete]);
            }
        }
        Session::put('cart',$cart);
        $totalQty = 0;
        foreach ($cart as $item) {
            $totalQty += $item['cartQty'];
        }
        return response()->json($totalQty);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
