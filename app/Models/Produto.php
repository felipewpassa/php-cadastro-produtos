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

    public function getAll() {
        $this->db->query("SELECT pro.idProduto, pro.nmProduto, pro.dsProduto, img.idImagem, img.nomeDoArquivo FROM produto AS pro LEFT JOIN imagem AS img ON pro.idProduto = img.idProduto");
        return $this->db->executeSqlWithResultsFetchGroup();
    }

    public function delete($idProduto) {
        $this->db->query("DELETE FROM imagem WHERE idProduto = :idProduto; DELETE FROM produto WHERE idProduto = :idProduto");
        $this->db->bind("idProduto", $idProduto);

        if ($this->db->executeSql()) {
            return true;
        } else {
            return false;
        }
    }

    public function getById($id) {
        $this->db->query("SELECT pro.idProduto, pro.nmProduto, pro.idCategoria, cat.dsCategoria, pro.dsProduto 
            FROM produto AS pro 
            INNER JOIN categoria as cat
            ON cat.idCategoria = pro.idCategoria 
            WHERE pro.idProduto = :idProduto");
        $this->db->bind("idProduto", $id);
        return $this->db->executeSqlWithOneResult();
    }

    public function update($dados) {
        $this->db->query("UPDATE produto SET dsProduto = :dsProduto, idCategoria = :idCategoria WHERE idProduto = :idProduto");
        $this->db->bind("dsProduto", $dados['dsProduto']);
        $this->db->bind("idCategoria", $dados['idCategoria']);
        $this->db->bind("idProduto", $dados['idProduto']);

        if ($this->db->executeSql()) {
            return true;
        } else {
            return false;
        }
    }

    public function isExists($nmProduto) {
        $this->db->query("SELECT idProduto, nmProduto, dsProduto FROM produto where nmProduto = :nmProduto");
        $this->db->bind("nmProduto", $nmProduto);

        if ($this->db->executeSqlWithResults()) {
            return true;
        } else {
            return false;
        }
    }
}