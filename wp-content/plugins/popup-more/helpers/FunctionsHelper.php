<?php
class FunctionsHelper {

	public static function splitAtUpperCase($string){
		return preg_replace('/([a-z0-9])?([A-Z])/','$1 $2',$string);
	}
}