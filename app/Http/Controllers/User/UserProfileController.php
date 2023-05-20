<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\City;
use App\Models\District;
use App\Models\Address;
use Hash;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $idAddress= Auth::user()->address;
        $full_address="";
        if($idAddress){
            $province=$idAddress->ward->district->city->name;
            $district=$idAddress->ward->district->name;
            $ward=$idAddress->ward->name;
            $address=$idAddress->address;
            $full_address= $address.', '.$ward.', '.$district.', '.$province;
        }

        $city=City::all();
        return view('user.account.profile',compact('city','full_address'));
        
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
    public function updateprofile(Request $request)
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
        if($request->has('full_address') && empty($request->chitiet)){
            $data['id_address'] = Auth::user()->id_address;
        } else{
            if(!empty($request->ward)){
                // check xem nếu trùng xã trùng địa chỉ thì thôi không tạo bảng address
                    $address = Address::updateOrCreate(
                        ['id_ward' => $request->ward, 'address' => $request->chitiet],
                        ['id_ward' => $request->ward, 'address' => $request->chitiet]
                    );
                    $data['id_address'] = $address->id;
                }
            
        }   
        $image=$request->avatar;
        // lấy tên hình ảnh
        if(!empty($image)) {
            if (file_exists('user/assets/images/user/'.$user->avatar)) // tìm ảnh cũ và xoá
            {
                unlink('user/assets/images/user/'.$user->avatar);
            }
             $data['avatar'] = $image->getClientOriginalName(); // lấy tên hình ảnh
        } 
        // Lưu vào user và xử lý move hình ảnh sang public 
        if($user->update($data)){

            if(!empty($image)) { 
                $image->move(public_path('/user/assets/images/user'), $image->getClientOriginalName());
            }
            return redirect()->route('user.profile')->with('success',__('Cập nhật thông tin thành công'));
        
        } else {
            return redirect()->route('user.profile')->withErrors('Cập nhật thông tin không thành công');
        }
    }

    /**
     * Display the specified resource.
     */



    public function changepass()
    {
        return view('user.account.changepass');
    }
    public function updatepass(Request $request)
    {
        $curentPasswordStatus = Hash::check($request->password, Auth::user()->password);
        if($curentPasswordStatus){
            if($request->new_password==$request->re_password){
                if(User::findOrFail(Auth::user()->id)->update([
                'password' => Hash::make($request->new_password),
                ])){
                   return redirect()->route('user.profile')->with('success',__('Thay đổi mật khẩu thành công')); 
               }else {
                     return redirect()->back()->withErrors('Lỗi thay đổi mật khẩu, vui lòng thử lại');
               }
                
            }else{
                return redirect()->back()->withErrors('Nhập lại mật khẩu mới không đúng');
            }
        }else{
             return redirect()->back()->withErrors('Mật khẩu cũ không đúng');
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
