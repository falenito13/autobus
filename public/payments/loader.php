<?php

// Load Config
require_once(dirname(__FILE__) . '/config.php');

// Load Core Files
require_once(CORE . 'App.php');
require_once(CORE . 'Controller.php');
require_once(CORE . 'Model.php');
require_once(CORE . 'View.php');

// Load Libs

spl_autoload_register(function($Class) {
	if(file_exists(LIBS . $Class . '.php'))
	{
		require_once(LIBS . $Class . '.php');
	}
});