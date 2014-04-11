<?php
class ItemType extends Eloquent
{
    public $table="item_types";

    public function category(){
    	return $this->belongsTo("Category","category_id");
    }

    public function itemAtts(){
    	return $this->hasMany("ItemAtt","itemType_id");
    }

    public function itemSizes(){
    	return $this->hasMany('ItemSize', 'itemType_id');
    }

}