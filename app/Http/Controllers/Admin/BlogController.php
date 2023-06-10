<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Blog;


class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $infor = Blog::all();
        return view('Admin.blog.blog',compact("infor"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.blog.addBlog');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $blog = new Blog();
        $image = $request->image;
        $blog->title= $request->title ;
        $blog->description= $request->description ;
        $blog->content= $request->content ;
        if(!empty($image)) {
                $blog->image = $image->getClientOriginalName();
        }   
        if($blog->save()){
            if(!empty($image)) {
                $image->move(public_path('/admin/assets/img/blog'), $image->getClientOriginalName());
                return redirect()->route('admin.blog')->with('success',__('Thêm bài viết thành công'));
            }      
        } else {
            return redirect()->back()->withErrors('Thêm bài viết không thành công');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $infor = Blog::find($id);
        return view('Admin.blog.blogDetail', compact("infor"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $infor = Blog::find($id);
        return view('Admin.blog.editBlog', compact("infor"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $blog = Blog::find($id);
        $image = $request->image;
        $blog->title= $request->title ;
        $blog->description= $request->description ;
        $blog->content= $request->content ;
        if(!empty($image)) {
                $blog->image = $image->getClientOriginalName();
        }   
        if($blog->update()){
            if(!empty($image)) {
                $image->move(public_path('/admin/assets/img/blog'), $image->getClientOriginalName());   
            }  
            return redirect()->route('admin.blog')->with('success',__('Sửa bài viết thành công'));    
        } else {
            return redirect()->back()->withErrors('Sửa bài viết không thành công');
        }

        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Blog::destroy($id);
        return redirect()->back()->with('delete',__('Đã xoá bài viết thành công'));
    }
}

