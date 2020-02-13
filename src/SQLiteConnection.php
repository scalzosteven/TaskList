<?php
namespace App;


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
            id INTEGER,
            taskName TEXT NOT NULL
        )';

        try {
            $this->pdo->exec($command);

        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }
}