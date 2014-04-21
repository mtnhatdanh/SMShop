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

/**
 * Route for nomal items
 */
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
				->orderBy('items.id', 'desc')
				->where('categories.id', '=', $category_id)
				->where('items.onsale', '!=', 1);

	if ($itemType_id == 'view-all') {
		$items    = $items	->paginate(16);
		$typeLink = 'view-all';
	} elseif ($itemType_id == 'new-arrivals') {
		$dateTwoWeekAgo = strtotime('-2 weeks');
		$dateTwoWeekAgo = date('Y-m-d', $dateTwoWeekAgo);
		
		$items          = $items -> where('items.created_at', '>', $dateTwoWeekAgo)->paginate(16);
		$typeLink       = 'new-arrivals';
	}	else {
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
				->orderBy('items.id', 'desc')
				->where('categories.id', '=', $category_id)
				->where('item_types.id', '=', $itemType_id)
				->where('item_atts.id', '=', $itemAtt_id)
				->where('items.onsale', '!=', 1)
				->paginate(16);
	return View::make('View_Ajax.view-items', array('items'=>$items, 'category'=>$category, 'typeLink'=>$typeLink, 'attLink'=>$attLink));
});

Route::get('item/{item_id}',function($item_id){
	$item = Item::find($item_id);
	return View::make('View_Ajax.item_detail', array('item'=>$item));
});


/**
 * Route for sale items
 */
Route::get('sale/{category_name}', function($category_name){
	$category_id = Category::where('name', '=', $category_name)->first()->id;
	$category    = Category::find($category_id);
	$items       = DB::table('categories')
				->join('item_types', 'categories.id', '=', 'item_types.category_id')
				->join('item_atts', 'item_types.id', '=', 'item_atts.itemType_id')
				->join('items', 'item_atts.id', '=', 'items.itemAtt_id')
				->orderBy('items.id', 'desc')
				->where('categories.id', '=', $category_id)
				->where('items.onsale', '=', 1)
				->paginate(16);

	$typeLink = 'view-all';

	return View::make('Sale_View.sale-view-items', array('items'=>$items, 'category'=>$category, 'typeLink'=>$typeLink));
});

Route::get('sale/{category_name}/{itemType_id}', function($category_name, $itemType_id){
	$category_id = Category::where('name', '=', $category_name)->first()->id;
	$category    = Category::find($category_id);
	$items = DB::table('categories')
				->join('item_types', 'categories.id', '=', 'item_types.category_id')
				->join('item_atts', 'item_types.id', '=', 'item_atts.itemType_id')
				->join('items', 'item_atts.id', '=', 'items.itemAtt_id')
				->orderBy('items.id', 'desc')
				->where('categories.id', '=', $category_id)
				->where('item_types.id', '=', $itemType_id)
				->where('items.onsale', '=', 1)
				->paginate(16);

	$typeLink = ItemType::find($itemType_id)->name;
	return View::make('Sale_View.sale-view-items', array('items'=>$items, 'category'=>$category, 'typeLink'=>$typeLink));
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

Route::filter('check_signin', function(){
	if(!Session::has('user_admin')) {
		return Redirect::to('signin-admin');
	}
});


/**
 * Check out handle
 */

Route::get('checkout-login', function(){
	if (Session::has('pax')) {
		return Redirect::to('check-out');
	} else return View::make('checkout-login');
});

Route::get('log-out', function(){
	Session::forget('pax');
	return Redirect::to('/');
});

Route::get('check-out', function(){
	if (!Session::has('pax')) {
		return Redirect::to('checkout-login');
	} elseif (!Cache::has('cart')) {
		return View::make('checkout-empty-cart');
	} else return View::make('checkout');
});

Route::post('check-out-confirm', function(){
	if (!Session::has('pax') || !Cache::has('cart')) {
		return Response::json('error', 400);
	} else {

		$note = Input::get('note');
		$cart = Cache::get('cart');
		$data = array('cart'=>$cart, 'note'=>$note);

		// Save order to database
		
		$pax = Pax::where('email', '=', Session::get('pax'))->first();
		
		$order         = new Order;
		$order->pax_id = $pax->id;
		$order->date   = date('Y-m-d');
		$order->status = 0;
		$order->note   = $note;
		$success       = $order->save();
		if (!$success) {
			return Response::json('order save error', 400);
		}
		$order_id = $order->id;

		foreach ($cart as $key => $itemCart) {
			$orderDetail           = new OrderDetail;
			$orderDetail->order_id = $order_id;
			$orderDetail->item_id  = $itemCart->item_id;
			$orderDetail->size     = $itemCart->size;
			$orderDetail->qty      = $itemCart->quantity;

			$item = Item::find($itemCart->item_id);
			if ($item->onsale) {
				$price = $item->sale_price;
			} else $price = $item->price;
			$orderDetail->price = $price;
			$success            = $orderDetail->save();
			if (!$success) {
				return Response::json('OrderDetail save error', 400);
			}
		}


		// Send mail to passenger
		Mail::send('mail-check-out', $data, function($message){
			$message->to(Session::get('pax'), 'SMShop Customer')->subject('ORDER CONFIRMATION/XÁC NHẬN ĐƠN HÀNG
				');
			$message->to('hanghieuchobeyeu@yahoo', 'SMShop')->subject('ORDER CONFIRMATION/XÁC NHẬN ĐƠN HÀNG
				');
		});
		// return Redirect::to('check-out-finish');
	}
});

Route::get('check-out-finish', function(){
	Cache::forget('cart');
	return View::make('checkout-finish');
});




/**
 * Admin control
 */
Route::get('signin-admin', function(){
	if (Session::has('user_admin')) {
		return Redirect::to('/admin/create-item');
	}
	if (Session::has('error_signin')) {
		$error = Session::get('error_signin');
		return View::make('Admin_View.signin',array('error'=>$error));
	} else return View::make('Admin_View.signin');
});

Route::post('signin-admin', function() {
	$username = Input::get('username');
	$password = md5(sha1(Input::get('password')));
	if (User::where('username', '=', $username)->where('password', '=', $password)->count()) {
		Session::put('user_admin', $username);
		Session::forget('error_signin');
		return Redirect::to('admin/manage-items');
	} else {
		$error = "** Wrong username or password **";
		Session::put('error_signin', $error);
		return Redirect::to('signin-admin');
	}
});

Route::filter('check_admin_signin', function(){
	if(!Session::has('user_admin')) {
		return Redirect::to('signin-admin');
	}
});

Route::group(array('before'=>'check_admin_signin'), function(){
	Route::controller('admin', 'AdminController');
});

/**
 * Sale controller
 */
Route::controller('sale', 'SaleController');

/**
 * Info Controller
 */
Route::controller('info', 'InfoController');


/**
 * Route for Ajax
 */
Route::group(array('prefix'=>'ajax'), function(){

	Route::post('pick-category', function(){
		$category_id = Input::get('category_id');
		$category    = Category::find($category_id);
		echo "<option value='-1'>-- Select Item Type --</option>";
		foreach ($category->itemTypes as $itemType) {
			echo "<option value='$itemType->id'>$itemType->name</option>";
		}
	});

	Route::post('pick-itemType', function(){
		$itemType_id = Input::get("itemType_id");
		$itemType    = ItemType::find($itemType_id);
		echo "<option value='-1'>-- Select Item Attribute --</option>";
		foreach ($itemType->itemAtts as $itemAtt) {
			echo "<option value='$itemAtt->id'>$itemAtt->name</option>";
		}
	});

	Route::post('pick-itemAtt', function(){
		$itemAtt_id = Input::get('itemAtt_id');
		$itemAtt = ItemAtt::find($itemAtt_id);
		foreach ($itemAtt->itemType->itemSizes as $itemSize) {
			echo "<div class='checkbox'>
						<label>
							<input name='size_available[]' value='$itemSize->value' type='checkbox' checked> $itemSize->value
						</label>
					</div>";
		}
	});
});

/**
 * ajax link to check email for new account signup
 */
Route::post('check-email-exist', function(){
	$email = Input::get('email');
	if (Pax::checkEmailExist($email)) {
		return "false";
	} else return "true";
});

Route::post('check-username-exist', function(){
	$username = Input::get('username');
	if (User::checkUserExist($username)) {
		return "false";
	} else return "true";
});

/**
 * Sign up ajax
 */
Route::post('sign-up', function(){
	$rules = array(
			'email'    => 'required|email',
			'password' => 'required',
			'address'  => 'required',
			'phone'    => 'required'
		);
	$validator = Validator::make(Input::all(), $rules);
	if ($validator->fails()) {
		return Response::json('error', 400);
	} else {
		$pax           = new Pax;
		$pax->email    = Input::get('email');
		$pax->password = md5(sha1(Input::get('password')));
		$pax->address  = Input::get('address');
		$pax->phone    = Input::get('phone');
		$pax->save();

		$data = array('email'=>Input::get('email'));

		Mail::send('mail-welcome', $data, function($message){
			$message->to(Input::get('email'), 'SMShop Passenger')->subject('Welcome to SM Shop!!');
		});

		return "Chúc mừng bạn đã đăng ký thành công!!";
	}
});

/**
 * Sign in ajax
 */
Route::post('sign-in', function(){
	$email    = Input::get('email');
	$password = md5(sha1(Input::get('password')));
	
	if (Pax::where('email', '=', $email)->where('password', '=', $password)->count()) {
		$pax_id = Pax::where('email', '=', $email)->where('password', '=', $password)->first()->id;
		$pax    = Pax::find($pax_id);
		Session::put('pax', $pax->email);
		return "Welcome to SMShop, <strong>$pax->email</strong> user!!";
	} else {
		return "Wrong email address or password";
	}
});

Route::get('test', function(){

	Cache::forget('cart');

	// Mail::send('test', array('abc'=>'abc'), function($message){
	// 		$message->to('mtnhatdanh@gmail.com', 'Minh giang')->subject('Welcome to SM Shop!!');
		// });
	

	// $pax = Pax::where('email', '=', Session::get('pax'))->first();
	// Session::forget('pax');


	// dd(DB::getQueryLog());
	// echo "<br/>";
	// print_r($items);
	
	
});

