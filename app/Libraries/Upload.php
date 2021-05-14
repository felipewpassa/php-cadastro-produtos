<?php

class Upload {

    private $directory;
    private $file;
    private $size;
    private $name;
    private $folder;

    private $result;
    private $error;

    public function __construct($directory = null) {

        $this->directory = $directory ?? 'uploads';

        if (!file_exists($this->directory) && !is_dir($this->directory)) {
            mkdir($this->directory, 0777);        
        }
    }

    public function getResult(): string {
        return $this->result;
    }

    public function getError(): string {
        return $this->error;
    }

    public function imagem(array $image, string $name = null, int $size = null) {
        $this->file = $image;
        $this->name = $name ?? pathinfo($this->file['name'], PATHINFO_FILENAME);
        $this->size = $size ?? 1;

        $extension = pathinfo($this->file['name'], PATHINFO_EXTENSION);

        $extensionsValid = [
            'png', 
            'jpg'
        ];

        $typeValid = [
            'image/jpeg', 
            'image/png'
        ];

        if (!in_array($extension, $extensionsValid)) {
            $this->error = 'Extensão não permitida';
            $this->result = false;
        } elseif (!in_array($this->file['type'], $typeValid)) {
            $this->error = 'Tipo inválido';
            $this->result = false;
        } elseif ($this->size > 2 * (1024 * 1024)) {
            $this->error = 'Arquivo muito grande';
            $this->result = false;
        } else {
            $this->renameFile();
            $this->moveFile();
        }
    }

    private function moveFile() {
        if (move_uploaded_file($this->file['tmp_name'], $this->directory.DIRECTORY_SEPARATOR.$this->name)) {
            $this->result = $this->name;
        } else {
            $this->result = false;
            $this->error = 'Erro ao mover arquivo';
        }
    }

    private function renameFile() {
        $file = $this->name.strrchr($this->file['name'], '.');
        if (file_exists($this->directory.DIRECTORY_SEPARATOR.$file)) {
            $file = $this->name.'-'.uniqid().strrchr($this->file['name'], '.');
        }
        $this->name = $file;
    }

    public function reArrayFiles($file_post) {

        $file_ary = array();
        $file_count = count($file_post['name']);
        $file_keys = array_keys($file_post);
    
        for ($i=0; $i<$file_count; $i++) {
            foreach ($file_keys as $key) {
                $file_ary[$i][$key] = $file_post[$key][$i];
            }
        }
    
        return $file_ary;
    }
}
