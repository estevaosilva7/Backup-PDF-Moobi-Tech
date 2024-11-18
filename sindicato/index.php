<?php
// Define o caminho base da aplicação
// define('BASE_PATH', '/sindicato/');

// Inclui o controlador principal
require_once __DIR__ . '/app/Controllers/UsuarioController.php';

// Obtem a ação da URL (rota)
$action = $_GET['action'] ?? 'index';

// Instancia o controlador
$controller = new UsuarioController();

// Mapeia as ações para os métodos do controlador
/*switch ($action) {
    case 'login':
        $controller->login();
        break;
    case 'cadastrar':
        $controller->cadastrar();
        break;
    case 'listar':
        $controller->listar();
        break;
    case 'logout':
        $controller->logout();
        break;
    default:
        $controller->index();
        break;
}
*/