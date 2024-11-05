<?php
require_once 'controllers/EmpresaController.php';

$controller = new EmpresaController();
$action = $_GET['action'] ?? 'listar';

switch ($action) {
    case 'criar':
        $controller->criarOuEditar();
        break;
    case 'editar':
        $controller->criarOuEditar($_GET['id']);
        break;
    case 'salvar':
        $controller->salvar($_POST);
        break;
    case 'deletar':
        $controller->deletar($_GET['id']);
        break;
    default:
        $controller->listar();
}
?>
