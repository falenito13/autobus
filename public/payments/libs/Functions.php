<?php

class Functions
{
	public static function ConcatURL($URL, $AfterStr)
	{
		$Divider	= '&';
		$Pos		= stripos($URL, '?');
		if ($Pos === false)
		{
			$Divider = '?';
		}

		return $URL . $Divider . $AfterStr;
	}

	public static function IsJson($String)
	{
		return	((is_string($String) &&
				(is_object(json_decode($String)) ||
				is_array(json_decode($String))))) ? true : false;
	}
}