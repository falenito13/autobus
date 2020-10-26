<?php

class CronModel extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function UpdateLangs()
	{
		$Langs = new LangsGenerator();
		$Langs->FillLangs();
		$Langs->SaveLangFiles();
	}
}