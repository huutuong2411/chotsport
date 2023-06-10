<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Models\Admin\Product;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category=Category::all();
        return view('Admin.category.category',compact('category'));
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
        $category = new Category();
        $category->name= $request->category ;
        if($category->save()){
            return redirect()->back()->with('success',__('Thêm danh mục thành công')); 
        } else {
            return redirect()->back()->withErrors('Thêm danh mục không thành công');
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
        $category = Category::find($id);
        $category->name= $request->new_name ;
        
        if($category->update()){
            return redirect()->back()->with('success',__('Sửa danh mục thành công')); 
        } else {
            return redirect()->back()->withErrors('Sửa danh mục không thành công');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Category::destroy($id);
        Product::where('id_category',$id)->delete();
        return redirect()->back()->with('delete',__('Đã xoá danh mục thành công'));
    }
    // thùng rác
    public function trash()
    {
        $trash=Category::onlyTrashed()->get();
        return view('Admin.category.trash',compact('trash'));
    }
    // khôi phục category
    public function restore(string $id)
    {
        Category::withTrashed()->find($id)->restore();
        Product::where('id_category',$id)->restore();
        return redirect()->back()->with('success',__('khôi phục thành công')); 
    }
}
