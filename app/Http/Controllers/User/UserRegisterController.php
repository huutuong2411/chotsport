<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Roles;
use Hash;
class UserRegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.account.register');
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
    public function register(Request $request)
    {
        $email= $request->email;
        $checkemail= User::where('email',$email)->first();
        if($request->password==$request->confirm_password)
        {
            if($checkemail){
                return redirect()->back()->withErrors('Email đã tồn tại');
            }else{
                            $newUser= User::create([
                                'name' => $request->name,
                                'email' => $email,
                                'password' => Hash::make($request->password),
                                'id_role' => Roles::where('role','=','user')->first()->id,
                            ]);
                            if($newUser){
                                Auth::login($newUser);
                                return redirect()->route('user.home');
                            }
                            else{
                                return redirect()->back()->withErrors('Lỗi đăng ký, vui lòng thử lại');
                            }              
            }                 
            
        }else{
            return redirect()->back()->withErrors('Nhập lại mật khẩu không đúng');
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
