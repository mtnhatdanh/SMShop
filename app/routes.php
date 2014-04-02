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

Route::get('category/{name}/{itemType_id}', function($name, $itemType_id){
	$category_id = Category::where('name', '=', $name)->first()->id;
	
	$items = DB::table('categories')
				->join('item_types', 'categories.id', '=', 'item_types.category_id')
				->join('item_atts', 'item_types.id', '=', 'item_atts.itemType_id')
				->join('items', 'item_atts.id', '=', 'items.itemAtt_id')
				->where('categories.id', '=', $category_id);

	if ($itemType_id == 'view-all') {
		$items = $items	->paginate(16);
	} else {
		$items = $items->where('item_types.id', '=', $itemType_id)->paginate(16);
	}
	return View::make('View_Ajax.view-items', array('items'=>$items));
});

Route::get('category/{name}/{itemType_id}/att/{itemAtt_id}', function($name, $itemType_id, $itemAtt_id){
	$category_id = Category::where('name', '=', $name)->first()->id;
	
	$items = DB::table('categories')
				->join('item_types', 'categories.id', '=', 'item_types.category_id')
				->join('item_atts', 'item_types.id', '=', 'item_atts.itemType_id')
				->join('items', 'item_atts.id', '=', 'items.itemAtt_id')
				->where('categories.id', '=', $category_id)
				->where('item_types.id', '=', $itemType_id)
				->where('item_atts.id', '=', $itemAtt_id)
				->paginate(16);
	return View::make('View_Ajax.view-items', array('items'=>$items));
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
