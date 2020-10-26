<?php

class Controller
{
	public $Method;
	public $View;
	public $Model;
	protected $Operator;

	function __construct($View = true)
	{
		if($View)
		{
			$this->View = new View();
		}
	}
	
	public function LoadModel($Name, $ModelPath)
	{
		$File = $ModelPath . $Name . 'Model.php';
		
		if(file_exists($File))
		{
			require_once($File);

			$ModelName		= $Name . 'Model';
			$this->Model	= new $ModelName();

			if(!empty($this->View))
			{
				$this->View->Method = $Name;
			}
		}
	}

	public function ECommerce()
	{
		$Params			= func_get_args();
		$ServiceName	= strtolower(__FUNCTION__);
		
		$this->CallSubMethod($ServiceName, $Params);
	}

	private function CallSubMethod($ServiceName, $Params)
	{
		$ServiceStatus	= $this->Model->GetServiceStatus($ServiceName);
		
		if ($ServiceStatus['status_id'] == 1)
		{
			if (count($Params) > 0)
			{
				$FunctionName	= strtolower($Params[0]);
				$FunctionName	= ucfirst($FunctionName);
				$FunctionName	= ucfirst($ServiceName) . $FunctionName;
				unset($Params[0]);  //Clear used param

				$CheckExist = method_exists($this, $FunctionName);
				
				if ($CheckExist)
				{
					call_user_func_array(array($this, $FunctionName), $Params);
				}
				else
				{
					$this->View->Error(404);
				}
			}
			else
			{
				$this->View->RenderJson(array(
					'StatusID'	=> $ServiceStatus['status_id'],
					'Operator'	=> $this->Operator
				));
			}
		}
		else
		{
			$this->View->RenderJson(array(
				'StatusID'	=> $ServiceStatus['status_id'],
				'Message'	=> $ServiceStatus['message'],
				'Operator'	=> $this->Operator
			));
		}
	}

	public function Error()
	{
		header('Location: ' . URL . Lang::GetLang() . '/error/');
		exit;
	}
}

?>