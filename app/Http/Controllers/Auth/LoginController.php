<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Http\Request;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';
    //protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest:login')->except('logout');
       // $this->middleware('guest:admin', ['except' => ['logout', 'userLogout']]);
        $this->middleware('guest', ['except' => ['logout', 'userLogout']]);
       // $this->middleware('guest', ['except' => 'logout']);
    }
    
    public function userLogout()
    {
        Auth::guard('web')->logout();

        //$request->session()->flush(); ## this will logout everything/everyone
        //$request->session()->regenerate();

        return redirect('/');
    }
    
    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    ## we are overridding the same function in AuthenticatesUsers class
    protected function credentials(Request $request)
    {
       // return $request->only($this->username(), 'password');
        //return $request->only([$this->username(), 'status'=>1]);
        //return ['email'=>$request->{$this->username()}, 'password'=>$request->password, 'status'=> 1];
        return ['email'=>$request->{$this->username()}, 'password'=>$request->password, 'status'=> 1];
    }
    protected function sendFailedLoginResponse(Request $request)
    {
        $user = User::where(['email' => $request->{$this->username()}])->first();
        if($user->status ==0){
            $errors = [$this->username() => trans('auth.status_fail')];
        }else{
            $errors = [$this->username() => trans('auth.failed')];  
        }
        if ($request->expectsJson()) {
            return response()->json($errors, 422);
        }

        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors($errors);
    }
}
