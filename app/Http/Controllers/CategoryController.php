<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Post;
use Session;

class CategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cats = Category::all();
        return view('category.index',compact('cats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name' => 'required|max:255|Alpha_dash|unique:categories,name',
            'description' => 'max:300',
        ]);

        $category_store = new Category;
        $category_store->name = $request->name;
        $category_store->description = $request->description;
        $category_store->save();

        Session::flash('success','Category added successfully!!!');

        return redirect()->route('category.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cat = Category::find($id);
        return view('category.edit',compact('cat'));
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

        $cat = Category::find($id);

        if( $cat->name == $request->name){
            $this->validate($request,[
                'name' => 'required|Alpha_dash|max:255',
                'description' => 'max:300',
            ]);
        }else{
            $this->validate($request,[
                'name' => 'required|max:255|Alpha_dash|unique:categories,name',
                'description' => 'max:300',
            ]);
        }


        $cat->name = $request->name;
        $cat->description = $request->description;
        $cat->save();
        Session::flash('success','Category updated successfully');
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::destroy($id);
        Post::where('category_id',$id)
                    ->update([
                        'category_id' => NULL
                    ]);
        Session::flash('success','Category deleted');
        return redirect()->route('category.index');
    }
}
