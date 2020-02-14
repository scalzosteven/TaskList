<?php
namespace App;


use PDO;

class SQLiteConnection {

    private $pdo;

    /**
     * return in instance of the PDO object that connects to the SQLite database
     * @return \PDO
     */
    public function connect() {

        $this->newConnection();
        if($this->pdo != null){
            $this->generateTable();
        }

    }

    public function generateTable()
    {
        $command = '
            CREATE TABLE taskList (
               id INTEGER not null
               constraint taskList_pk
                primary key autoincrement,
                taskName TEXT NOT NULL
        )';

        try {
            $this->pdo->exec($command);

        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }

    public function getListsById($id)
    {
        $this->newConnection();
        try {
            $sql = "
                SELECT * FROM taskList WHERE id = $id
                ";
            $result = $this->getQuery($sql);

            return $result->fetch(PDO::FETCH_ASSOC);

        } catch (\Exception $e) {
            die($e->getMessage());
        }

    }

    public function getListsByTaskName($taskName)
    {
        $this->newConnection();
        try {
            $sqlToFind = "
                SELECT * FROM taskList WHERE taskName = '".$taskName."'
                ";
            $result = $this->getQuery($sqlToFind);

            return $result->fetch(PDO::FETCH_ASSOC);

        } catch (\Exception $e) {
            die($e->getMessage());
        }

    }

    public function createList($listName= array()){

        $taskName = $listName['taskName'];
        $resultToFind = $this->getListsByTaskName($taskName);
        if($resultToFind){
            throw new \Exception("Ya existe taskList");
        }

        $this->newConnection();
        try {
            $sql = "
                INSERT INTO taskList (taskName)
                VALUES ("."'".$listName['taskName']."')
                ";
            $result = $this->getQuery($sql);

            return $result->fetch(PDO::FETCH_ASSOC);

        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * @param string $sql
     * @return mixed
     */
    private function getQuery(string $sql)
    {
        return $this->pdo->query($sql);
    }

    private function newConnection(): void
    {
        if ($this->pdo == null) {
            $this->pdo = new \PDO("sqlite:" . Config::PATH_TO_SQLITE_FILE);
        }
    }


}