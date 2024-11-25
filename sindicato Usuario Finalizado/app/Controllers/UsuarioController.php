<?php
require_once __DIR__ . '/../Database/MoobiDatabaseHandler.php';
require_once __DIR__ . '/../Models/UsuarioModel.php';
require_once __DIR__ . '/../Config/CustomSessionHandler.php';

/**
 * Controlador para gerenciar as ações relacionadas aos usuários.
 * Contém métodos para login, cadastro, listagem, exclusão e logout de usuários.
 *
 * @author Estevão carlosestevao@moobitech.com.br
 */
class UsuarioController
{
    private $usuarioModel;

    /**
     * Construtor da classe UsuarioController.
     * Inicializa a instância do modelo de usuário com a conexão do banco de dados.
     */
    public function __construct()
    {
        $dbHandler = new MoobiDatabaseHandler();
        $this->usuarioModel = new UsuarioModel($dbHandler);
    }

    /**
     * Exibe a tela inicial.
     */
    public function index()
    {
        require __DIR__ . '/../Views/LoginView.php';
    }

    /**
     * Realiza o login do usuário, validando o nome de usuário e senha.
     * Caso o login seja bem-sucedido, inicia uma sessão e redireciona para o dashboard.
     */
    public function login()
    {
        // Verifica se a requisição foi feita via método POST (formulário enviado).
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtém os dados do formulário de login.
            $mNome = $_POST['nome'];
            $sSenha = $_POST['senha'];

            // Verifica se o usuário existe no banco de dados.
            $nUsuario = $this->usuarioModel->verificarUsuario($mNome, $sSenha);
            var_dump($nUsuario); // Depuração

            // Se o usuário foi encontrado, cria a sessão do usuário.
            if ($nUsuario) {
                CustomSessionHandler::set('usuario', $nUsuario);
                // Redireciona para o dashboard após login bem-sucedido.
                header('Location: /app/Views/DashboardAdminView.php');
                exit(); // Termina o script para evitar execução posterior.
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
            $sSenha = $_POST['senha'];
            $mTipo = $_POST['tipo'];

            // Valida o nome de usuário (deve conter pelo menos uma letra e pode conter letras e números).
            if (!preg_match('/^(?=.*[a-zA-Z])[a-zA-Z0-9]+$/', $mNome)) {
                echo "<p>O nome de usuário deve conter pelo menos uma letra e pode incluir apenas letras e números.</p>";
                return require __DIR__ . '/../Views/CadastroUsuarioView.php';
                exit(); // Termina a execução após validação.
            }

            // Tenta cadastrar o usuário no banco de dados.
            if ($this->usuarioModel->cadastrar($mNome, $sSenha, $mTipo)) {
                echo "<p>Usuário cadastrado com sucesso!</p>";
            } else {
                echo "<p>ALERTA: Nome de usuário já em uso!</p>";
            }
        }

        // Exibe a view de cadastro de usuário.
        require __DIR__ . '/../Views/CadastroUsuarioView.php';
        exit(); // Termina o script após a exibição.
    }


    /**
     * Lista todos os usuários cadastrados no sistema.
     * Exibe as informações dos usuários na view de listagem.
     */
    public function listar()
    {
        // Obtém a lista de usuários do banco de dados.
        $usuarios = $this->usuarioModel->listarUsuarios();

        // Exibe a view de listagem de usuários, passando os dados obtidos.
        require __DIR__ . '/../Views/ListarUsuarioView.php';
        exit(); // Termina o script após a exibição.
    }

    /**
     * Realiza a exclusão de um usuário do sistema, dado o ID.
     * Exibe mensagem de sucesso ou erro conforme o resultado da exclusão.
     *
     * @param int $id ID do usuário a ser deletado.
     */
    public function deletar($id)
    {
        // Verifica se o ID é válido e numérico.
        if ($id && is_numeric($id)) {
            // Verifica se a exclusão foi bem-sucedida.
            $bResultado = $this->usuarioModel->deletarUsuario($id);

            if ($bResultado) {
                echo "<p>Usuário deletado com sucesso!</p>";
            } else {
                echo "<p>Erro ao deletar o usuário!</p>";
            }
        } else {
            echo "<p>ID inválido!</p>";
        }

        // Redireciona para a listagem de usuários após a operação de exclusão.
        header('Location: /index.php?path=usuario/listar');
        exit(); // Termina o script após o redirecionamento.
    }

    /**
     * Realiza o logout do usuário, destruindo a sessão.
     * Redireciona o usuário para a página inicial.
     */
    public function logout()
    {
        // Destrói a sessão do usuário.
        CustomSessionHandler::destroy();
        // Redireciona o usuário para a página inicial.
        header('Location: /index.php');
        exit(); // Termina o script após o redirecionamento.
    }
}
