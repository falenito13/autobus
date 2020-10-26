<?php

class Request 
{	
	public static function Req($key = false)
	{
		return $key == false ? $_REQUEST : (isset($_REQUEST[$key]) ? $_REQUEST[$key] : '');
	}
	
	public static function SetReq($key, $val)
	{
		$_REQUEST[$key] = $val;
	}
	
	public static function Get($key = false)
	{
		return $key == false ? $_GET : (isset($_GET[$key]) ? $_GET[$key] : '');
	}
	
	public static function SetGet($key, $val)
	{
		$_GET[$key] = $val;
	}
	
	public static function Post($key = false)
	{
		return $key == false ? $_POST : (isset($_POST[$key]) ? $_POST[$key] : '');
	}
	
	public static function SetPost($key, $val)
	{
		$_POST[$key] = $val;
	}
}