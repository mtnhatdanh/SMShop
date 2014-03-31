<?php
class Category extends Eloquent
{
    public $table="categories";
    
    public function itemTypes(){
    	return $this->hasMany("ItemType","category_id");
    }

    // public function item(){
    // 	return $this->hasMany("Item", "category_id");
    // }
}