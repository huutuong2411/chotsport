<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Banner;
use App\Models\admin\Brand;
use App\Models\User\Order;
use App\Models\User\Order_detail;
use App\Models\admin\Product;
use App\Models\admin\Product_detail;
use App\Models\admin\Blog;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banner= Banner::join('brand', 'id_brand', '=', 'brand.id')
        ->select('banner.*','brand.name as brand_name')->get();
       
        $newProducts = Product::limit(16)->orderBy('created_at', 'DESC')->get();

        $adidasProducts = Brand::withCount('Product')
                        ->where('name', 'Adidas')
                        ->get();
        
        $nikeProducts = Brand::withCount('Product')
                        ->where('name', 'Nike')
                        ->get();      
        $pumaProducts = Brand::withCount('Product')
                        ->where('name', 'Puma')
                        ->get();    
        $mizunoProducts = Brand::withCount('Product')
                        ->where('name', 'Mizuno')
                        ->get();
        $bestseller = Product::join('product_details', 'products.id', '=', 'product_details.id_product')
                        ->leftjoin('order_details', 'order_details.id_product_detail', '=', 'product_details.id')
                        ->groupBy('products.id')
                        ->orderByRaw('SUM(order_details.qty) DESC')
                        ->limit(12)
                        ->get();

        $blog = Blog::select('id','image','title','description','updated_at')->take(5)->orderBy('created_at', 'DESC')->get();
        return view ('User.home.home',compact('banner','newProducts','bestseller','adidasProducts','nikeProducts','pumaProducts','mizunoProducts','blog'));
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
    public function store(Request $request)
    {
        //
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
