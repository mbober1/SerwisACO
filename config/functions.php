<?php

function getSiteUrl(){
	return MAIN_SITE_URL;
}
function getSiteDir(){
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
	// return $_SESSION['logged'];
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





// function mustBeLogged($howToRedirect = false) {
//	if (!isLogged()) {
//		if ($howToRedirect)
//			$_SESSION['login_referer'] = $_SITE_CONFIG['main_directory'];
//		else
//			$_SESSION['login_referer'] = $_SITE_CONFIG['main_directory'] . $_SERVER['REQUEST_URI'];
//		gotoLogin();
//		exit();
//	}

//	if ($_SESSION['user_data']['login_ip'] != $_SERVER['REMOTE_ADDR']) {
//		$_SESSION['status_data'] = [
//			'type' => 'user',
//			'code' => 407,
//		];
//		header('Location: ' . $_SITE_CONFIG['main_directory'] . '/uzytkownik/status');
//		exit();
// }
