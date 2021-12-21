<?php
date_default_timezone_set('Asia/Taipei');

class Connection
{

    public PDO $pdo;

    public function __construct()
    {

        $servername = "localhost";
        $username = "root";
        $password = "";
        $db_name = "note_app";

        try {
            $this->pdo = new PDO("mysql:host=$servername;dbname=$db_name", $username, $password);
            // set the PDO error mode to exception
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully";
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

    }

    // 取得筆記
    public function getNotes()
    {
        $mysqlRequest = "SELECT * FROM notes ORDER BY created_date ASC";
        $statement = $this->pdo->prepare($mysqlRequest);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    // 新增筆記
    public function addNote($note)
    {
        $mysqlRequest = "INSERT INTO notes (title, description, created_date) VALUES (:title, :description, :date)";
        $statement = $this->pdo->prepare($mysqlRequest);
        $statement->bindValue('title', $note['title']);
        $statement->bindValue('description', $note['description']);
        $statement->bindValue('date', date('Y-m-d H:i:s'));
        return $statement->execute();
    }

    // 刪除筆記
    public function removeNote($id)
    {
        $mysqlRequest = "DELETE FROM notes WHERE id = :id";
        $statement = $this->pdo->prepare($mysqlRequest);
        $statement->bindValue('id', $id);
        return $statement->execute();
    }

    // 取得筆記(ID)
    public function getNoteByID($id)
    {
        $mysqlRequest = "SELECT * FROM notes where id = :id";
        $statement = $this->pdo->prepare($mysqlRequest);
        $statement->bindValue('id', $id);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    // 更新筆記(ID,NOTE)
    public function updateNote($id, $note)
    {
        $mysqlRequest = "UPDATE notes set title = :title, description = :description WHERE id = :id";
        $statement = $this->pdo->prepare($mysqlRequest);
        $statement->bindValue('id', $id);
        $statement->bindValue('title', $note['title']);
        $statement->bindValue('description', $note['description']);
        return $statement->execute();
    }

}

return new Connection();
