<?php

class Cron extends Controller
{
	public function __construct($View = true)
	{
		parent::__construct($View);
	}
	
	public function Index()
	{
		Render('Index');
	}

	public function Day1()
	{
		$this->View->Render(1);
	}
	
	public function UpdateLangs()
	{
		$this->Model->UpdateLangs();
	}
}