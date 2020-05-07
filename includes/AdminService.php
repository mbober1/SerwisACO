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

}
