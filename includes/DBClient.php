<?php

/**
 * Clasa udostępniająca połączenie do bazy
 *
 * @author Rafał
 */
include __DIR__ . '/../.setup/db_config.php';

class DBClient extends PDO {

	public $conn = null;
	protected $db_host = DB_HOST;
	protected $db_user = DB_USER;
	protected $db_password = DB_PASS;
	protected $db_name = DB_NAME;

	public function __construct() {

		$this->conn = parent::__construct('mysql:host=' . $this->db_host . ';dbname=' . $this->db_name, $this->db_user, $this->db_password, [
				PDO::ATTR_EMULATE_PREPARES => false,
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
				PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
		]);
	}

	public function __destruct() {
		$this->conn = null;
	}

	public function connection() {
		return $this->conn;
	}

	###	MAIN

	public function dateForDB($time = 0) {
		return gmdate("Y-m-d H:i:s", $time);
	}

	public function howManyUpdates() {
		return $this->query('SELECT ROW_COUNT() as `how_much`')->fetch(PDO::FETCH_ASSOC)['how_much'];
	}

	### PARSE
	// For futher purpose
	public function parseMeta($array) {
		$output = [];
		foreach ($array as $value)
			$output[$value['meta_key']] = $value['meta_value'];
		return $output;
	}

}
