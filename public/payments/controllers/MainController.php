<?php

/**
* Main Controller
*/
class Main extends Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->Operator = 'none';
	}

	public function Index()
	{
		$Array = array(
			['OperatorID' => 10, 'OperatorName' => 'TBC']
		);

		$this->View->RenderJson(array(
			'Title'			=> 'Payments Service',
			'ServicesLis'	=> $Array
		));
	}
}

?>