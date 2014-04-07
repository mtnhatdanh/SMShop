<?php
class ItemSize extends Eloquent
{
    public $table="item_sizes";
    
    public function itemType(){
    	return $this->belongsTo("ItemType","itemType_id");
    }

}