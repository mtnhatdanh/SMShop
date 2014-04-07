<?php
class ItemCart
{

	public $item_id;
	public $size;
    public $quantity;

    public function getItemCartQuantity(){
    	if (Cache::has('cart')) {
    		$cart = Cache::get('cart');
            $quantity = 0;
    		foreach ($cart as $itemCart) {
    			if ($itemCart->item_id == $this->item_id && $itemCart->size == $this->size) {
                    $quantity = $itemCart->quantity;
    			}
    		}
            return $quantity;
    	} return 0;
    }

    public function checkItemCartExits() {
    	if (Cache::has('cart')) {
    		$cart = Cache::get('cart');
    		foreach ($cart as $itemCart) {
    			if ($itemCart->item_id == $this->item_id && $itemCart->size == $this->size) {
    				return true;
    			}
    		}
            return false;
    	} return false;
    }

    public function getItemCartExitsNo(){
		$cart = Cache::get('cart');
		foreach ($cart as $key=>$itemCart) {
			if ($itemCart->item_id == $this->item_id && $itemCart->size == $this->size) {
				return $key;
			}
		}
    }

}