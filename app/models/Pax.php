<?php
class Pax extends Eloquent 
{
	public $table="paxs";

	public static function checkEmailExist($email){
		if (Pax::where('email', '=', $email)->count()) {
			return true;
		} else return false;
	}
}