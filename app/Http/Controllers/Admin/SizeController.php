<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Size;
use App\Models\Admin\Brand;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $size = Size::orderBy('length', 'asc')->get();
        $brand=Brand::select('id','name')->get();
        $trash=Size::onlyTrashed()->join('brand', 'size.id_brand', '=', 'brand.id')
	    ->select('size.id','size.length','size.size', 'brand.name as brand_name')
	    ->get();
        return view('Admin.size.size',compact('size','brand','trash'));
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
        $size = new Size();
        $size->length= $request->newlength;
        $size->size= $request->newsize;
        $size->id_brand= $request->id_brand;
        if($size->save()){
            return redirect()->back()->with('success',__('Thêm size giày thành công')); 
        } else {
            return redirect()->back()->withErrors('Thêm size giày không thành công');
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
     	$size = Size::find($id);
        $size->length= $request->length;
        $size->size= $request->size;
        $size->id_brand= $request->id_brand;
        
        if($size->update()){
            return redirect()->back()->with('success',__('Sửa size giày thành công')); 
        } else {
            return redirect()->back()->withErrors('Sửa size giày không thành công');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(string $id)
    {
        Size::destroy($id);
        return redirect()->back()->with('delete',__('Đã xoá size giày thành công'));
    }
    // khôi phục 
    public function restore(string $id)
    {
        Size::withTrashed()->find($id)->restore();
        return redirect()->back()->with('success',__('khôi phục thành công')); 
    }
}