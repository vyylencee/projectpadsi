<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function index()
    {
        return view('login');
    }  
      

    public function adminLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials, $request->filled('remember'))) {$request->session()->regenerate();
            return redirect()->intended('dashboard')
                        ->with('success', 'Login Berhasil!');
        } else {
            return back()->withErrors([
                'email' => 'Gagal Login! Username/Password Salah',
            ]);
        }
  
        return redirect("login")->withSuccess('Login details are not valid');
    }


    
    public function signOut() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
    
}