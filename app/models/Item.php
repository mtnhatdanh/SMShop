<?php
class Item extends Eloquent
{
    public $table="items";
    
    public function itemAtt(){
    	return $this->belongsTo("ItemAtt","itemAtt_id");
    }

    public function isValid(){
    	return Validator::make(
            $this->toArray(),
            array(
				'itemAtt_id'     => 'required|min:1',
				'name'           => 'required',
				'price'          => 'required|integer',
				'description'    => 'required',
				'urlPic1'        => 'required',
				'urlPic2'        => 'required',
				'size_available' => 'required'
            )
        )->passes();
    }

}