<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Product;
use App\Models\admin\Product_detail;
class UserProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $allproduct= Product::orderBy('created_at','DESC');

        if($request->sortby){
                switch ($request->sortby) {
                    case 'bestseller':
                    $allproduct= Product::join('product_details', 'products.id', '=', 'product_details.id_product')
                            ->join('order_details', 'order_details.id_product_detail', '=', 'product_details.id')
                            ->select('products.*')
                            ->groupBy('products.id')
                            ->orderBy('products.created_at', 'DESC');
                        break;
                    case 'newest':
                    $allproduct= Product::orderBy('created_at', 'DESC');
                        break;
                    case 'oldest':
                    $allproduct= Product::orderBy('created_at', 'ASC');
                        break;
                    case 'price-ascending':
                    $allproduct= Product::orderBy('price', 'ASC');
                        break;
                    case 'price-descending':
                    $allproduct= Product::orderBy('price', 'DESC');
                        break;
                }
        }
        $allproduct = $allproduct->paginate(12);
        return view ('user.product.allproduct',compact('allproduct'));
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
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);
        
        $category= $product->Category->name;
        $listsize=   Product_detail::where('id_product', $id)->join('size', 'id_size', '=', 'size.id')
        ->select('product_details.id','size.size')->orderBy('size.length','ASC')
        ->get();
       
        return view('User.product.productdetail',compact('product','listsize'));
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
