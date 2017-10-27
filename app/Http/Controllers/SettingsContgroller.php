<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;
use Session;

class SettingsContgroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings_exists = Setting::all()->count();
        $settings = Setting::first();

        if($settings_exists){
            return redirect()->route('settings.edit',$settings->id);
        }else{
            return view('settings.create');
        }
        
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
        $save_settings = new Setting;
        $save_settings->theme = $request->theme;
        $save_settings->css = $request->css;
        $save_settings->js = $request->js;
        $save_settings->footer_text = $request->footer_text;
        $save_settings->save();

        Session::flash('success' , 'All settings saved successfully!!!');

        return redirect()->route('settings.index');
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
        $settings = Setting::find($id);
        return view('settings.update',compact('settings'));
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
        $save_settings = Setting::find($id);
        $save_settings->theme = $request->theme;
        $save_settings->css = $request->css;
        $save_settings->js = $request->js;
        $save_settings->footer_text = $request->footer_text;
        $save_settings->save();
        Session::flash('success' , 'All settings updated successfully!!!');
        return redirect()->route('settings.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
