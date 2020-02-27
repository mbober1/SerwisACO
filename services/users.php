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

    // public function addStudent($student)
    // {
    //     $conn = $this->database->connection();

    //     $stmt = $conn->prepare("INSERT INTO students (id, first_name, last_name, gender, course) VALUES (?, ?, ?, ?, ?)");
    //     $stmt->bindParam(1, $student->id, PDO::PARAM_INT);
    //     $stmt->bindParam(2, $student->first_name, PDO::PARAM_STR);
    //     $stmt->bindParam(3, $student->last_name, PDO::PARAM_STR);
    //     $stmt->bindParam(4, $student->gender, PDO::PARAM_STR);
    //     $stmt->bindParam(5, $student->course, PDO::PARAM_INT);
    //     $stmt->execute();

    //     return $this->getStudents();
    // }

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

    // public function updateStudent($id, $student)
    // {
    //     $conn = $this->database->connection();

    //     $stmt = $conn->prepare("UPDATE students SET first_name = ?, last_name = ?, gender = ?, course = ? WHERE id = ?");
    //     $stmt->bindParam(1, $student->first_name, PDO::PARAM_STR);
    //     $stmt->bindParam(2, $student->last_name, PDO::PARAM_STR);
    //     $stmt->bindParam(3, $student->gender, PDO::PARAM_STR);
    //     $stmt->bindParam(4, $student->course, PDO::PARAM_INT);
    //     $stmt->bindParam(5, $id, PDO::PARAM_INT);
    //     $stmt->execute();

    //     return $this->getStudents();
    // }

    // public function deleteStudent($index)
    // {
    //     $conn = $this->database->connection();

    //     $stmt = $conn->prepare("DELETE FROM students WHERE id = ?");
    //     $stmt->bindParam(1, $index, PDO::PARAM_INT);
    //     $stmt->execute();

    //     return $this->getStudents();
    // }
}