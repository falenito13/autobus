<?php

class Curl
{
	public static function Post($URL, $Data, $SSL = NULL)
	{
		Curl::BuildQuery($Data, $Params);

		ob_start();  
		$out = fopen('php://output', 'w');

		$Curl = curl_init();

		curl_setopt($Curl, CURLOPT_URL,				$URL);
		curl_setopt($Curl, CURLOPT_RETURNTRANSFER,	true);
		curl_setopt($Curl, CURLOPT_POST,			true);
		curl_setopt($Curl, CURLOPT_SSL_VERIFYPEER,	false);
		curl_setopt($Curl, CURLOPT_POSTFIELDS,		Curl::ImplodeQuery($Params));

		curl_setopt($Curl, CURLOPT_VERBOSE, true);
		curl_setopt($Curl, CURLOPT_STDERR, $out);

		if ($SSL) {
			curl_setopt($curl, CURLOPT_SSLVERSION, 1);
			curl_setopt($Curl, CURLOPT_VERBOSE,			true);
			curl_setopt($Curl, CURLOPT_SSL_VERIFYHOST,	false);
			curl_setopt($Curl, CURLOPT_SSLCERT,			$SSL['CertificatePath'] . '.pem');
			curl_setopt($Curl, CURLOPT_SSLKEY,			$SSL['CertificatePath'] . '.key');
			curl_setopt($Curl, CURLOPT_SSLKEYPASSWD,	$SSL['Password']);

			$Result = curl_exec($Curl);
			
			curl_close($Curl);

			fclose($out);
			$debug = ob_get_clean();
			
			file_put_contents(ROOT . 'verbous.txt', $debug);

			$Result		= explode(PHP_EOL, trim($Result));
			$ResultData	= array();
			foreach($Result as $Key => $cLine )
			{
				$Arr					= explode(':', $cLine);
				$ResultData[$Arr[0]]	= trim($Arr[1]);
			}
			
			return $ResultData;
		}

		curl_setopt($Curl, CURLOPT_REFERER, SITE);

		$Result = curl_exec($Curl);

		curl_close($Curl);
		
		return $Result;
	}
	
	public static function BuildQuery($Arrays, &$New = array(), $Prefix = NULL)
	{
		if(is_object($Arrays)){
			$Arrays = get_object_vars($Arrays);
		}
	
		foreach($Arrays as $Key => $Value) {
			$K = isset($Prefix) ? $Prefix . '[' . $Key . ']' : $Key;
			if(is_array($Value) || is_object($Value)){
				Curl::BuildQuery($Value, $New, $K);
			} else {
				$New[$K] = $Value;
			}
		}
	}
	
	public static function ImplodeQuery($Array)
	{
		$Result = array();
		
		foreach($Array as $Key => $Value) {
			$Result[] = $Key . '=' . $Value;
		}
		
		return implode('&', $Result);
	}
}