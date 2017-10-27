<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use SoftDeletes;
use Session;

class PostController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $posts = Post::orderBy('id','desc')->paginate(4);
        $deleted_post_count = Post::onlyTrashed()->count();
        return view('posts.index' , compact('posts','deleted_post_count'));
    }

    public function trashed(){
        $posts = Post::onlyTrashed()->paginate(4);
        return view('posts.trashed')->withPosts($posts);
        
    }
    public function clearTrash(){
        $posts = Post::onlyTrashed()->forceDelete();
        return redirect()->route('posts.index');
        
    }

    public function trashed_restore($id){
        $posts = Post::onlyTrashed()->whereId($id)->restore();
        Session::flash('success','Post restored');
        return redirect()->route('posts.show',$id);
    }
    public function trashed_force_delete($id){
        $posts = Post::onlyTrashed()->whereId($id)->forceDelete();
        Session::flash('success','Post deleted permanently');
        return redirect()->route('posts.trashed');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('posts.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate data
        $this->validate($request , [
            'title' => 'required|max:255',
            'slug' => 'required|min:5|max:255|Alpha_dash|unique:posts,slug',
            'body'  => 'required|min:30'
        ]);
        // store in database
        $post = new Post;
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->category_id = $request->category_id;
        $post->body = $request->body;
        $post->save();

        Session::flash('success','Post published');
        // redirect to show method
        return redirect()->route('posts.show' , $post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $post = Post::find($id);
        return view('posts.show')->withPost($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::all();
        return view('posts.edit',compact('post','categories'));
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

        $oldSlug = Post::find($id)->slug;
        if( $request->slug == $oldSlug ){

            $this->validate($request , [
                'title' => 'required|max:255',
                'body'  => 'required|min:30'
            ]);
        }else{
            $this->validate($request , [
                'title' => 'required|max:255',
                'slug' => 'required|min:5|max:255|Alpha_dash|unique:posts,slug',
                'body'  => 'required|min:30'
            ]);
        }


        $post = Post::whereId($id)->first();

        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->category_id = $request->category_id;
        $post->body = $request->body;
        $post->save();

        Session::flash('updated','Post Updated Successfully!!');

        return redirect()->route('posts.show',$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::destroy($id);
        Session::flash('success','Post Deleted temporary , you can restore this from trash again');
        return redirect()->route('posts.index');

    }
}
