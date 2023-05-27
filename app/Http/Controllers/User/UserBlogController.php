<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Blog;
class UserBlogController extends Controller
{
    public function index()
    {
        $blog = Blog::paginate(12);
        return view ('User.blog.blog',compact('blog'));
    }
    public function show(string $id)
    {
        $blog= Blog::find($id);
        
        return view ('User.blog.blog_detail',compact('blog'));
    }
}
