<?php

class Error extends Controller
{
	function __construct()
	{
		parent::__construct();
	}
	
	public function Index()
	{
		$this->View->Error(403);
	}
}