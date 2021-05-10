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

    public function isExists($dados) {
        $this->db->query("SELECT dsCategoria FROM categoria WHERE dsCategoria = :dsCategoria");
        $this->db->bind("dsCategoria", $dados['dsCategoria']);

        if ($this->db->executeSqlWithResults()) {
            return true;
        } else {
            return false;
        }
    }

    public function getById($id) {
        $this->db->query("SELECT idCategoria, dsCategoria FROM categoria WHERE idCategoria = :idCategoria");
        $this->db->bind("idCategoria", $id);
        return $this->db->executeSqlWithOneResult();
    }

    public function update($dados) {
        $this->db->query("UPDATE categoria SET dsCategoria = :dsCategoria WHERE idCategoria = :idCategoria");
        $this->db->bind("dsCategoria", $dados['dsCategoria']);
        $this->db->bind("idCategoria", $dados['idCategoria']);

        if ($this->db->executeSql()) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($idCategoria) {
        $this->db->query("DELETE FROM categoria WHERE idCategoria = :idCategoria");
        $this->db->bind("idCategoria", $idCategoria);

        if ($this->db->executeSql()) {
            return true;
        } else {
            return false;
        }
    }
}