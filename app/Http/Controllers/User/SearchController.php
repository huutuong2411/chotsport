<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Product;
class SearchController extends Controller
{
    public function search(Request $request)
    {
         // xử lý ajax trả về sản phẩm với search-word
        if(!empty($request->word)) {
        $product= Product::where('name','like','%'.$request->word.'%')->limit(5)->get();
       
        return response()->json($product);
        }
    }
}
