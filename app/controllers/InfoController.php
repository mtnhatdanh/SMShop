<?php

class InfoController extends Controller {

	public function getStoreLocator(){
		return View::make('Info_View.store-locator');
	}

	public function getShoppingGuilde(){
		return View::make('Info_View.shopping-guide');
	}

	public function getSizeReference(){
		return View::make('Info_View.size-reference');
	}

}