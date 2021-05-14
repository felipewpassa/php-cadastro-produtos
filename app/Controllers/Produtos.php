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
            } else {
                if(Validate::alphaNumeric($form['nmProduto'])) { 
                    $data['nmProdutoErro'] = "Deve conter apenas [A-Za-z0-9]";
                } else {
                    if (!$this->produtoModel->isExists($data['nmProduto'])) {
                        if ($this->produtoModel->save($data)) {
                            $lastInsertId = (int) $this->produtoModel->getLastInsertId();
                            $upload = new Upload();
                            $arrayFileUpload = array_key_exists('image', $_FILES) ? $upload->reArrayFiles($_FILES['image']) : [];
                            foreach($arrayFileUpload as $key => $fileToUpload) {
                                $upload->imagem($fileToUpload);
                                if($upload->getResult()) {
                                    $dataImage = [
                                        'dsImagem' => trim($form['dsImagem'][$key]),
                                        'nomeDoArquivo' => $upload->getResult(),
                                        'idProduto' => $lastInsertId
                                    ];
                                    if ($dataImage['nomeDoArquivo']) {
                                        $this->produtoModel->saveImagemProduto($dataImage);
                                    }
                                } else {
                                    echo $upload->getError();
                                }
                            }
                            Session::alert('Produto', 'Produto cadastrado com sucesso');
                        } else {
                            die("Erro ao salvar a produto");
                        }
                    } else {
                        Session::alert('Produto', 'Produto já está cadastrado', 'alert alert-danger alert-dismissible fade show');
                    }
                }
            }
        } else {
            $data = [
                'nmProduto' => '',
                'dsProduto' => '',
                'idCategoria' => 0,
                'categorias' => $categorias
            ];
        }
        $this->view('pages/produtos/cadastrar', $data);
    }

    public function excluir($id) {
        $id = filter_var($id, FILTER_VALIDATE_INT);
        $method = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING);
        if($id && $method == 'DELETE') {
            if ($this->produtoModel->delete($id)) {
                var_dump(http_response_code(200));
                return;
            }
        }
        var_dump(http_response_code(404));
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

    public function editar($id) {
        $form = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $categorias = $this->categoriaModel->getAll();
        $produto = $this->produtoModel->getById($id);
        $imagens = $this->imagemModel->getByIdProduto($id);
        if (isset($form)) {
            $data = [
                'idProduto' => $id,
                'nmProduto' => trim($form['nmProduto']),
                'dsProduto' => trim($form['dsProduto']),
                'idCategoria' => trim($form['idCategoria']),
                'imagens' => $imagens[0]->idImagem  !== null ? $imagens : [],
                'categorias' => $categorias,
                'nmProdutoErro' => '',
                'dsProdutoErro' => ''
            ];
            var_dump($form);
            if (in_array("", $form)) {
                if (empty($form['nmProduto'])) $data['nmProdutoErro'] = "Preencha o nome do produto";
                if (empty($form['dsProduto'])) $data['dsProdutoErro'] = "Preencha a descrição do produto";
            } else {
                if ($this->produtoModel->update($data)) {
                    $upload = new Upload();
                    if (array_key_exists('image', $_FILES)) {
                        $arrayFileUpload = $upload->reArrayFiles($_FILES['image']);
                        foreach($arrayFileUpload as $key => $fileToUpload) {
                            $upload->imagem($fileToUpload);
                            if($upload->getResult()) {
                                $dataImage = [
                                    'dsImagem' => trim($form['dsImagem'][$key]),
                                    'nomeDoArquivo' => $upload->getResult(),
                                    'idProduto' => $id
                                ];
                                if ($dataImage['nomeDoArquivo']) {
                                    $this->produtoModel->saveImagemProduto($dataImage);
                                }
                            }
                        }
                    }
                    Session::alert('Produto', 'Produto editado com sucesso');
                } else {
                    die("Erro ao salvar a produto");
                }
                
            }
        } else {
            
            $data = [
                'idProduto' => $produto->idProduto,
                'nmProduto' => $produto->nmProduto,
                'dsProduto' => $produto->dsProduto,
                'idCategoria' => $produto->idCategoria,
                'imagens' => $imagens[0]->idImagem  !== null ? $imagens : [],
                'categorias' => $categorias,
                'nmProdutoErro' => '',
                'dsProdutoErro' => ''
            ];
        }
        $this->view('pages/produtos/editar', $data);
    }
}