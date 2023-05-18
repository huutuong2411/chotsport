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
    }

    public function index()
    {
       return view ('User.cart.cart');
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
       //Session::flush('cart'); // lệnh này để xoá hết cart
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
        $cartQty=Session::get('cartQty');
        $totalQty = 0;
        foreach ($cart as $item) {
            $totalQty += $item['cartQty'];
        }
        Session::put('cartQty',$totalQty);
        
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
