<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePasswordRequest;
use App\Rules\CurrentPassword;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class PasswordController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function edit(){

        return view('password.edit');

    }
    public function update(UpdatePasswordRequest $request){


        $request->user()->update([
            'password'=>$request->password,
            'isChange'=>1
        ]);
//        User::where('username',$request->user())->update(['password'=>bcrypt($request->password),
//            'isChange'=>1]);
//        $user = Auth::user();
//        $user->password = bcrypt($request-&gt;get('new-password'));
//$user->save();
        Auth::logout();
        Session::flush();
        return Redirect()->route('login');
    }
}
