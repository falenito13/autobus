<?php

class Session
{
	public static function Init()
	{
		@session_start();
	}
	
	public static function Set($Key, $Val)
	{	
		$_SESSION[$Key] = $Val;
	}
	
	public static function Get($Key)
	{
		if(isset($_SESSION[$Key]))
		{
			return $_SESSION[$Key];
		}

		return false;
	}
	
	public static function Destroy($Key = false)
	{
		if($Key == false)
		{
			unset($_SESSION);
			session_destroy();
		}
		elseif(isset($_SESSION[$Key]))
		{
			unset($_SESSION[$Key]);
		}
	}
}