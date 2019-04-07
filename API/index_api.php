<?php

header("Content-Type: text/json");

define('APP_PATH', __DIR__.'/');

session_start();

$config = require_once('Config/config.php');

require_once('Framework/Frame.php');

(new Framework\Framework($config))->Run();