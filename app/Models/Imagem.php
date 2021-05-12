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
}