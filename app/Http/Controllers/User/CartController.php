<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Product_detail;
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
            'id_product'=>$request->id_product,
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

    // Hàm giảm số lượng nếu vượt tồn kho ở errorCheckout
    public function reducecart(string $id)
    {
        $realQty = Product_detail::find($id)->size_qty;
        $cart=Session::get('cart');
        $cart[$id]['cartQty']=$realQty;
        Session::put('cart',$cart);
        return redirect()->route('user.cart');
    }
    // Hàm xoá sản phẩm khỏi cart ở errorCheckout
    public function deletecart(string $id)
    {
        $cart=Session::get('cart');
        unset($cart[$id]);
        Session::put('cart',$cart);
        return redirect()->route('user.cart');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
