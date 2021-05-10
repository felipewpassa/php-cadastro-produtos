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

    public function editar($id) {
        $form = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if (isset($form)) {
            $data = [
                'idCategoria' => $id,
                'dsCategoria' => trim($form['dsCategoria']),
                'dsCategoriaErro' => ''
            ];

            if (in_array("", $form)) {
                if (empty($form['dsCategoria'])) $data['dsCategoriaErro'] = "Preencha o campo descrição";
            } else {
                if (!$this->categoriaModel->isExists($data)) {
                    if ($this->categoriaModel->update($data)) {
                        Session::alert('Categoria', 'Categoria editada com sucesso');
                    } else {
                        die("Erro ao editar a categoria");
                    }
                } else {
                    $data['dsCategoriaErro'] = "A categoria já existe";
                }
            }
        } else {
            $categoria = $this->categoriaModel->getById($id);
            $data = [
                'idCategoria' => $categoria->idCategoria,
                'dsCategoria' => $categoria->dsCategoria,
                'dsCategoriaErro' => ''
            ];
        }
        $this->view('pages/categorias/editar', $data);
    }

    public function excluir($id) {
        $id = filter_var($id, FILTER_VALIDATE_INT);
        $method = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING);
        if($id && $method == 'DELETE') {
            var_dump($this->categoriaModel->delete($id));
            if ($this->categoriaModel->delete($id)) {
                var_dump(http_response_code(200));
                return;
            }
        }
        var_dump(http_response_code(404));
    }
}