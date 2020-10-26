<?php

//Constants

define('BRANCH', 'PRODUCTION');

define('ROOT', dirname(__FILE__) . '/');
define('CORE', ROOT . 'core/');
define('LIBS', ROOT . 'libs/');
define('CRONS', ROOT . 'crons/');
define('LOGS', ROOT . 'logs/');
define('CERT_PATH', ROOT . 'certificates/');

//MVC
define('CONTROLLER_PATH', ROOT . 'controllers/');
define('MODEL_PATH', ROOT . 'models/');

define('SITE', 'Payments.autobus.ge');
define('URL', 'http://payments.autobus.ge/');

//Languages
define('LANGS', serialize(array('ka' => 4, 'en' => 1, 'ru' => 5)));
define('LANGS_DIR', URL . 'langs/');
define('DEFAULT_LANG', 'ka');

//Cookie
define('COOKIE_SITE_TIME', 30); //in days
define('COOKIE_SITE_DOMAIN', ''); //ex: localhost

//Database
define('DB_HOST', 'localhost');
define('DB_NAME', 'autobus1_payments');
define('DB_USER', 'autobus1_payments');
define('DB_PASS', 'CgJWDu_UR9Y-qBfy-D?jTgGTcQM7');

//Debug
define('DEBUGE', true);
define('DEBUGE_LEVEL', 2);

if (DEBUGE) {
	ini_set('display_errors', true);
	ini_set('html_errors', true);
	switch (DEBUGE_LEVEL) {
		case 2:
			error_reporting(E_ALL & ~E_NOTICE);	//Exclude notices
			break;

		default:
			error_reporting(E_ALL);
			break;
	}
} else {
	error_reporting(E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_ERROR | E_WARNING | E_PARSE | E_USER_ERROR | E_USER_WARNING | E_RECOVERABLE_ERROR);
}

?>