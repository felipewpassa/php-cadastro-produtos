<?php

class Produto {

    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function save($dados) {
        $this->db->query("INSERT INTO produto (nmProduto, dsProduto, idCategoria) VALUE (:nmProduto, :dsProduto, :idCategoria)");
        $this->db->bind("nmProduto", $dados['nmProduto']);
        $this->db->bind("dsProduto", $dados['dsProduto']);
        $this->db->bind("idCategoria", $dados['idCategoria']);

        if ($this->db->executeSql()) {
            return true;
        } else {
            return false;
        }
    }
}