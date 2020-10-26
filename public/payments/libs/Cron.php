<?php

/**
* 
*/
class Cron
{
	public static function Init($Data)
	{
		$Langs = unserialize(LANGS);
		Lang::SetLang(DEFAULT_LANG, $Langs[DEFAULT_LANG]);

		foreach ($Data as $ClassName => $Functions)
		{
			require CONTROLLER_PATH . $ClassName . 'Controller.php';
			
			$Cron = new $ClassName();
			$Cron->LoadModel($ClassName, MODEL_PATH);

			foreach ($Functions as $Function => $Param)
			{
				if (is_string($Function) && method_exists($Cron, $Function))
				{
					$Cron->{$Function}($Param);
				}
			}
		}
	}
}

?>