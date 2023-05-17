<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Banner;
use App\Models\admin\Product;
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
        $newProducts = Product::take(16)->orderBy('created_at', 'DESC')->get();

        $adidasProducts = Product::join('brand', 'products.id_brand', '=', 'brand.id')
                            ->where('brand.name', 'Adidas')
                            ->select('brand.id as id_brand', DB::raw('count(*) as total'))
                            ->groupBy('brand.id', 'brand.name')
                            ->get();
        $nikeProducts = Product::join('brand', 'products.id_brand', '=', 'brand.id')
                            ->where('brand.name', 'Nike')
                            ->select('brand.id as id_brand', DB::raw('count(*) as total'))
                            ->groupBy('brand.id', 'brand.name')
                            ->get();               
        $pumaProducts = Product::join('brand', 'products.id_brand', '=', 'brand.id')
                            ->where('brand.name', 'Puma')
                            ->select('brand.id as id_brand', DB::raw('count(*) as total'))
                            ->groupBy('brand.id', 'brand.name')
                            ->get();      
        $mizunoProducts = Product::join('brand', 'products.id_brand', '=', 'brand.id')
                            ->where('brand.name', 'Mizuno')
                            ->select('brand.id as id_brand', DB::raw('count(*) as total'))
                            ->groupBy('brand.id', 'brand.name')
                            ->get();                               
        $blog = Blog::select('id','image','title','description','updated_at')->take(5)->orderBy('created_at', 'DESC')->get();
        return view ('User.home.home',compact('banner','newProducts','adidasProducts','nikeProducts','pumaProducts','mizunoProducts','blog'));
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
