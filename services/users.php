<?php
include_once 'db.php';

class UsersService
{
    private $database;

    public function __construct($db)
    {
        $this->database = $db;
    }

    public function getUsers()
    {
        $conn = $this->database->connection();

        $stmt = $conn->prepare("SELECT * FROM users");
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $data = $stmt->fetchAll();

        return $data;
    }

    public function getUser($email)
    {
        $conn = $this->database->connection();

        $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->bindParam(1, $email, PDO::PARAM_STR);
        $stmt->execute();
        $data = $stmt->fetch();

        if ($data) {
            return $data;
        } else {
            throw new Exception('Not found');
        }
    }
}