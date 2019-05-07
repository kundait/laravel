<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class AdminLoginController extends Controller
{
    public function __construct()
    {
       // $this->middleware('guest:admin')->except('logout');
        $this->middleware('guest:admin', ['except' => ['logout']]);
    }
    
    public function showLoginForm(){
        return view('auth.admin-login');
    }
    
    public function login(Request $request){
        //validate the data
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required',
        ]);
        //attempt to log user in
        if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)){
         //if success redirect to itended location else redirect back to login form with data
            return redirect()->intended(route('admin.dashboard'));
        }
       
        return redirect()->back()->withInput($request->only('email', 'remember'));
        
    }
    
      public function logout()
    {
        Auth::guard('admin')->logout();

        //$request->session()->flush(); ## this will logout everything/everyone
        //$request->session()->regenerate();

        return redirect('/');
    }
}
