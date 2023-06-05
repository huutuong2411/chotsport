<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Roles;
use Hash;
class UserManagerController extends Controller
{
    public function index()
    {
    	$user=User::all();

        return view('Admin.user.user',compact('user'));
    }



    public function show(string $id)
    {
        $user= User::find($id);
        if(!empty($user->id_address)){
        $province=$user->address->ward->district->city->name;
        $district=$user->address->ward->district->name;
        $ward=$user->address->ward->name;
        $address=$user->address->address;
        $full_address= $address.', '.$ward.', '.$district.', '.$province;
        }else{
            $full_address="";
        }
        return view ('admin.user.showuser',compact('user','full_address'));
    }


    public function disable(string $id)
    {
        $user=User::find($id);
        $user->status= 1;
        if($user->save()){
            return redirect()->back()->with('success',__('Vô hiệu hoá người dùng thành công'));    
        } else {
            return redirect()->back()->withErrors('Vô hiệu hoá người dùng không thành công');
        }

        
    }



    public function enable(string $id)
    {
        $user=User::find($id);
        $user->status= 0;
        if($user->save()){
            return redirect()->back()->with('success',__('Kích hoạt người dùng thành công'));    
        } else {
            return redirect()->back()->withErrors('Kích hoạt người dùng không thành công');
        }

    }



    public function create()
    {
        return view ('Admin.user.addemployee');
    }




    public function addempoyee(Request $request)
    {
      $email= $request->email;
        $checkemail= User::where('email',$email)->first();
            if($checkemail){
                return redirect()->back()->withErrors('Email đã tồn tại');
            }else{
                            $newUser= User::create([
                                'name' => $request->name,
                                'email' => $email,
                                'password' => Hash::make($request->password),
                                'id_role' => Roles::where('role','=','employee')->first()->id,
                            ]);
                            if($newUser){
                                return redirect()->route('admin.user')->with('success',__('Thêm tài khoản nhân viên thành công'));    
                            }
                            else{
                                return redirect()->back()->withErrors('Lỗi đăng ký, vui lòng thử lại');
                            }              
            }       
    }
}
