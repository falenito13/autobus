<?php

set_time_limit(0);

require_once(dirname(__FILE__) . '/../loader.php');

$CronsList = array(	'Tbc'	=> array('EndOfBusinessDay'		=> ''));

Cron::init($CronsList);

?>