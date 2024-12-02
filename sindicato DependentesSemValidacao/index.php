<?php

// Autoload das classes - Registra uma função que carrega automaticamente as classes necessárias quando são instanciadas.
spl_autoload_register(function ($class) {
    // Define o caminho para o arquivo da classe com base no nome da classe.
    $SFile = __DIR__ . "/app/Controllers/$class.php";

    // Verifica se o arquivo da classe existe e inclui ele.
    if (file_exists($SFile)) {
        include $SFile;
    } else {
        // Se o arquivo da classe não for encontrado, lança uma exceção.
        throw new Exception("Classe '$class' não encontrada.");
    }
});

// Captura o caminho da URL e divide em um array.
$sPath = isset($_GET['path']) ? explode('/', $_GET['path']) : ['usuario', 'index'];

// Determina o nome da classe do controlador e o método a ser chamado a partir do caminho da URL.
$sControllerName = ucfirst($sPath[0]) . 'Controller'; // Exemplo: 'UsuarioController'
$mMethod = $sPath[1] ?? 'index'; // Define o método, por padrão será 'index' se não houver método na URL.
$mId = $_GET['id'] ?? null; // O ID, caso seja necessário, por exemplo para deletar um usuário

try {
    // Verifica se a classe do controlador existe.
    if (class_exists($sControllerName)) {
        // Instancia o controlador com base no nome da classe.
        $mController = new $sControllerName();
    } else {
        // Se a classe do controlador não for encontrada, lança uma exceção.
        throw new Exception("Controlador '$sControllerName' não encontrado.");
    }

    // Verifica se o método solicitado existe dentro do controlador.
    if (method_exists($mController, $mMethod)) {
        // Chama o método do controlador, passando o ID se necessário (por exemplo, para deletar um usuário).
        $mController->$mMethod($mId);
    } else {
        // Se o método não existir dentro do controlador, lança uma exceção.
        throw new Exception("Método '$mMethod' não encontrado.");
    }
} catch (Exception $e) {
    // Caso ocorra algum erro durante a execução, exibe a mensagem de erro.
    echo "Erro: " . $e->getMessage();
}

