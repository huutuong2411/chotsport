<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Purchase;
use App\Models\admin\Vendor;
use App\Models\admin\Product;
class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purchase = Purchase::paginate(3);
        return view('Admin.purchase.purchase',compact('purchase'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vendor= Vendor::select('id','name')->get();
        $product= Product::select('id','name','image')->get();
        return view('Admin.purchase.addPurchase',compact('vendor','product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // xử lý ajax trả về size của brand theo id_product
        if(!empty($request->id_product)) {
        $size= Product::find($request->id_product)->Brand->Size;
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
