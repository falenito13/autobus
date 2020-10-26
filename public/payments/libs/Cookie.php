<?php

class Cookie 
{	
	public static function Set($Key, $Val)
	{	
		//$_SESSION[$Key] = $Val;
	}
	
	public static function Get($Key)
	{
		if(isset($_COOKIE[$Key]))
		{
			return $_COOKIE[$Key];
		}

		return false;
	}	
	
	public static function Destroy($Key = false)
	{
		if($Key == false)
		{
			unset($_COOKIE);	
		}
		elseif(isset($_COOKIE[$Key]))
		{
			unset($_COOKIE[$Key]);
		}
	}
}