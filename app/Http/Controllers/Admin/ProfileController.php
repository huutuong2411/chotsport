<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\City;
use App\Models\District;
use App\Models\Address;
class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $province=Auth::user()->address->ward->district->city->name;
        $district=Auth::user()->address->ward->district->name;
        $ward=Auth::user()->address->ward->name;
        $address=Auth::user()->address->address;
        $full_address= $address.', '.$ward.', '.$district.', '.$province;

        $city=City::all();
        return view('admin.account.profile',compact('city','full_address'));
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
    public function update_profile(Request $request)
    {
        if(!empty($request->id_city)){
        $district= City::find($request->id_city)->district;
        return response()->json($district);
        }
        if(!empty($request->id_district)){
        $ward= District::find($request->id_district)->ward;
        return response()->json($ward);
        }

        $IDuser = Auth::id();
        $user= User::findOrFail($IDuser);
        $data=$request->all();


        // nếu đã có địa chỉ từ trước:
        if($request->has('full_address')){
            $data['id_address'] = Auth::user()->id_address;
        } else{
            // tạo dữ liệu lưu vào bảng address
            if($request->has('ward')){
                $address=new Address();
                $address->id_ward=$request->ward;
                if($request->has('chitiet')){
                    $address->address=$request->chitiet; 
                }
                $address->save();
            }
            // lấy ra id của bảng address vừa lưu:
            $id_address = $address->id;
            // gán vào id_address của bảnng user
            $data['id_address'] = $id_address;     
        }   
        $image=$request->avatar;
        // lấy tên hình ảnh
        if(!empty($image)) {
                $data['avatar'] = $image->getClientOriginalName();
        } 
        // Lưu vào user và xử lý move hình ảnh sang public 
        if($user->update($data)){

            if(!empty($image)) { 
                $image->move(public_path('/admin/assets/img/user'), $image->getClientOriginalName());
            }
        return redirect()->back()->with('success',__('Cập nhật thông tin thành công')); 
        } else {
            return redirect()->back()->withErrors('Cập nhật thông tin không thành công');
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
