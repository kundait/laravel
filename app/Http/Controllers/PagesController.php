<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $title = 'kundai';
        //return view('pages.index', compact('title')); ## parse single value to blade view
       // return view('pages.index')->with('title',$title); 
        $message=false;
        return view('pages.index')->with('message',$message);; 
    }
    public function about(){
        return view('pages.about');
    }
     public function services(){
         $data= array(
             'title'=>'test_s',
             'msg'=>'kundai',
             'services'=>['code','php','seo']
         );
        return view('pages.services')->with($data);
    }
    
}
