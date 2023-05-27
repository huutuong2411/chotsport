<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
class UserManagerController extends Controller
{
    public function index()
    {
    	$user=User::all();

        return view('Admin.user.user',compact('user'));
    }
    public function changerole(Request $request, string $id)
    {
        $user=User::find($id);
        $user->id_role= $request->role;
        if($user->save()){
            return redirect()->route('admin.user')->with('success',__('Phân quyền thành công'));    
        } else {
            return redirect()->back()->withErrors('Phân quyền không thành công');
        }

        
    }
}
