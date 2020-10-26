<pre><?php

class LangsGenerator 
{	
	public $DB          = NULL;
	public $Langs       = array();
	public $LangsFolder = 'langs/';
	
	public function __construct()
	{
		$this->DB = new DataBase();
		
		$ConfigLangs = array_keys(unserialize(LANGS));
		
		foreach($ConfigLangs as $Key => $Val)
		{
			$this->Langs[$Val]['js']   = array();
			$this->Langs[$Val]['json'] = array();
		}
	}
	
	public function FillLangs()
	{	
		$Data = $this->DB->getAll('SELECT * FROM langs');

		if(count($Data))
		{
			foreach($Data as $Key => $Val)
			{
				foreach($this->Langs as $Key_1 => $Val_1)
				{
					$this->FillLang($Key_1, $Val['lang_var'], $Val['lang_'.$Key_1], $Val['lang_js']);
				}
			}
		}

		/*$Data = $this->DB->getAll('SELECT currency_id, symbol FROM currencies');

		foreach($Data as $Key => $Val)
		{
			foreach($this->Langs as $Key_1 => $Val_1)
			{
				$this->FillLang($Key_1, 'CurrencySymbols[' . $Val['currency_id'] . ']', $Val['symbol'], 1);
			}
		}*/
	}
	
	public function FillLang($Key, $Var, $Val, $Js)
	{
		$Var = explode('[', $Var);
		
		switch(count($Var))
		{	
			case 2:
			$this->Langs[$Key]['json'][$Var[0]][substr($Var[1], 0, -1)] = $Val;
			if($Js == 1)
			{
				$this->Langs[$Key]['js'][$Var[0]][substr($Var[1], 0, -1)] = $Val;
			}
			break;
			
			case 3:
			$this->Langs[$Key]['json'][$Var[0]][substr($Var[1], 0, -1)][substr($Var[2], 0, -1)] = $Val;
			if($Js == 1)
			{
				$this->Langs[$Key]['js'][$Var[0]][substr($Var[1], 0, -1)][substr($Var[2], 0, -1)] = $Val;
			}
			break;
			
			default:
			$this->Langs[$Key]['json'][$Var[0]] = $Val;
			if($Js == 1)
			{
				$this->Langs[$Key]['js'][$Var[0]] = $Val;
			}
			break;
		}
	}
	
	public function SaveLangFiles()
	{	
		print_r($this->Langs);
		
		foreach($this->Langs as $Key_1 => $Val_1)
		{
			echo json_encode($Val_1['json'], true);
			file_put_contents($this->LangsFolder . $Key_1 . '.json', json_encode($Val_1['json'], true));
			file_put_contents($this->LangsFolder . $Key_1 . '.js', 'var lang = ' . json_encode($Val_1['js'], true));
		}
	}
}
