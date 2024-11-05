<?php
class Paginas extends Controller {

    // Método padrão chamado quando a URL corresponde a 'paginas/index'
    public function index() {
        // Define os dados a serem passados para a view
        $dados = [
            'tituloPagina' => 'Páginas' // Título da página
        ];

        // Chama a view correspondente, passando os dados
        $this->view('paginas/home', $dados);
    }

    // Método chamado quando a URL corresponde a 'paginas/sobre'
    public function sobre() {
        // Define os dados a serem passados para a view
        $dados = [
            'tituloPagina' => 'Páginas sobre nós!' // Título da página sobre
        ];

        // Chama a view correspondente, passando os dados
        $this->view('paginas/sobre', $dados);
    }

}
