<?php
class Item extends Eloquent
{
    public $table="items";
    
    public function itemAtt(){
    	return $this->belongsTo("ItemAtt","itemAtt_id");
    }

}