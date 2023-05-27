<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Roles;

class UserLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view ('user.account.login');
        Redirect::setIntendedUrl(url()->previous());
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
    public function login(Request $request)
    {
        $login = [
            'email'=>$request->email,
            'password'=>$request->password,
            'id_role'=> Roles::select('id')->where('role','=','user')->first(),
        ];

        $remember_me=$request->has('remember_me')?true:false;

        if(Auth::attempt($login,$remember_me)) { 
             return redirect()->route('user.home');
        } else {    
            return redirect()->back()->withErrors('Sai email hoặc mật khẩu');
        }
    }

   // ĐĂNG XUẤT
    public function logout()
    {
        Auth::logout();
        return redirect()->route('user.login');
    }

}
