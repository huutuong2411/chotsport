<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Product;
use App\Models\admin\Blog;
use App\Models\User;
use App\Models\User\Order;
use Illuminate\Support\Facades\DB;
class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      
        $allproduct= Product::count();
        $allblog= Blog::count();
        $neworder= Order::where('status',0)->count();
        $customer= User::count();

        $currentMonth = date('Y-m');
        $currentYear = date('Y');

        $Monthrevenue = Order::where('status', 2)
            ->where(DB::raw('DATE_FORMAT(created_at, "%Y-%m")'), $currentMonth)
            ->sum('sum_money');

        $Yearrevenue = Order::where('status', 2)
            ->where(DB::raw('YEAR(created_at)'), $currentYear)
            ->sum('sum_money');

       return view('Admin.dashboard',compact('allproduct','neworder','allblog','customer','Monthrevenue','Yearrevenue'));
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
