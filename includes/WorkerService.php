<?php

include_once __DIR__ . '/UserService.php';

class WorkerService extends UserService {

	public function __construct() {
		parent::__construct();
	}

	public function removeFromQueue($id) {
		$stmt = $this->database->prepare("UPDATE `queue` SET `deleted` = 1 WHERE `queue`.`id` = ?;");
		$stmt->bindParam(1, $id, PDO::PARAM_STR);
		return $stmt->execute();
	}

	public function changeStatus($id, $status) {
		$stmt = $this->database->prepare("UPDATE `queue` SET `status` = ? WHERE `queue`.`id` = ?;");
		$stmt->bindParam(1, $status, PDO::PARAM_STR);
		$stmt->bindParam(2, $id, PDO::PARAM_STR);
		return $stmt->execute();
	}

}
