<?php


spl_autoload_register(function ($class) {
    $file = __DIR__ . "/controllers/$class.php";
    if (file_exists($file)) {
        include $file;
    } else {
        throw new Exception("Classe '$class' não encontrada.");
    }
});


$path = isset($_GET['path']) ? explode('/', $_GET['path']) : ['empresa', 'index'];


$controllerName = ucfirst($path[0]) . 'Controller'; 
$method = $path[1] ?? 'index'; 

try {

    if (class_exists($controllerName)) {
        $controller = new $controllerName();
    } else {
        throw new Exception("Controlador '$controllerName' não encontrado.");
    }


    if (method_exists($controller, $method)) {
        $controller->$method();
    } else {
        throw new Exception("Método '$method' não encontrado.");
    }
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
}



