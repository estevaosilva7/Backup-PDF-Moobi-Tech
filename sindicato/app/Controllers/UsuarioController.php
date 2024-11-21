<?php

// Requer os arquivos necessários para o funcionamento do controlador de usuário.
require_once __DIR__ . '/../Database/MoobiDatabaseHandler.php';
require_once __DIR__ . '/../Models/UsuarioModel.php';

/**
 * Controlador para gerenciar as ações relacionadas aos usuários.
 * Contém métodos para login, cadastro, listagem e logout de usuários.
 *
 * @author Estevão carlosestevao@moobitech.com.br
 */
class UsuarioController
{
    // Instância do modelo de usuário para manipulação dos dados do usuário.
    private $usuarioModel;

    // Instância do manipulador de banco de dados para operações de acesso ao banco.
    private $dbHandler;

    /**
     * Construtor da classe UsuarioController.
     * Inicializa a conexão com o banco de dados e o modelo de usuário.
     */
    public function __construct()
    {
        // Cria uma nova instância do manipulador de banco de dados.
        $this->dbHandler = new MoobiDatabaseHandler();

        // Cria uma nova instância do modelo de usuário.
        $this->usuarioModel = new UsuarioModel($this->dbHandler);
    }

    /**
     * Exibe a tela inicial, geralmente a página de login.
     */
    public function index()
    {
        // Exibe a view de login.
        require __DIR__ . '/../Views/LoginView.php';
    }

    /**
     * Realiza o login do usuário, validando o nome de usuário e senha.
     * Caso o login seja bem-sucedido, inicia uma sessão.
     */
    public function login()
    {
        // Verifica se a requisição foi feita via método POST (formulário enviado).
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtém os dados do formulário de login.
            $mNome = $_POST['nome'];
            $mSenha = $_POST['senha'];

            // Verifica se o usuário existe no banco de dados.
            $nUsuario = $this->usuarioModel->verificarUsuario($mNome, $mSenha);

            // Se o usuário foi encontrado, cria a sessão do usuário.
            if ($nUsuario) {
                session_start(); // Inicia a sessão.

                // Armazena as informações do usuário na sessão.
                $_SESSION['usuario'] = [
                    'id' => $nUsuario['usu_Id'],
                    'nome' => $nUsuario['usu_Nome'],
                    'tipo' => $nUsuario['usu_Tipo'],
                ];

                // Redireciona o usuário para o dashboard.
                header('Location: /app/Views/DashboardAdminView.php');
                exit(); // Termina o script para evitar que o código continue executando.
            } else {
                // Caso o usuário ou senha estejam incorretos, exibe mensagem de erro.
                echo "<p>Nome ou senha incorretos!</p>";
            }
        }

        // Exibe a view de login.
        require __DIR__ . '/../Views/LoginView.php';
    }

    /**
     * Realiza o cadastro de um novo usuário no sistema.
     * Verifica se os dados são válidos e tenta salvar o novo usuário no banco.
     */
    public function cadastrar()
    {
        // Verifica se o formulário foi enviado via POST.
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtém os dados do formulário de cadastro.
            $mNome = $_POST['nome'];
            $mSenha = $_POST['senha'];
            $mTipo = $_POST['tipo'];

            // Tenta cadastrar o usuário no banco de dados.
            if ($this->usuarioModel->cadastrar($mNome, $mSenha, $mTipo)) {
                // Se o cadastro for bem-sucedido, exibe mensagem de sucesso.
                echo "<p>Usuário cadastrado com sucesso!</p>";
            } else {
                // Caso haja um erro no cadastro (ex: nome de usuário já em uso), exibe mensagem de erro.
                echo "<p>Erro ao cadastrar usuário. Nome já pode estar em uso.</p>";
            }
        }

        // Exibe a view de cadastro de usuário.
        require __DIR__ . '/../Views/CadastroUsuarioView.php';
    }

    /**
     * Lista todos os usuários cadastrados no sistema.
     * Exibe as informações dos usuários na view de listagem.
     */
    public function listar()
    {
        // Obtém a lista de usuários do banco de dados.
        $nUsuario = $this->usuarioModel->listarUsuarios();

        // Exibe a view de listagem de usuários, passando os dados obtidos.
        require __DIR__ . '/../Views/ListarUsuarioView.php';
    }

    /**
     * Realiza o logout do usuário, destruindo a sessão.
     * Redireciona o usuário para a página de login.
     */
    public function logout()
    {
        // Inicia a sessão, se ainda não estiver iniciada.
        session_start();

        // Destrói a sessão do usuário.
        session_destroy();

        // Redireciona o usuário de volta para a página de login.
        header('Location: index.php?action=login');
        exit(); // Termina o script após o redirecionamento.
    }
}

// Verifica qual ação o controlador deve executar a partir da URL (parâmetro 'action').
$action = $_GET['action'] ?? 'index';

// Cria uma nova instância do controlador de usuários.
$controller = new UsuarioController();

// Verifica a ação solicitada e chama o método correspondente.
switch ($action) {
    case 'login':
        $controller->login(); // Chama o método de login.
        break;
    case 'cadastrar':
        $controller->cadastrar(); // Chama o método de cadastro de usuário.
        break;
    case 'listar':
        $controller->listar(); // Chama o método para listar usuários.
        break;
    case 'logout':
        $controller->logout(); // Chama o método de logout.
        break;
    default:
        $controller->index(); // Ação padrão: exibe a página de login.
}
