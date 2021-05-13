<?php

class Imagem {

    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function delete($idImagem) {
        $this->db->query("DELETE FROM imagem WHERE idImagem = :idImagem");
        $this->db->bind("idImagem", $idImagem);

        if ($this->db->executeSql()) {
            return true;
        } else {
            return false;
        }
    }

    public function getByIdProduto($id) {
        $this->db->query("SELECT img.idImagem, img.dsImagem, img.nomeDoArquivo 
            FROM produto AS pro 
            LEFT JOIN imagem AS img 
            ON pro.idProduto = img.idProduto
            WHERE pro.idProduto = :idProduto");
        $this->db->bind("idProduto", $id);
        return $this->db->executeSqlWithResults();
    }
}