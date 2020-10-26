<?php

class App 
{
	private $_URL				= NULL;
	private $_Controller		= NULL;
	
	private $_DefaultFile		= 'Main';
	private $_ErrorFile			= 'Error';

	private $DefaultMethod		= 'Index';
	
	public function Init()
	{
		Session::init();
		
		$this->SetURL();
		
		if(empty($this->_URL[1]))
		{
			$this->LoadDefaultController();
		}
		else
		{
			$this->LoadExistingController();
		}
		
		$this->CallControllerMethod();
	}
	
	private function SetURL()
	{

		$URL_1		= isset($_GET['url']) ? $_GET['url'] : NULL;
		$URL_1		= rtrim($URL_1, '/');
		$URL_1		= filter_var($URL_1, FILTER_SANITIZE_URL);
		$URL_Array	= explode('/', $URL_1);
		$Langs		= unserialize(LANGS);

		if(!in_array($URL_Array[0], array_keys($Langs)))
		{
			$Lang = Cookie::Get('Lang');
			
			if($Lang == false)
			{
				$Lang = DEFAULT_LANG;
			}
			
			header('Location: ' . URL . $Lang . '/' . $URL_1);
			
			exit;
		}
		else
		{
			if(count($URL_Array) > 1)
			{
				$URL_Array[1] = ucfirst(strtolower($URL_Array[1]));
			}
			
			Lang::SetLang($URL_Array[0], $Langs[$URL_Array[0]]);
			
			$this->_URL = $URL_Array;
		}
	}
	
	private function LoadDefaultController()
	{
		require_once(CONTROLLER_PATH . $this->_DefaultFile . 'Controller.php');
		
		$this->_Controller = new $this->_DefaultFile;
		$this->_Controller->LoadModel($this->_DefaultFile, MODEL_PATH);
	}
	
	private function LoadExistingController()
	{
		$File = CONTROLLER_PATH . $this->_URL[1] . 'Controller.php';
		
		if(file_exists($File))
		{
			require_once($File);
			
			$this->_Controller = new $this->_URL[1];
			$this->_Controller->loadModel($this->_URL[1], MODEL_PATH);
		}
		else
		{
			$this->_Error();
		}
	}
	
	private function CallControllerMethod()
	{
		$length = count($this->_URL);
		
		if($length > 2)
		{
			if(!method_exists($this->_Controller, $this->_URL[2]))
			{
				$this->_Error();
			}
		}
		
		$this->_Controller->Method = ucfirst($this->_URL[2] ? $this->_URL[2] : $this->DefaultMethod);
		
		call_user_func_array(array($this->_Controller, $this->_Controller->Method), array_slice($this->_URL, 3));
	}
	
	private function _Error()
	{
		require_once(CONTROLLER_PATH . $this->_ErrorFile . 'Controller.php');
		
		$this->_Controller = NULL;
		$this->_Controller = new $this->_ErrorFile;
		$this->_Controller->loadModel($this->_ErrorFile, MODEL_PATH);
		$this->_Controller->Index();
		
		exit;
	}
}

?>