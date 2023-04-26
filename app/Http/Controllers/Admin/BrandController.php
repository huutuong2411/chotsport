<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Brand;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brand=Brand::all();
        return view('Admin.brand',compact('brand'));
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
        $brand = new Brand();
        $brand->name= $request->brand ;
        if($brand->save()){
            return redirect()->back()->with('success',__('Thêm nhãn hàng thành công')); 
        } else {
            return redirect()->back()->withErrors('Thêm nhãn hàng không thành công');
        }

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
        $brand = Brand::find($id);
        $brand->name= $request->new_name ;
        
        if($brand->update()){
            return redirect()->back()->with('success',__('Sửa nhãn hàng thành công')); 
        } else {
            return redirect()->back()->withErrors('Sửa nhãn hàng không thành công');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Brand::destroy($id);
        return redirect()->back()->with('delete',__('Đã xoá nhãn hàng thành công'));
    }
}
