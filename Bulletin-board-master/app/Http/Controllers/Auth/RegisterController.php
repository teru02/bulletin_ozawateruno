<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;

class RegisterController extends Controller
{
    //
    protected function create(array $data){
        return User::create([
            'username'=>$data['username'],
            'email'=>$data['email'],
            'password'=>Hash::make($data['password'])
        ]);
    }

    public function registerView(){
        return view('auth.register');
    }

    public function register(Request $request){
            $data=$request->input();
            $this->create($data);
            return redirect('added');
    }

    public function added(){
        return view('auth.added');
    }

}
