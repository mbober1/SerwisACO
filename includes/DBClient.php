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

	public function addLog($user, $action_title, $action_description, $origin, $item_id) {
		$stmt = $this->prepare("INSERT INTO `logs` (`id`, `user_id`, `action_title`, `action_description`, `origin`, `item_id`) VALUES (NULL, :user, :action_title, :action_description, :origin, :item_id);");
		$stmt->bindValue(':user', $user, PDO::PARAM_STR);
		$stmt->bindValue(':action_title', $action_title, PDO::PARAM_STR);
		$stmt->bindValue(':action_description', $action_description, PDO::PARAM_STR);
		$stmt->bindValue(':origin', $origin, PDO::PARAM_STR);
		$stmt->bindValue(':item_id', $item_id, PDO::PARAM_STR);
		return $stmt->execute();
	}

	public function getUser($id) {
		$stmt = $this->prepare("SELECT * FROM `users` WHERE `id` = ?;");
		$stmt->bindParam(1, $id, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch();
	}



	public function addLog($user, $action_title, $action_description, $origin, $item_id) {
		$stmt = $this->prepare("INSERT INTO `logs` (`id`, `user_id`, `action_title`, `action_description`, `origin`, `item_id`) VALUES (NULL, :user, :action_title, :action_description, :origin, :item_id);");
		$stmt->bindValue(':user', $user, PDO::PARAM_STR);
		$stmt->bindValue(':action_title', $action_title, PDO::PARAM_STR);
		$stmt->bindValue(':action_description', $action_description, PDO::PARAM_STR);
		$stmt->bindValue(':origin', $origin, PDO::PARAM_STR);
		$stmt->bindValue(':item_id', $item_id, PDO::PARAM_STR);
		return $stmt->execute();
	}

	public function getUser($id) {
		$stmt = $this->prepare("SELECT * FROM `users` WHERE `id` = ?;");
		$stmt->bindParam(1, $id, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch();
	}



}
