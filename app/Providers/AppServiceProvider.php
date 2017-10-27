<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Setting;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {   
        
        view()->composer('layouts.app', function($view)
        {   
            $settings = Setting::first();
            $view->with('theme', isset($settings->theme) ? $settings->theme : 'flatly')
                    ->with('css', isset($settings->css) ? $settings->css : '' )
                    ->with('footer_text', isset($settings->footer_text) ? $settings->footer_text : '' )
                    ->with('js', isset($settings->js) ? $settings->js : '');
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
