<?php

class Database {

    private $host = 'localhost';
    private $port = '3305';
    private $username = 'root';
    private $password = 'root';
    private $dbname = 'dbcadastroprodutos';
    private $db;
    private $statement;

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

    public function query($sql) {
        $this->statement = $this->db->prepare($sql);
    }

    public function bind($key, $value, $type = null) {
        if (is_null($type))  {
            switch(true):
                case is_int($value):
                    $type = PDO::PARAM_INT;
                break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                break;
                default:
                    $type = PDO::PARAM_STR;
            endswitch;
        }
        $this->statement->bindValue($key, $value, $type);
    }

    public function executeSql() {
        return $this->statement->execute();
    }

    public function executeSqlWithResults() {
        $this->executeSql();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function executeSqlWithOneResult() {
        $this->executeSql();
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }

    public function lastInsertId() {
        return $this->db->lastInsertId();
    }

    public function executeSqlWithResultsFetchGroup() {
        $this->executeSql();
        return $this->statement->fetchAll(PDO::FETCH_GROUP);
    }
}