<?php

class User extends \Eloquent {
	public $table="users";

	/**
	* Check Username exits
	* @param  string $username
	* @return boolean          
	*/
	public static function checkUserExist($username){
		if (User::where('username', '=', $username)->count()) {
			return true;
		} else return false;
	}

	public function isValid() {
		return Validator::make(
			$this->toArray(), 
			array(
				'username' => 'required|unique:users',
				'password' => 'required'
			)
		)->passes();
	}
}