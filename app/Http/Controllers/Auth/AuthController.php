<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use Hash;

class AuthController extends Controller
{

    public function index(){
        return view('auth.login');
    }
    public function postLogin(Request $req){
        $req->validate([
            'email' => 'required',
            'password'=> 'required'
        ]);
      $credentials = $req->only('email','password');
      if(Auth::attempt($credentials)){

      }

    }
    public function registration(){
        return view('auth.registration');
    }
    public function postRegistration(Request $req){
        $req->validate([
            'name' => 'required',
            'email'=> 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);
        $data = $req->all();
        $this->create($data);
        return redirect('dashboard')->withSuccess('Great! You have Successfully loggedin');

    }
    public function dashboard(){
        return view('dashboard');
    }
    public function create(array $data){
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }
}
