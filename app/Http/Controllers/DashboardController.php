<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id=auth()->user()->id;
        $user=User::find($user_id);
        return view('dashboard')->with('posts',$user->posts);
       /* $user_status=auth()->user()->status;
        if ($user_status == 1){
            $user_id=auth()->user()->id;
            $user=User::find($user_id);
            return view('dashboard')->with('posts',$user->posts);
        }else{
            // return redirect('/pages');
            //Auth::guard()->logout();        
           $message="You account has not yet been activated or has been suspended";
           return view('pages.index')->with('message',$message);
        }*/
    }
}
