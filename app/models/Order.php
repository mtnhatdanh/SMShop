<?php
use LaravelBook\Ardent\Ardent;

class Order extends Ardent
{
    public $table="orders";
    
    public static $rules = array(
        'pax_id' => 'required|integer',
        'date'    => 'required|date',
        'status'  => 'required|integer'
        );

    public static $relationsData = array(
		'orderDetails' => array(self::HAS_MANY, 'OrderDetail', 'order_id'),
		'pax'          => array(self::BELONGS_TO, 'Pax', 'pax_id')
        );

}