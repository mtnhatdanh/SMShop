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
	$category    = Category::find($category_id);
	$items = DB::table('categories')
				->join('item_types', 'categories.id', '=', 'item_types.category_id')
				->join('item_atts', 'item_types.id', '=', 'item_atts.itemType_id')
				->join('items', 'item_atts.id', '=', 'items.itemAtt_id')
				->where('categories.id', '=', $category_id);

	if ($itemType_id == 'view-all') {
		$items    = $items	->paginate(16);
		$typeLink = 'view-all';
	} else {
		$items    = $items->where('item_types.id', '=', $itemType_id)->paginate(16);
		$typeLink = ItemType::find($itemType_id)->name;
	}
	return View::make('View_Ajax.view-items', array('items'=>$items, 'category'=>$category, 'typeLink'=>$typeLink));
});

Route::get('category/{name}/{itemType_id}/att/{itemAtt_id}', function($name, $itemType_id, $itemAtt_id){
	$category_id = Category::where('name', '=', $name)->first()->id;
	$category    = Category::find($category_id);
	$typeLink    = ItemType::find($itemType_id)->name;
	$attLink     = ItemAtt::find($itemAtt_id)->name;
	$items = DB::table('categories')
				->join('item_types', 'categories.id', '=', 'item_types.category_id')
				->join('item_atts', 'item_types.id', '=', 'item_atts.itemType_id')
				->join('items', 'item_atts.id', '=', 'items.itemAtt_id')
				->where('categories.id', '=', $category_id)
				->where('item_types.id', '=', $itemType_id)
				->where('item_atts.id', '=', $itemAtt_id)
				->paginate(16);
	return View::make('View_Ajax.view-items', array('items'=>$items, 'category'=>$category, 'typeLink'=>$typeLink, 'attLink'=>$attLink));
});

Route::get('item/{item_id}',function($item_id){
	$item = Item::find($item_id);
	return View::make('View_Ajax.item_detail', array('item'=>$item));
});

/**
 * Cart handle
 */
Route::post('cart-handle', function(){
	$type    = Input::get('type');
	
	if (Cache::has('cart')) {
		$cart = Cache::get('cart');
	} else $cart = array();

	if ($type == 1) {
		$item_id = Input::get('item_id');
		$size    = Input::get('size');

		$itemCart           = new ItemCart;
		$itemCart->item_id  = $item_id;
		$itemCart->size     = $size;
		$itemCart->quantity = $itemCart->getItemCartQuantity() + 1;

		if (!$itemCart->checkItemCartExits()) {
			$cart[] = $itemCart;
		} else {
			$key        = $itemCart->getItemCartExitsNo();
			$cart[$key] = $itemCart;
		}

	} elseif ($type == 2) {

		// Delete key
		$key = Input::get('key');
		unset($cart[$key]);

	} elseif ($type == 3) {
		$key                = Input::get('key');
		$itemCart           = $cart[$key];
		$itemCart->quantity = Input::get('quantity');
		$cart[$key]         = $itemCart;
	}

	$sumQuantity = 0;
	foreach ($cart as $itemCart) {
		$sumQuantity += $itemCart->quantity;
	}

	Cache::put('cart', $cart, 1440);
	echo ('('.$sumQuantity.')');

});

/**
 * Show cart ajax
 */
Route::get('show-cart', function(){
	$cart = Cache::get('cart');
	return View::make('View_Ajax.show_cart', array('cart'=>$cart));
});

Route::get('test', function(){
	Cache::forget('cart');
	print_r(Cache::get('cart'));
});

Route::get('add-item-size', function(){
	DB::table('item_sizes')->insert(array(
		array('itemType_id'=>5, 'value'=>'X'),
		array('itemType_id'=>5, 'value'=>'Y'),
		array('itemType_id'=>5, 'value'=>'Z'),
		array('itemType_id'=>6, 'value'=>'X'),
		array('itemType_id'=>6, 'value'=>'Y'),
		array('itemType_id'=>6, 'value'=>'Z'),
		array('itemType_id'=>7, 'value'=>'X'),
		array('itemType_id'=>7, 'value'=>'Y'),
		array('itemType_id'=>7, 'value'=>'Z'),
		array('itemType_id'=>8, 'value'=>'X'),
		array('itemType_id'=>8, 'value'=>'Y'),
		array('itemType_id'=>8, 'value'=>'Z'),
		array('itemType_id'=>9, 'value'=>'X'),
		array('itemType_id'=>9, 'value'=>'Y'),
		array('itemType_id'=>9, 'value'=>'Z'),
		array('itemType_id'=>10, 'value'=>'X'),
		array('itemType_id'=>10, 'value'=>'Y'),
		array('itemType_id'=>10, 'value'=>'Z'),
		array('itemType_id'=>11, 'value'=>'X'),
		array('itemType_id'=>11, 'value'=>'Y'),
		array('itemType_id'=>11, 'value'=>'Z')
	));
});
