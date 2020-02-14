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

        if ($this->pdo == null) {
            $this->pdo = new \PDO("sqlite:" . Config::PATH_TO_SQLITE_FILE);
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

    public function getLists()
    {
        if ($this->pdo == null) {
            $this->pdo = new \PDO("sqlite:" . Config::PATH_TO_SQLITE_FILE);
                    }
        try {
            $sql = "
                SELECT * FROM taskList WHERE id = '1'
            ";

            $result = $this->pdo->query( $sql );

            return $result->fetch(PDO::FETCH_ASSOC);

        } catch (\Exception $e) {
            die($e->getMessage());
        }

    }

    public function createList($listName= array()){

        if ($this->pdo == null) {
            $this->pdo = new \PDO("sqlite:" . Config::PATH_TO_SQLITE_FILE);
        }
        try {
            $sql = "
                INSERT INTO taskList (taskName)
                VALUES ("."'".$listName['taskName']."')
            ";

            $result = $this->pdo->query( $sql);
            return $result->fetch(PDO::FETCH_ASSOC);

        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }
}