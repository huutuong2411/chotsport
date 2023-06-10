<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Brand;
use App\Models\Admin\Banner;
class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    	$brand= Brand::select('id','name')->get();

    	$banner=Banner::join('brand', 'banner.id_brand', '=', 'brand.id')
	    ->select('banner.id','banner.image', 'brand.name as brand_name')
	    ->get();

        return view('Admin.banner',compact('brand','banner'));
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
        $banner = new Banner();
        $banner->id_brand= $request->brand ;
        $image=$request->image;
        if(!empty($image)) {
                $banner->image = $image->getClientOriginalName();
        } 
        if($banner->save()){
            if(!empty($image)) { 
                $image->move(public_path('/admin/assets/img/banner'), $image->getClientOriginalName());
                return redirect()->back()->with('success',__('Thêm bảng hiệu thành công')); 
            }
        
        } else {
            return redirect()->back()->withErrors('Thêm bảng hiệu không thành công');
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
        $banner = Banner::find($id);
        $banner->id_brand= $request->brand ;
        $image=$request->image;
        if(!empty($image)) {
                $banner->image = $image->getClientOriginalName();
        } 
        if($banner->update()){
            if(!empty($image)) { 
                $image->move(public_path('/admin/assets/img/banner'), $image->getClientOriginalName());
            }
        return redirect()->back()->with('success',__('Sửa bảng hiệu thành công')); 
        } else {
            return redirect()->back()->withErrors('Sửa bảng hiệu không thành công');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Banner::destroy($id);
        return redirect()->back()->with('delete',__('Đã xoá bảng hiệu thành công'));
    }
}
