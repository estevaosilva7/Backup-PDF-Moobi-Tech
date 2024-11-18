<?php

require_once __DIR__ . '/../Database/MoobiDatabaseHandler.php';
require_once __DIR__ . '/../Models/UsuarioModel.php';

class UsuarioController
{
    private $usuarioModel;
    private $dbHandler;

    public function __construct()
    {
        $this->dbHandler = new MoobiDatabaseHandler();
        $this->usuarioModel = new UsuarioModel($this->dbHandler);
    }

    public function index()
    {
        require __DIR__ . '/../Views/LoginView.php';
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = $_POST['nome'];
            $senha = $_POST['senha'];

            $usuario = $this->usuarioModel->verificarUsuario($nome, $senha);

            if ($usuario) {
                session_start();
                $_SESSION['usuario'] = [
                    'id' => $usuario['usu_Id'],
                    'nome' => $usuario['usu_Nome'],
                    'tipo' => $usuario['usu_Tipo'],
                ];
                header('Location: /app/Views/DashboardAdminView.php');
                exit();
            } else {
                echo "<p>Nome ou senha incorretos!</p>";
            }
        }
        require __DIR__ . '/../Views/LoginView.php';
    }

    public function cadastrar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = $_POST['nome'];
            $senha = $_POST['senha'];
            $tipo = $_POST['tipo'];

            if ($this->usuarioModel->cadastrar($nome, $senha, $tipo)) {
                echo "<p>Usuário cadastrado com sucesso!</p>";
            } else {
                echo "<p>Erro ao cadastrar usuário. Nome já pode estar em uso.</p>";
            }
        }
        require __DIR__ . '/../Views/CadastroUsuarioView.php';
    }

    public function listar()
    {
        $usuarios = $this->usuarioModel->listarUsuarios();
        require __DIR__ . '/../Views/ListarUsuarioView.php';
    }

    public function logout()
    {
        session_start();
        session_destroy();
        header('Location: index.php?action=login');
        exit();
    }
}

$action = $_GET['action'] ?? 'index';
$controller = new UsuarioController();

switch ($action) {
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
}
