<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    // public function __construct()
    // {
    //      $this->middleware('auth');
    // }


    public function login(){
        return view('auth.login');
    }

    public function handlelogin(AuthRequest $request){

         $credentials =$request->only(['email', 'password']);
         if(Auth::attempt($credentials)){
           return redirect()->route('dashboard');
         }else{
           return redirect()->back()->with('error_msg', 'paramètre de connexion non reconnu');
         }
    }

    public function logout()
    {
        Auth::logout();
      return redirect('handlelogin'); 
    }
}
