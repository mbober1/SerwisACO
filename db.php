<?php

class Database
{
    private $dbserver;
    private $dbuser;
    private $dbpassword;
    private $dbname;
    private $connection;

    public function __construct($server, $user, $password, $db)
    {
        $this->dbserver = $server;
        $this->dbuser = $user;
        $this->dbpassword = $password;
        $this->dbname = $db;

        $this->connect();
    }

    public function __destruct()
    {
        $connection = null;
    }

    public function connect()
    {
        try {
            $this->connection = new PDO("mysql:host=$this->dbserver;dbname=$this->dbname", $this->dbuser, $this->dbpassword);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Could not connect to database! (" . $e->getMessage() . ")";
        }
    }

    public function connection()
    {
        return $this->connection;
    }
}