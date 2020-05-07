<?php

function getSiteUrl() {
	return MAIN_SITE_URL;
}

function getSiteDir() {
	return MAIN_SITE_DIR;
}

// HELPFUL FUNCTIONS

function isJSON($string) {
	$data = json_decode($string, true);
	if (json_last_error() != JSON_ERROR_NONE)
		return false;
	return $data;
}

// USERS FUNCTIONS

function isLogged() {
	return !empty($_SESSION['user_data']['logged_in']);
}

function getUserID() {
	if (isLogged())
		return $_SESSION['user_data']['user_id'];
	else
		return 0;
}

function getUserName() {
	if (isLogged())
		return $_SESSION['user_data']['user_firstname'];
	else
		return 0;
}

function getUserPermissions() {
	return $_SESSION['user_data']['permissions'];
}

$status = array(0 => "Złożono zlecenie", 1 => "Przyjęto", 2 => "W trakcie naprawy", 3 => "Do odbioru", 4 => "Zakończono");
$user_permissions = array(0 => "client", 1 => "worker", 2 => "admin");
