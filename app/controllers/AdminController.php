<?php

class AdminController extends Controller {

	public function getIndex(){
		return Redirect::to('admin/manage-items');
	}

	public function getLogout(){
		Session::forget('user_admin');
		return Redirect::to('signin-admin');
	}

	/**
	 * Manage Item
	 * @return View
	 */
	public function getManageItems(){
		$notification = Cache::get('notification');
		Cache::forget('notification');
		return View::make('Admin_View.manage-items', array('notification'=>$notification));
	}

	public function postManageItems(){
		$itemAtt_id = Input::get('itemAtt_id');
		$itemAtt    = ItemAtt::find($itemAtt_id);
		return View::make('Admin_View.manage-items-table', array('itemAtt'=>$itemAtt));
	}

	public function postDeleteItem(){
		$item_id = Input::get('item_id');
		$itemAtt_id = Input::get('itemAtt_id');

		$item = Item::find($item_id);

		// Delete image file
		File::delete(public_path().'/assets/img/products/'.$item->urlPic1);
		File::delete(public_path().'/assets/img/products/'.$item->urlPic2);


		$item->delete();

		$itemAtt = ItemAtt::find($itemAtt_id);
		return View::make('Admin_View.manage-items-table', array('itemAtt'=>$itemAtt));
	}

	/**
	 * Modify Item function
	 * @return View ajax
	 */
	public function postModifyItem(){
		$item = Item::find(Input::get('item_id'));
		return View::make('Admin_View.modify-item-ajax', array('item'=>$item));
	}

	public function postModifyItemConfirm(){
		
		$item = Item::find(Input::get('item_id'));

		if (Input::hasFile('urlPic1')) {
			// delete old picture
			File::delete(public_path().'/assets/img/products/'.$item->urlPic1);

			// upload new picture
			$pic1 = Input::file('urlPic1');
			$destinationPath = public_path().'/assets/img/products';
			$pic1Name        = str_random(6).'_'.$pic1->getClientOriginalName();
			$uploadSuccess1  = $pic1->move($destinationPath, $pic1Name);
			if ($uploadSuccess1) {
				$item->urlPic1 = $pic1Name;
			} else {
				return Response::json('error', 400);
			}
		}

		if (Input::hasFile('urlPic2')) {
			// delete old picture
			File::delete(public_path().'/assets/img/products/'.$item->urlPic2);

			// upload new picture
			$pic2 = Input::file('urlPic2');
			$destinationPath = public_path().'/assets/img/products';
			$pic2Name        = str_random(6).'_'.$pic2->getClientOriginalName();
			$uploadSuccess2  = $pic2->move($destinationPath, $pic2Name);
			if ($uploadSuccess1) {
				$item->urlPic2 = $pic1Name;
			} else {
				return Response::json('error', 400);
			}
		}

		$item->name             = Input::get('name');
		$item->price            = Input::get('price');
		$item->description      = Input::get('description');
		$item->size_available   = implode(' ', Input::get('size_available'));
		if (Input::get('onsale') == 1) $item->onsale = 1; else $item->onsale = 0;
		$item->sale_price       = Input::get('sale_price');

		$item->save();

		$itemAtt_id = $item->itemAtt->id;
		$itemAtt    = ItemATt::find('itemAtt_id');

		$notification = new Notification;
		$notification->set('success', 'Item has been modified successfully!!');
		return View::make('Admin_View.manage-items', array('itemAtt'=>$itemAtt, 'notification'=>$notification));

	}

	/**
	 * Create new Item
	 * @return View create-item.blade.php
	 */
	public function getCreateItem(){
		$notification = Cache::get('notification');
		Cache::forget('notification');
		return View::make('Admin_View.create-item', array('notification'=>$notification));
	}

	/**
	 * Get data from Create Item form
	 * @return Update database
	 */
	public function postCreateItem(){

		if (Input::hasFile('urlPic1') && Input::hasFile('urlPic2')) {
			$pic1            = Input::file('urlPic1');
			$pic2            = Input::file('urlPic2');
			$destinationPath = public_path().'/assets/img/products';
			$pic1Name        = str_random(6).'_'.$pic1->getClientOriginalName();
			$pic2Name        = str_random(6).'_'.$pic2->getClientOriginalName();
			$uploadSuccess1  = $pic1->move($destinationPath, $pic1Name);
			$uploadSuccess2  = $pic2->move($destinationPath, $pic2Name);

			if( $uploadSuccess1 && $uploadSuccess2 ) {
				$item = new Item;

				$item->itemAtt_id       = Input::get('itemAtt_id');
				$item->name             = Input::get('name');
				$item->price            = Input::get('price');
				$item->description      = Input::get('description');
				$item->urlPic1          = $pic1Name;
				$item->urlPic2          = $pic2Name;
				$item->size_available   = implode(' ', Input::get('size_available'));
				if (Input::get('onsale') == 1) $item->onsale = 1; else $item->onsale = 0;
				$item->sale_price       = Input::get('sale_price');

				$item->save();

				$notification = new Notification;
				$notification->set('success', 'Item has been created successfully!!');
				Cache::put('notification', $notification, 10);

				return Redirect::to('admin/create-item');
			} else {
				return Response::json('error', 400);
			}
		}

	}

}