<?php

class UsersService {

	private $database;

	public function __construct() {
		global $db;
		$this->database = $db;
	}

	public function getUsers() {
		$stmt = $db->prepare("SELECT * FROM users");
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		$stmt->execute();
		$data = $stmt->fetchAll();

		return $data;
	}

	public function getUser($email) {
		$stmt = $this->database->prepare("SELECT * FROM users WHERE email=?");
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		$stmt->bindParam(1, $email, PDO::PARAM_STR);
		$stmt->execute();
		$data = $stmt->fetch();

		if ($data) {
			return $data;
		} else {
			return false;
			// throw new Exception('Not found');
		}
	}

	public function signup($email, $hash, $firstname, $lastname) {
		$stmt = $this->database->prepare("INSERT INTO `users` (`id`, `email`, `password`, `firstname`, `lastname`) VALUES (NULL, :email, :pass, :firstname, :lastname);");
		$stmt->bindValue(':email', $email, PDO::PARAM_STR);
		$stmt->bindValue(':pass', $hash, PDO::PARAM_STR);
		$stmt->bindValue(':firstname', $firstname, PDO::PARAM_STR);
		$stmt->bindValue(':lastname', $lastname, PDO::PARAM_STR);
		return $stmt->execute();
	}

	public function addCar($ownerid, $brand, $model, $vin, $mileage, $power) {
		$stmt = $this->database->prepare("INSERT INTO `cars` (`id`, `owner_id`, `brand`, `model`, `vin`, `power`, `mileage`) VALUES (NULL, :ownerid, :brand, :model, :vin, :mileage, :power);");
		$stmt->bindValue(':ownerid', $ownerid, PDO::PARAM_STR);
		$stmt->bindValue(':brand', $brand, PDO::PARAM_STR);
		$stmt->bindValue(':model', $model, PDO::PARAM_STR);
		$stmt->bindValue(':vin', $vin, PDO::PARAM_STR);
		$stmt->bindValue(':mileage', $mileage, PDO::PARAM_STR);
		$stmt->bindValue(':power', $power, PDO::PARAM_STR);
		return $stmt->execute();
	}


	public function getQueue() {
		$stmt = $this->database->prepare('SELECT * FROM `queue`');
		$stmt->execute();
		return $stmt->fetchAll();
	}

	public function addToQueue($carid) {
		$stmt = $this->database->prepare("INSERT INTO `queue` (`id`, `carid`, `status`, `timestamp`) VALUES (NULL, :carid, '0', CURRENT_TIMESTAMP);");
		$stmt->bindValue(':carid', $carid, PDO::PARAM_STR);
		return $stmt->execute();
	}

	public function carInfo($carid) {
		$stmt = $this->database->prepare("SELECT * FROM `cars` WHERE `id` = ?;");
		$stmt->bindParam(1, $carid, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch();
	}

	public function getCars($ownerid) {
		$stmt = $this->database->prepare("SELECT * FROM `cars` WHERE `owner_id` = ?;");
		$stmt->bindParam(1, $ownerid, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetchAll();
	}


}
