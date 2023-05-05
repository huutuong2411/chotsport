<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Product;
use App\Models\admin\Product_detail;
use App\Models\admin\Category;
use App\Models\admin\Brand;
use App\Models\admin\Size;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view ('admin.product.product');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {    
        $brand=Brand::select('id','name')->get();

        $category=Category::select('id','name')->get();
       
        return view ('admin.product.addProduct',compact('brand','category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if(!empty($request->id_brand)) {
        $size= Brand::find($request->id_brand)->Size;
        return response()->json($size);
        }
        dd($request);
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
