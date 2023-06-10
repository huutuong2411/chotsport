<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Product;
use App\Models\Admin\Category;
use App\Models\Admin\Product_detail;
use Illuminate\Support\Facades\Auth;
use App\Models\User\Order;
use App\Models\User\Rating;
use Illuminate\Support\Facades\DB;
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
       
        $allproduct=  Product::query();
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
                                ->leftjoin('product_details', 'products.id', '=', 'product_details.id_product')
                                ->leftjoin('order_details', 'order_details.id_product_detail', '=', 'product_details.id')
                                ->select('products.*')
                                ->groupBy('products.id')
                                ->orderByRaw('SUM(order_details.qty) DESC');
                        break;
                    case 'newest':
                    $allproduct= $allproduct->orderBy('created_at', 'DESC'); 
                        break;
                    case 'oldest':
                    $allproduct= $allproduct->orderBy('created_at', 'ASC');
                        break;
                    case 'price-ascending':
                    $allproduct= $allproduct->orderBy('price', 'ASC');
                        break;
                    case 'price-descending':
                    $allproduct=$allproduct->orderBy('price', 'DESC');
                        break;
                    case 'sale':
                    $allproduct=$allproduct->orderBy('discount', 'DESC');
                        break;
                        case 'best-rating':
                    $allproduct = $allproduct
                    ->leftJoin('rating', 'rating.id_product', '=', 'products.id')
                    ->select('products.*')
                    ->groupBy('products.id')
                    ->orderBy(DB::raw('AVG(rating.star)'), 'DESC');
                            break;
                }
        }
        if($request->category){
               $allproduct=$allproduct->where('id_category',$request->category);
        }
        if($request->brand){
               $allproduct=$allproduct->where('id_brand',$request->brand);
        }
        if (!$request->hasAny(['price', 'sortby', 'category', 'brand'])) {
            $allproduct->orderBy('created_at', 'DESC');
        }
        
        $allproduct = $allproduct->paginate(12);

        return view ('User.product.allproduct',compact('allproduct','minprice','maxprice'));
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
       
        $feedback = Product::where('products.id', $id)
                ->join('rating', 'products.id', '=', 'rating.id_product')
                ->join('users', 'users.id', '=', 'rating.id_user')
                ->select('users.id as id_user','products.id','rating.id_order','rating.star','users.name as user_name','users.avatar as user_avatar')->groupBy('rating.id_order')
                ->get();

        $relateproduct= Product::orderByRaw('id_category = ' . $product->id_category . ' desc')->limit(12)->get();  

        return view('User.product.productdetail',compact('product','listsize','feedback','relateproduct'));
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
