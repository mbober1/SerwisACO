<?php

class UserService {

	protected $database;

	public function __construct() {
		global $db;
		$this->database = $db;
	}

	public function getUsers() {
		return $this->database->query("SELECT * FROM users")->fetchAll(PDO::FETCH_ASSOC);
	}

	public function getUser($email) {
		$stmt = $this->database->prepare("SELECT * FROM users WHERE email=?");
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
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

	public function signup($email, $hash, $firstname, $lastname, $phone, $addres) {
		$stmt = $this->database->prepare("INSERT INTO `users` (`id`, `firstname`, `lastname`, `address_id`, `email`, `phone`, `password`, `permission`, `deleted`) VALUES (NULL, :firstname, :lastname, :addres, :email, :phone, :pass, '0', '0');");
		$stmt->bindValue(':email', $email, PDO::PARAM_STR);
		$stmt->bindValue(':pass', $hash, PDO::PARAM_STR);
		$stmt->bindValue(':firstname', $firstname, PDO::PARAM_STR);
		$stmt->bindValue(':lastname', $lastname, PDO::PARAM_STR);
		$stmt->bindValue(':phone', $phone, PDO::PARAM_STR);
		$stmt->bindValue(':addres', $addres, PDO::PARAM_STR);
		return $stmt->execute();
	}

	public function addAddres($city, $code, $street, $flat_number) {
		$stmt = $this->database->prepare("INSERT INTO `addresses` (`id`, `city`, `postal_code`, `street`, `flat_number`) VALUES (NULL, :city, :code, :street, :flat_number);");
		$stmt->bindValue(':city', $city, PDO::PARAM_STR);
		$stmt->bindValue(':code', $code, PDO::PARAM_STR);
		$stmt->bindValue(':street', $street, PDO::PARAM_STR);
		$stmt->bindValue(':flat_number', $flat_number, PDO::PARAM_STR);
		$stmt->execute();

		$stmt2 = $this->database->prepare("SELECT MAX(id) FROM `addresses`");
		$stmt2->execute();
		return	$stmt2->fetch();
	}

	public function addCar($ownerid, $brand, $model, $vin, $mileage, $power, $engine_capacity, $fuel, $body_color, $number_doors) {
		$stmt = $this->database->prepare("INSERT INTO `cars` (`id`, `owner_id`, `brand`, `model`, `vin`, `power`, `mileage`, `engine_capacity`, `fuel`, `body_color`, `number_doors`) VALUES (NULL, :ownerid, :brand, :model, :vin, :power, :mileage, :engine_capacity, :fuel, :body_color, :number_doors, 0);");
		$stmt->bindValue(':ownerid', $ownerid, PDO::PARAM_STR);
		$stmt->bindValue(':brand', $brand, PDO::PARAM_STR);
		$stmt->bindValue(':model', $model, PDO::PARAM_STR);
		$stmt->bindValue(':vin', $vin, PDO::PARAM_STR);
		$stmt->bindValue(':mileage', $mileage, PDO::PARAM_STR);
		$stmt->bindValue(':power', $power, PDO::PARAM_STR);
		$stmt->bindValue(':engine_capacity', $engine_capacity, PDO::PARAM_STR);
		$stmt->bindValue(':fuel', $fuel, PDO::PARAM_STR);
		$stmt->bindValue(':body_color', $body_color, PDO::PARAM_STR);
		$stmt->bindValue(':number_doors', $number_doors, PDO::PARAM_STR);
		return $stmt->execute();
	}

	public function getQueue() {
		return $this->database->query("SELECT * FROM `queue` WHERE `status` != 4")->fetchAll(PDO::FETCH_ASSOC);
	}

	public function getQueueId($id) {
		$stmt = $this->database->prepare("SELECT * FROM `queue` WHERE `id` = ?;");
		$stmt->bindParam(1, $id, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch();
	}

	public function addToQueue($carid, $failure) {
		$stmt = $this->database->prepare("INSERT INTO `queue` (`id`, `car_id`, `status`, `create_date`, `last_modified`, `start_repair_date`, `end_repair_date`, `failure`, `repair_notes`, `deleted`) VALUES (NULL, :carid, '0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL, NULL,  :failure, NULL, '0');");
		$stmt->bindValue(':carid', $carid, PDO::PARAM_STR);
		$stmt->bindValue(':failure', $failure, PDO::PARAM_STR);
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

	public function checkMyQueue($ownerid) {
		$carIds = array_column($this->getCars($ownerid), 'id');
		$in = join(',', array_fill(0, count($carIds), '?'));
		if (!$in)
			return [];
		$stmt = $this->database->prepare('SELECT * FROM `queue` WHERE car_id IN (' . $in . ')');
		$stmt->execute($carIds);
		return $stmt->fetchAll();
	}

}
