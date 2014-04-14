<?php
use LaravelBook\Ardent\Ardent;

class OrderDetail extends Ardent
{
    public $table="order_details";
    
    public static $rules = array(
        'order_id' => 'required|integer',
        'item_id'  => 'required|integer',
        'size'     => 'required',
        'qty'      => 'required|integer',
        'price'    => 'required|integer'
        );

    public static $relationsData = array(
        'order' => array(self::BELONGS_TO, 'Order', 'order_id'),
        'item'  => array(self::BELONGS_TO, 'Item', 'item_id')
        );

}