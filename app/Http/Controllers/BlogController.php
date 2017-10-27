<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Setting;

class BlogController extends Controller
{
    public function getIndex(){
    	$posts = Post::orderBy('id','desc')->paginate(4);
    	return view('blog.index')->withPosts($posts);
    }

    public function getSingleBySlug($slug){
    	$post = Post::whereSlug($slug)->first();
    	return view('blog.single')->withPost($post);
    }

    public function getArchive($cat_name){
        $category_id = Category::where('name',$cat_name)->first()->id;
    	$posts = Post::whereCategory_id($category_id)->paginate(4);
    	$catName = Category::find($category_id)->name;
    	$catDesc = Category::find($category_id)->description;
    	return view('blog.archive',compact('posts','catName','catDesc'));
    }
}
