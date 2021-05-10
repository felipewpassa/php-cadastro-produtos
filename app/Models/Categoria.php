<?php

class Categoria {

    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function save($dados) {
        $this->db->query("INSERT INTO categoria (dsCategoria) VALUE (:dsCategoria)");
        $this->db->bind("dsCategoria", $dados['dsCategoria']);

        if ($this->db->executeSql()) {
            return true;
        } else {
            return false;
        }
    }

    public function getAll() {
        $this->db->query("SELECT idCategoria, dsCategoria FROM categoria");
        return $this->db->executeSqlWithResults();
    }
}