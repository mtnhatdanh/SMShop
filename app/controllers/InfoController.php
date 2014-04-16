<?php

class InfoController extends Controller {

	public function getStoreLocator(){
		return View::make('Info_View.store-locator');
	}

	public function getShoppingGuide(){
		return View::make('Info_View.shopping-guide');
	}

	public function getSizeReference(){
		return View::make('Info_View.size-reference');
	}

	public function getHowToBuy(){
		return View::make('Info_View.how-to-buy');
	}

	public function getPaymentMethod(){
		return View::make('Info_View.payment-method');
	}

	public function getDeliveryPolicy(){
		return View::make('Info_View.delivery-policy');
	}

	public function getBuyOnUsWeb(){
		return View::make('Info_View.buy-on-US-web');
	}
}