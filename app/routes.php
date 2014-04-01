<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function () {
    return View::make('mainpage');
});

Route::get('main', function(){
	return View::make('mainpage');
});

Route::get('category/{name}', function($name){
	$category_id = Category::where('name', '=', $name)->first()->id;
	$category    = Category::find($category_id);
	return View::make('category', array('category'=>$category));
});

Route::get('category/{name}/{view}', function($name, $view){
	$category_id = Category::where('name', '=', $name)->first()->id;
	$category    = Category::find($category_id);
	if ($view == 'view-all') {
		return View::make('View_Ajax.view-all', array('category'=>$category));
	}
});

Route::get('add-item', function(){
	for ($i=1; $i < 21; $i++) { 
		for ($j=0; $j < 3; $j++) { 
			DB::table('items')->insert(
			    array(
					'itemAtt_id' => $i, 
					'name'       => 'Áo',
					'price'      =>200000,
					'urlPic1'    =>$i.'.jpeg'
		    	)
		);
		}
	}
	

});
