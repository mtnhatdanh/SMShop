<?php
class ItemAtt extends Eloquent
{
    public $table="item_atts";
    
    public function itemType(){
    	return $this->belongsTo("ItemType","itemType_id");
    }

    public function items(){
    	return $this->hasMany('Item', 'itemAtt_id');
    }

}