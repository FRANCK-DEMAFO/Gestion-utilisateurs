<?php

class Database
{
    private $dbHost;
    private $dbName;
    private $dbUsername;
    private $dbUserpassword;
    private \PDO $connection;

    public function __construct()
    {
        $config = require dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'db-config.php';
        $this->dbHost = $config['dbHost'];
        $this->dbName = $config['dbName'];
        $this->dbUsername = $config['dbUsername'];
        $this->dbUserpassword = $config['dbUserpassword'];
        $this->connect();
    }

    public function connect()
    {
        try {
            $this->connection = new PDO("mysql:host=" . $this->dbHost . ";dbname=" . $this->dbName, $this->dbUsername, $this->dbUserpassword);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getConnection(): \PDO
    {
        return $this->connection;
    }

    public function disconnect()
    {
        $this->connection = null;
    }
}
