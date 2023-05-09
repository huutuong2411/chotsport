<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Vendor;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vendor = Vendor::all();
    	return view('Admin.vendor.vendor',compact('vendor'));
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
        $vendor = new Vendor();
        $vendor->name= $request->name;
        $vendor->phone= $request->phone;
        $vendor->email= $request->email;
        if($vendor->save()){
            return redirect()->back()->with('success',__('Thêm nhà cung cấp thành công')); 
        } else {
            return redirect()->back()->withErrors('Thêm nhà cung cấp không thành công');
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
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $vendor = Vendor::find($id);
        $vendor->name= $request->new_name;
        $vendor->phone= $request->new_phone;
        $vendor->email= $request->new_email;
        
        if($vendor->update()){
            return redirect()->back()->with('success',__('Sửa nhà cung cấp thành công')); 
        } else {
            return redirect()->back()->withErrors('Sửa nhà cung cấp không thành công');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Vendor::destroy($id);
        return redirect()->back()->with('delete',__('Đã xoá nhà cung cấp thành công'));
    }
    // thùng rác
    public function trash()
    {
        $trash=Vendor::onlyTrashed()->get();
        return view('Admin.vendor.trash',compact('trash'));
    }
    // khôi phục 
    public function restore(string $id)
    {
        Vendor::withTrashed()->find($id)->restore();
        return redirect()->back()->with('success',__('khôi phục thành công')); 
    }
}
