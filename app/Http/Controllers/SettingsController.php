<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use Validator;
use Illuminate\Foundation\Validation\ValidatesRequests;

class SettingsController extends Controller
{
    public function profile()
    {
        return view('settings.profile');
    }
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function editProfile()
    {
        return view('settings.edit-profile');
    }
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$user->id
        ]);
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->save();

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Yee profil kamu berhasil dirubah"
        ]);
        return redirect('settings/profile');
    }
    public function editPassword()
    {
        return view('settings.edit-password');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();
        $this->validate($request, [
            'password'=>'required|passcheck:'.$user->password,
            'new_password'=>'required|confirmed|min:6',
        ],[
            'password.passcheck'=>'Password Lama Tak Sesuai'
        ]);
        $user->password = bcrypt($request->get('new_password'));
        $user->save();
        
        Session::flash("flash_notification",[
            "level"=>"success",
            "message"=>"Password Baru Berhasil Disimpan"
        ]);
        return redirect('settings/password');
    } 
}
