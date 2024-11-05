<?php

class Controller {

    // Método privado para carregar um modelo
    private function model($model) {
        // Inclui o arquivo do modelo correspondente
        require_once '../app/Models/' . $model . '.php';
        // Retorna uma nova instância do modelo
        return new $model;
    }

    // Método público para carregar uma view
    public function view($view, $dados = []) {
        // Define o caminho do arquivo da view
        $arquivo = ('../app/Views/' . $view . '.php');
        // Verifica se o arquivo da view existe
        if (file_exists($arquivo)):
            // Se existir, inclui o arquivo
            require_once $arquivo;
        else:
            // Se não existir, exibe uma mensagem de erro e interrompe a execução
            die('O arquivo de view não existe!');
        endif;
    }

}
