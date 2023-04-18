<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Admin.account.login');
    }
// ĐĂNG NHẬP
    public function login(Request $request)
    {
        $login = [
            'email'=>$request->email,
            'password'=>$request->password,
        ];

        $remember_me=$request->has('remember_me')?true:false;

        if(Auth::attempt($login,$remember_me)) { 
             return redirect()->route('admin.dashboard');
        } else {    
            return redirect()->back()->withErrors('Sai email hoặc mật khẩu');
        }
    }
// ĐĂNG XUẤT
    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
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
