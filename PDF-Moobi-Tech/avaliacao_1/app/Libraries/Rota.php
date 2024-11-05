<?php

class Rota {

    private $controlador = 'Paginas';     // Controlador padrão

    private $metodo = 'index'; // Método padrão a ser chamado se nenhum método específico for indicado na URL

    private $parametros = [];


    // Construtor da classe
    public function __construct() {
        // Tenta obter a URL, se não existir, usa um array com 0
        $url = $this->url() ? $this->url() : [0];

        // Verifica se o arquivo do controlador existe
        if(file_exists('../app/Controllers/' . ucwords($url[0]) . '.php')):
            // Se existir, atualiza o controlador
            $this->controlador = ucwords($url[0]);
            // Remove a primeira parte da URL
            unset($url[0]);
        endif;

        // Inclui o arquivo do controlador
        require_once '../app/Controllers/' . $this->controlador . '.php';
        // Cria uma nova instância do controlador
        $this->controlador = new $this->controlador;

        // Verifica se a URL possui uma segunda parte (método)
        if(isset($url[1])):
            // Verifica se o método existe no controlador atual
            if(method_exists($this->controlador, $url[1])):
                // Se o método existir, atualiza a variável $metodo com o nome do método da URL
                $this->metodo = $url[1];
            endif;
        endif;

        // Atribui os parâmetros da URL à variável $parametros
        $this->parametros = $url ? array_values($url) : [];
        // Atribui os parâmetros da URL à variável $parametros
        call_user_func_array([$this->controlador, $this->metodo], $this->parametros);
    }

    // Método para obter e processar a URL
    private function url() {
        // Pega a URL da requisição e a sanitiza
        $url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);
        if (isset($url)):
            // Remove barras do final e divide a URL em partes
            $url = trim(rtrim($url,'/'));
            $url = explode('/', $url);
            return $url; // Retorna as partes da URL
        endif;
    }
}
