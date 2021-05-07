<?php
class Home extends Controller {

    public function index() {
        $data = [
            'titulo' => 'Pagina Inicial'
        ];
        $this->view('pages/home', $data);
    }

}