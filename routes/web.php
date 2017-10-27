<?php

	Route::get('blog','BlogController@getIndex')->name('blog.index');
	// Single blog
	Route::get('blog/{slug}','BlogController@getSingleBySlug')->name('blog.single');
	Route::get('archive/{cat}','BlogController@getArchive')->name('blog.archive');


	Route::get('contact', 'PagesController@getContact');
	Route::get('about', 'PagesController@getAbout');

	// Home Page
	Route::get('','PagesController@getIndex')->name('home');

	Route::get('json','PostController@json');


Route::group(['middleware' => 'auth' , 'prefix' => 'admin'], function() {
	Route::resource('posts','PostController');
	Route::resource('category','CategoryController');
	Route::get('trashed_posts',[
		'as'   => 'posts.trashed',
		'uses' => 'PostController@trashed'
	]);
	Route::put('restore_posts/{id}',[
		'as'   => 'posts.restore',
		'uses' => 'PostController@trashed_restore'
	]);
	Route::delete('restore_force_delete/{id}',[
		'as'   => 'posts.forceDelete',
		'uses' => 'PostController@trashed_force_delete'
	]);
	Route::delete('restore_force_delete',[
		'as'   => 'posts.clearTrash',
		'uses' => 'PostController@clearTrash'
	]);

	Route::resource('settings','SettingsContgroller');

});


Auth::routes();

Route::get('/home', 'HomeController@index');
