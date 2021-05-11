<?php

class Produtos extends Controller {

    public function __construct() {
        $this->produtoModel = $this->model('Produto');
        $this->categoriaModel = $this->model('Categoria');
    }

    public function index() {
        $this->view('pages/produtos/index');
    }

    public function cadastrar() {
        $form = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $categorias = $this->categoriaModel->getAll();
        if (isset($form)) {
            $data = [
                'nmProduto' => trim($form['nmProduto']),
                'dsProduto' => trim($form['dsProduto']),
                'idCategoria' => trim($form['idCategoria']),
                'categorias' => $categorias
            ];

            if (in_array("", $form)) {
                if (empty($form['nmProduto'])) $data['nmProdutoErro'] = "Preencha o nome do produto";
                if (empty($form['dsProduto'])) $data['dsProdutoErro'] = "Preencha a descrição do produto";
                if (empty($form['idCategoria'])) $data['idCategoriaErro'] = "Selecione uma categoria";
            } else {
                
                if ($this->produtoModel->save($data)) {
                    Session::alert('Produto', 'Produto cadastrado com sucesso');
                } else {
                    die("Erro ao salvar a categoria");
                }
            }

        } else {
            $data = [
                'nmProduto' => '',
                'dsProduto' => '',
                'idCategoria' => '',
                'categorias' => $categorias
            ];
        }
        $this->view('pages/produtos/cadastrar', $data);
    }
}