<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Product;
use App\Models\admin\Category;
use App\Models\admin\Product_detail;
class UserProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        //lấy giá min max
        $minprice= Product::min('price');
        $maxprice= Product::max('price')+1000000;
       
        $allproduct= Product::orderBy('created_at','DESC');
        if($request->price){
            $price_from=explode(" - ",$request->price,2)[0];
            $price_from=str_replace([',', 'đ'], '', $price_from);
            
            $price_to=explode(" - ",$request->price,2)[1];
            $price_to=str_replace([',', 'đ'], '', $price_to);

            $allproduct=$allproduct->whereBetween('price',[$price_from,$price_to]);
        }
        if($request->sortby){
                switch ($request->sortby) {
                    case 'bestseller':
                    $allproduct= $allproduct
                                ->join('product_details', 'products.id', '=', 'product_details.id_product')
                                ->join('order_details', 'order_details.id_product_detail', '=', 'product_details.id')
                                ->select('products.*')
                                ->groupBy('products.id')
                                ->reorder('products.created_at', 'DESC');
                        break;
                    case 'newest':
                    $allproduct= $allproduct->reorder('created_at', 'DESC'); 
                        break;
                    case 'oldest':
                    $allproduct= $allproduct->reorder('created_at', 'ASC');
                        break;
                    case 'price-ascending':
                    $allproduct= $allproduct->reorder('price', 'ASC');
                        break;
                    case 'price-descending':
                    $allproduct=$allproduct->reorder('price', 'DESC');
                        break;
                    case 'sale':
                    $allproduct=$allproduct->where('discount','!=',0);
                        break;
                }
        }
        if($request->category){
               $allproduct=$allproduct->where('id_category',$request->category);
        }
        if($request->brand){
               $allproduct=$allproduct->where('id_brand',$request->brand);
        }
        $allproduct = $allproduct->paginate(12);

        return view ('user.product.allproduct',compact('allproduct','minprice','maxprice'));
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
