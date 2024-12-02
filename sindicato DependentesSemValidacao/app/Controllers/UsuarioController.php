<?php
require_once __DIR__ . '/../Database/MoobiDatabaseHandler.php';
require_once __DIR__ . '/../Models/UsuarioModel.php';
require_once __DIR__ . '/../Session/CustomSessionHandler.php';

/**
 * Controlador para gerenciar as ações relacionadas aos usuários.
 * Contém métodos para login, cadastro, listagem, exclusão. edição, atualização e logout de usuários.
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

            // Se o usuário foi encontrado, cria a sessão do usuário.
            if ($nUsuario) {
                CustomSessionHandler::set('usuario', $nUsuario);
                // Redireciona para o dashboard após login bem-sucedido.
                header('Location: /app/Views/DashboardView.php');
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
        // Verifica se o usuário logado é um admin
        $usuarioLogado = CustomSessionHandler::get('usuario');
        if (!$usuarioLogado || $usuarioLogado['usu_Tipo'] != 'admin') {
            echo "<p>Acesso restrito. Somente administradores podem cadastrar usuários.</p>";
            return require __DIR__ . '/../Views/DashboardView.php'; // Redireciona para o Painel de Controle
        }

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

        // Verifica o tipo de usuário logado
        $usuarioLogado = CustomSessionHandler::get('usuario');
        $isAdmin = $usuarioLogado && $usuarioLogado['usu_Tipo'] == 'admin';

        // Exibe a view de listagem de usuários, passando os dados obtidos.
        // Passa também a variável $isAdmin para que a view saiba se o usuário pode realizar ações como excluir.
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
        // Verifica se o usuário logado é um admin
        $usuarioLogado = CustomSessionHandler::get('usuario');
        if (!$usuarioLogado || $usuarioLogado['usu_Tipo'] != 'admin') {
            echo "<p>Acesso restrito. Somente administradores podem excluir usuários.</p>";
            header('Location: /index.php?path=usuario/listar');
            exit(); // Termina o script após redirecionar
        }

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
     * Exibe o formulário de edição de usuário.
     * Realiza a verificação do ID e exibe as informações do usuário para edição.
     *
     * @param int $id ID do usuário a ser editado.
     */
    public function editar($id)
    {
        // Verifica se o usuário logado é um admin
        $usuarioLogado = CustomSessionHandler::get('usuario');
        if (!$usuarioLogado || $usuarioLogado['usu_Tipo'] != 'admin') {
            echo "<p>Acesso restrito. Somente administradores podem editar usuários.</p>";
            header('Location: /index.php?path=usuario/listar');
            exit();
        }

        // Verifica se o ID do usuário é válido e numérico.
        if ($id && is_numeric($id)) {
            // Obtém as informações do usuário pelo ID
            $usuario = $this->usuarioModel->buscarUsuarioPorId($id);

            if (!$usuario) {
                echo "<p>Usuário não encontrado!</p>";
                header('Location: /index.php?path=usuario/listar');
                exit();
            }

            // Exibe a tela de edição com os dados atuais do usuário
            require __DIR__ . '/../Views/EditarUsuarioView.php';
            exit(); // Termina o script após a exibição.
        } else {
            echo "<p>ID inválido!</p>";
            header('Location: /index.php?path=usuario/listar');
            exit();
        }
    }

    /**
     * Atualiza os dados de um usuário no sistema.
     * Verifica se o novo nome de usuário já existe e valida os dados antes de realizar a atualização.
     *
     * @param int $id ID do usuário a ser atualizado.
     */
    public function atualizar($id)
    {
        // Verifica se o usuário logado é um admin
        $usuarioLogado = CustomSessionHandler::get('usuario');
        if (!$usuarioLogado || $usuarioLogado['usu_Tipo'] != 'admin') {
            echo "<p>Acesso restrito. Somente administradores podem editar usuários.</p>";
            header('Location: /index.php?path=usuario/listar');
            exit();
        }

        // Verifica se o ID é válido e numérico.
        if ($id && is_numeric($id)) {
            // Obtém os dados do formulário
            $mNome = $_POST['nome'];
            $mTipo = $_POST['tipo'];

            // Verifica se o novo nome de usuário já existe (exceto para o próprio usuário que está sendo atualizado)
            if ($this->usuarioModel->usuarioNomeExistente($mNome, $id)) {
                // Define a mensagem de erro na sessão
                CustomSessionHandler::set('mensagem_erro', "O nome de usuário já está em uso.");
                // Redireciona de volta para a página de edição
                header("Location: /index.php?path=usuario/editar&id=$id");
                exit();
            }

            // Valida o nome de usuário (deve conter pelo menos uma letra e pode conter letras e números).
            if (!preg_match('/^(?=.*[a-zA-Z])[a-zA-Z0-9]+$/', $mNome)) {
                // Define a mensagem de erro na sessão
                CustomSessionHandler::set('mensagem_erro', "O nome de usuário deve conter pelo menos uma letra e pode incluir apenas letras e números.");
                // Redireciona de volta para a página de edição
                header("Location: /index.php?path=usuario/editar&id=$id");
                exit();
            }

            // Tenta atualizar o usuário no banco de dados
            if ($this->usuarioModel->atualizarUsuario($id, $mNome, $mTipo)) {
                // Define a mensagem de sucesso na sessão
                CustomSessionHandler::set('mensagem_sucesso', "Usuário atualizado com sucesso!");
                // Redireciona para a página de listagem de usuários
                header("Location: /index.php?path=usuario/editar&id=$id");
                exit();
            } else {
                // Define a mensagem de erro na sessão
                CustomSessionHandler::set('mensagem_erro', "Erro ao atualizar o usuário!");
                // Redireciona de volta para a página de edição
                header("Location: /index.php?path=usuario/editar&id=$id");
                exit();
            }
        } else {
            // Define a mensagem de erro na sessão caso o ID seja inválido
            CustomSessionHandler::set('mensagem_erro', "ID inválido!");
            header('Location: /index.php?path=usuario/listar');
            exit();
        }
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
?>