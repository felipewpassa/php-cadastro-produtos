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

    public function getLastInsertId() {
        return $this->db->lastInsertId();
    }

    public function saveImagemProduto($dados) {
        $this->db->query("INSERT INTO imagem (dsImagem, nomeDoArquivo, idProduto) VALUE (:dsImagem, :nomeDoArquivo, :idProduto)");
        $this->db->bind("dsImagem", $dados['dsImagem']);
        $this->db->bind("nomeDoArquivo", $dados['nomeDoArquivo']);
        $this->db->bind("idProduto", $dados['idProduto']);

        if ($this->db->executeSql()) {
            return true;
        } else {
            return false;
        }
    }
}