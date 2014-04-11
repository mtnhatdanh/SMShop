<?php

class SaleController extends Controller {

	public function getIndex(){
		return View::make('Sale_View.sale-mainpage');
	}

}