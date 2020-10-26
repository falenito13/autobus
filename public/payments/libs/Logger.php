<?php

class Logger
{
	private static $_DB;
	private static $_LogDirectory;
	private static $_OperatorName;

	public static function SetLog($OperatorName, $DB = NULL)
	{
		self::$_DB				= $DB;
		self::$_OperatorName	= $OperatorName;
		self::$_LogDirectory	= LOGS . self::$_OperatorName . '/';
	}

	public static function Log($Title, $Data, $OrderID = 0)
	{
		self::LogFile('Local', $Title, $Data, $OrderID);

		if (isset(self::$_DB))
		{
			self::LogDB('Local', $Title, $Data, $OrderID);
		}
	}

	public static function RequestLog($Title, $Data, $OrderID = 0)
	{
		self::LogFile('Request', $Title, $Data, $OrderID);

		if (isset(self::$_DB))
		{
			self::LogDB('Request', $Title, $Data, $OrderID);
		}
	}

	public static function ResponseLog($Title, $Data, $OrderID = 0)
	{
		self::LogFile('Response', $Title, $Data, $OrderID);

		if (isset(self::$_DB))
		{
			self::LogDB('Response', $Title, $Data, $OrderID);
		}
	}

	private static function LogFile($LogType, $Title, $Data, $OrderID)
	{
		if (is_array($Data))
		{
			$Data = print_r($Data, true);
		}

		if (!file_exists(self::$_LogDirectory))
		{
			mkdir(self::$_LogDirectory, 0777);
		}

		$Order = '';
		if ($OrderID != 0) {
			$Order = ' OrderID: ' . $OrderID;
		}

		$Log	= fopen(self::$_LogDirectory . $LogType . '.log', 'a');
		$Now	= date('[j-F-Y H:i:s e]');

		fwrite($Log, $Now . ' ' . $Title . ' ' . $Order . ' | ' . $Data . PHP_EOL);
		fclose($Log);
	}

	private static function LogDB($LogType, $Title, $Data, $OrderID)
	{
		if (is_array($Data))
		{
			$Data = print_r($Data, true);
		}

		self::$_DB->Query('	INSERT INTO	`payment_logs` 
									SET	`title` = ?s,
										`log_type` = ?s,
										`order_id` = ?s,
										`log_data` = ?s', $Title, $LogType, $OrderID, $Data);
	}
}