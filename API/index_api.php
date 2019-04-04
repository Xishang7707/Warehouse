<?php
error_reporting(E_ALL);
header('Content-type:text/json');

define('APP_PATH', __DIR__.'/');

$config = require_once('Config/config.php');

require_once('Framework/Frame.php');

(new Framework\Framework($config))->Run();