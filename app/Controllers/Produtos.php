<?php

class Produtos extends Controller {

    public function __construct() {
        $this->produtoModel = $this->model('Produto');
        $this->categoriaModel = $this->model('Categoria');
        $this->imagemModel = $this->model('Imagem');
    }

    public function index() {
        $data = [
            'produtos' => $this->produtoModel->getAll()
        ];
        $this->view('pages/produtos/index', $data);
    }

    public function cadastrar() {
        $form = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $categorias = $this->categoriaModel->getAll();
        $imagesMoved = array();
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
                $upload = new Upload();
                $arrayFileUpload = $upload->reArrayFiles($_FILES['image']);
                foreach($arrayFileUpload as $key => $fileToUpload) {
                    $upload->imagem($fileToUpload);
                    if($upload->getResult()) {
                        array_push($imagesMoved, $upload->getResult());
                    } else {
                        echo $upload->getError();
                    }
                }

                if ($this->produtoModel->save($data)) {
                    $lastInsertId = (int) $this->produtoModel->getLastInsertId();
                    foreach($imagesMoved as $imageName) {
                        $dataImage = [
                            'dsImagem' => 'teste',
                            'nomeDoArquivo' => $imageName,
                            'idProduto' => $lastInsertId
                        ];
                        $this->produtoModel->saveImagemProduto($dataImage);
                    }
                    Session::alert('Produto', 'Produto cadastrado com sucesso');
                } else {
                    die("Erro ao salvar a produto");
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

    public function excluirImagem($id) {
        $id = filter_var($id, FILTER_VALIDATE_INT);
        $method = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING);
        if($id && $method == 'DELETE') {
            if ($this->imagemModel->delete($id)) {
                var_dump(http_response_code(200));
                return;
            }
        }
        var_dump(http_response_code(404));
    }
}