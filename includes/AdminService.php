<?php

include_once __DIR__ . '/WorkerService.php';

final class AdminService extends WorkerService {

	public function __construct() {
		parent::__construct();
	}

	public function changeUserPermission($id, $new_perm) {
		$stmt = $this->database->prepare("UPDATE `users` SET `permission` = ? WHERE `id` = ?;");
		$stmt->bindParam(1, $new_perm, PDO::PARAM_STR);
		$stmt->bindParam(2, $id, PDO::PARAM_STR);
		return $stmt->execute();
	}

	public function addLog($userid, $title, $descript, $origin, $itemid) {
		$stmt = $this->database->prepare("INSERT INTO `logs` (`id`, `user_id`, `action_title`, `action_description`, `origin`, `item_id`) VALUES (NULL, :userid, :title, :descript, :origin, :itemid);");
		$stmt->bindValue(':userid', $userid, PDO::PARAM_STR);
		$stmt->bindValue(':title', $title, PDO::PARAM_STR);
		$stmt->bindValue(':descript', $descript, PDO::PARAM_STR);
		$stmt->bindValue(':origin', $origin, PDO::PARAM_STR);
		$stmt->bindValue(':itemid', $itemid, PDO::PARAM_STR);
		return $stmt->execute();
	}

	public function getLog() {
		return $this->database->query("SELECT * FROM `logs` ")->fetchAll(PDO::FETCH_ASSOC);
	}
}
