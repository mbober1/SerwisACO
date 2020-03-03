<?php
include __DIR__ . '/../.setup/constants.php';
require __DIR__ . '/autoload.php';
require __DIR__ . '/functions.php';

if (DEV_MODE) {
	ini_set('display_errors', 'On');
	error_reporting(E_ALL);
}

ini_set('session.cookie_httponly', 1);
ini_set('session.hash_function', 1);
date_default_timezone_set('UTC');
