<?php

class Categorias extends Controller { 

    public function __construct() {
        $this->categoriaModel = $this->model('Categoria');
    }

    public function index() {
        $data = [
            'categorias' => $this->categoriaModel->getAll()
        ];
        $this->view('pages/categorias/index', $data);
    }

    public function cadastrar() {
        $form = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if (isset($form)) {
            $data = [
                'dsCategoria' => trim($form['dsCategoria']),
                'dsCategoriaErro' => ''
            ];

            if (in_array("", $form)) {
                if (empty($form['dsCategoria'])) $data['dsCategoriaErro'] = "Preencha o campo descrição";
            } else {
                if (!$this->categoriaModel->isExists($data)) {
                    if ($this->categoriaModel->save($data)) {
                        Session::alert('Categoria', 'Categoria cadastrada com sucesso');
                    } else {
                        die("Erro ao salvar a categoria");
                    }
                } else {
                    $data['dsCategoriaErro'] = "Categoria já está cadastrada";
                }
            }
        } else {
            $data = [
                'dsCategoria' => '',
                'dsCategoriaErro' => ''
            ];
        }
        $this->view('pages/categorias/cadastrar', $data);
    }
}