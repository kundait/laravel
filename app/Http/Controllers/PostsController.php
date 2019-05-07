<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
//use App\User;
//use DB; ## for custom queries

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    ###This constructor blocks users that are not logged in
    public function __construct()
    {      
        //$this->middleware('userStat');
        $this->middleware('auth', ['except'=>['index', 'show']]);
    }

    public function index()
    {
        //$posts = DB::select('Select * from posts');##fetches all data in table using custom query and not use eloquent
        //$posts = Post::all();##fetches all data in table
       // $posts = Post::orderBy('title','desc')->take(1)->get(); ##select result limit to 1
      //  $posts = Post::orderBy('title','desc')->get();##fetches all data by column and ordered in table
        //$post = Post::where('title','post 2')->get();## fetches specific record
        $posts = Post::orderBy('created_at','desc')->paginate(10);##pagination
        return view('posts.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $this->validate($request,[
               'title'=>'required',
               'body'=>'required',
               'cover_image'=>'image|nullable|max:1999'
           ]);
       //Handle file upload
       if($request->hasfile('cover_image')){
           //Get Filename
           $fullFilename= $request->file('cover_image')->getClientOriginalName();
           //Get filename
           $filename=pathinfo($fullFilename, PATHINFO_FILENAME);
           //Get extension
           $extension=$request->file('cover_image')->getClientOriginalExtension();
           //filenamae to store
           $fileNameToStore=$filename."_".time().".".$extension;
           //Upload image
           $path=$request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
       }else{
           $fileNameToStore='none.png';
       }
       ///use of Tinker 
       $post=new Post;
       $post->title=$request->input('title');
       $post->body=$request->input('body');
       $post->user_id=auth()->user()->id;
       $post->cover_image=$fileNameToStore;
       $post->save();
       
       return redirect('/posts')->with('success', 'Post created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post =  Post::find($id); ##selects from database
         if($post){
        return view('posts.show')->with('post',$post);
         }else{
            return redirect('/posts')->with('error','Unauthorized access, page does not exist!'); 
         }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { 
       
        $post =  Post::find($id); 
        if($post){
            //Check for correct user      
            if(auth()->user()->id != $post->user_id){
               return redirect('/posts')->with('error','Unauthorized page access, you do not have permission to edit the page!!');  
            }
            return view('posts.edit')->with('post',$post);
        }else{
            return redirect('/posts')->with('error','Unauthorized access, page does not exist!'); 
       }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $this->validate($request,[
               'title'=>'required',
               'body'=>'required'
           ]);
       
        //Handle file upload
       if($request->hasfile('cover_image')){
           //Get Filename
           $fullFilename= $request->file('cover_image')->getClientOriginalName();
           //Get filename
           $filename=pathinfo($fullFilename, PATHINFO_FILENAME);
           //Get extension
           $extension=$request->file('cover_image')->getClientOriginalExtension();
           //filenamae to store
           $fileNameToStore=$filename."_".time().".".$extension;
           //Upload image
           $path=$request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
       }
       
       ///use of Tinker 
       $post= Post::find($id);
       $post->title=$request->input('title');
       $post->body=$request->input('body');
       if($request->hasfile('cover_image')){
           $post->cover_image=$fileNameToStore;
       }
       $post->save();
       
       return redirect('/posts')->with('success', 'Post updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $post= Post::find($id);
      if(auth()->user()->id != $post->user_id){
          return redirect('/posts')->with('error','Unauthorized page access!!');  
       }
      if($post->cover_image != 'none.png'){
          //Delete image
          Storage::delete('public/cover_images/'.$post->cover_image);          
      }
      $post->delete();
      return redirect('/posts')->with('success', 'Post removed');
    }
}
