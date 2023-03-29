<?php

namespace App\Http\Controllers\Auth\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Auth;
use Illuminate\Support\Facades\Auth;
use App\Models\Users\User;

class LoginController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request){
        if($request->isMethod('post')){
            $data=$request->only('email','password');
            if(User::where('email',$data['email'])->exists()){
                if(Auth::attempt($data)){
                return redirect('/top');
              }else{
                $error='ログイン情報が一致しません。';
                return view('auth.login',['error'=>$error]);
              }
            }else{
                $error='登録されていないメールアドレスです。';
                return view('auth.login',['error'=>$error]);
            }
        }
        return view('auth.login');
    }

    public function logout(){
        Auth::logout();
        return redirect('login');
    }
}
