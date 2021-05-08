<?php

class Database {

    private $host = 'localhost';
    private $port = '3305';
    private $username = 'root';
    private $password = 'root';
    private $dbname = 'dbcadastroprodutos';
    private $db;

    public function __construct() {
        $strConnection = 'mysql:host='.$this->host.';port='.$this->port.';dbname='.$this->dbname;
        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];
        try {
            $this->db = new PDO($strConnection, $this->username, $this->password, $options);
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}