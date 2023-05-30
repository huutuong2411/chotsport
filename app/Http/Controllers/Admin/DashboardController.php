<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\admin\Product;
use App\Models\admin\Blog;
use App\Models\User;
use App\Models\User\Order;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
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
        $successorder= Order::where('status',2)->count();
        $cancelorder= Order::where('status',3)->count();
        $pendingorder= Order::where('status',1)->count();

        $customer= User::count();

        $thisMonth = date('m');   
       
        $thisYear = date('Y'); 
        //tổng doanh thu tháng
        $Monthrevenue = Order::where('status', 2)
                        ->whereMonth('created_at', $thisMonth)
                        ->whereYear('created_at', $thisYear)
                        ->sum('sum_money');
        //tổng doanh thu năm               
        $Yearrevenue = Order::where('status', 2)
                        ->whereYear('created_at', $thisYear)
                        ->sum('sum_money');

        // các năm đã qua 
        $listyears = Order::selectRaw('YEAR(created_at) as year')
                    ->groupBy('year')
                    ->orderBy('year','DESC')
                    ->get();
        // thống kê doanh thu tháng hiện tại
        $monthEarn=[];
        for ($i=1; $i <=12 ; $i++) { 
             $thismonthEarn = Order::where('status', 2)
                        ->whereMonth('created_at', $i)
                        ->whereYear('created_at', $thisYear)
                        ->sum('sum_money');   
            $monthEarn[] = $thismonthEarn;
        }
        // bán chạy
        $bestsellers = Product::select('products.name',\DB::raw('SUM(order_details.qty) as soldqty'))
                ->join('product_details', 'products.id', '=', 'product_details.id_product')
                ->join('order_details', 'order_details.id_product_detail', '=', 'product_details.id')
                ->join('order', 'order_details.id_order', '=', 'order.id')
                ->where('order.status', 2)
                ->whereYear('order.created_at', $thisYear)
                ->groupBy('products.id')
                ->orderBy('products.created_at', 'DESC')
                ->limit(10)
                ->get();
        $listproduct=[];
        $soldqty=[];
        foreach ($bestsellers as $value) {
           $listproduct[]=$value->name;
           $soldqty[]=$value->soldqty;
        }

        // đơn hàng chưa xử lý của tuần này
        $today=Carbon::now();
        $subweek=Carbon::now()->subWeek()->startOfDay();

        $orderofweek=  Order::where('status',0)->whereBetween('created_at', [$subweek, $today])->orderBy('created_at', 'desc')->get();

       return view('Admin.dashboard',compact('allproduct','neworder','successorder','cancelorder','pendingorder','allblog','customer','Monthrevenue','Yearrevenue','monthEarn','listyears','listproduct','soldqty','orderofweek'));
    }

    /**
     * Show the form for creating a new resource.
     */
   
    public function earning(Request $request)
    {
        if(!empty($request->year) && empty($request->month)){
            $monthEarn=[];
            for ($i=1; $i <=12 ; $i++) { 
                $thismonthEarn = Order::where('status', 2)
                            ->whereMonth('created_at', $i)
                            ->whereYear('created_at', $request->year)
                            ->sum('sum_money');   
                $monthEarn[] = $thismonthEarn;
            } 
            return response()->json($monthEarn);
        }
        // xử lý theo từng tháng:
        if(!empty($request->year) && !empty($request->month)){
            $firstday= new Carbon('first day of '.$request->month.' '.$request->year);
            $lastday= new Carbon('last day of '.$request->month.' '.$request->year);
            $period = CarbonPeriod::create($firstday, $lastday);
            $dayEarn=[];
            $listday=[];
            foreach ($period as $value) {
                $date= $value->format('Y-m-d');
                $thisdayEarn= Order::where('status', 2)
                            ->whereDate('created_at', $value)
                            ->sum('sum_money');
                $dayEarn[] = $thisdayEarn;
                $listday[]= $value->day;
            }
           
            return response()->json(['dayEarn'=>$dayEarn,'listday'=>$listday]);
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function bestseller(Request $request)
    {   
        $listproduct=[];
        $soldqty=[];
        // xử lý bán chạy theo năm
        if(!empty($request->year) && empty($request->month)){
            $thisYear=$request->year;
            $bestsellers = Product::select('products.name',\DB::raw('SUM(order_details.qty) as soldqty'))
                ->join('product_details', 'products.id', '=', 'product_details.id_product')
                ->join('order_details', 'order_details.id_product_detail', '=', 'product_details.id')
                ->join('order', 'order_details.id_order', '=', 'order.id')
                ->where('order.status', 2)
                ->whereYear('order.created_at', $thisYear)
                ->groupBy('products.id')
                ->orderBy('products.created_at', 'DESC')
                ->limit(10)
                ->get();
                
                foreach ($bestsellers as $value) {
                   $listproduct[]=$value->name;
                   $soldqty[]=$value->soldqty;
                }
            return response()->json(['listproduct'=>$listproduct,'soldqty'=>$soldqty]); 
        }
        if(!empty($request->year) && !empty($request->month)){ 
            $thisYear=$request->year;
            $thisMonth=$request->month;
            $bestsellers = Product::select('products.name',\DB::raw('SUM(order_details.qty) as soldqty'))
                ->join('product_details', 'products.id', '=', 'product_details.id_product')
                ->join('order_details', 'order_details.id_product_detail', '=', 'product_details.id')
                ->join('order', 'order_details.id_order', '=', 'order.id')
                ->where('order.status', 2)
                ->whereMonth('order.created_at', $thisMonth)
                ->whereYear('order.created_at', $thisYear)
                ->groupBy('products.id')
                ->orderBy('products.created_at', 'DESC')
                ->limit(10)
                ->get();

            foreach ($bestsellers as $value) {
                   $listproduct[]=$value->name;
                   $soldqty[]=$value->soldqty;
                }
            return response()->json(['listproduct'=>$listproduct,'soldqty'=>$soldqty]); 
        }
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
