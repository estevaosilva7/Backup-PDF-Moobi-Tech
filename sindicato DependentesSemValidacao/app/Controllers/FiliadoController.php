<?php

require_once __DIR__ . '/../Database/MoobiDatabaseHandler.php';
require_once __DIR__ . '/../Models/FiliadoModel.php';
require_once __DIR__ . '/../Session/CustomSessionHandler.php';

class FiliadoController
{
    private $filiadoModel;

    // O construtor agora espera um parâmetro $dbHandler
    public function __construct()
    {
        $dbHandler = new MoobiDatabaseHandler();
        $this->filiadoModel = new FiliadoModel($dbHandler);
    }

    // Cadastrar novo filiado
    public function cadastrar()
    {
        // Verifica se o usuário logado é um admin
        $usuarioLogado = CustomSessionHandler::get('usuario');
        if (!$usuarioLogado || $usuarioLogado['usu_Tipo'] != 'admin') {
            echo "<p>Acesso restrito. Somente administradores podem cadastrar filiados.</p>";
            return require __DIR__ . '/../Views/DashboardView.php'; // Redireciona para o Painel de Controle
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nome = $_POST['nome'];
            $cpf = $_POST['cpf'];
            $rg = $_POST['rg'];
            $dataNascimento = $_POST['dataNascimento'];
            $idade = $_POST['idade'];
            $empresa = $_POST['empresa'];
            $cargo = $_POST['cargo'];
            $situacao = $_POST['situacao'];
            $telefoneResidencial = $_POST['telefoneResidencial'];
            $celular = $_POST['celular'];

            if ($this->filiadoModel->cadastrar($nome, $cpf, $rg, $dataNascimento, $idade, $empresa, $cargo, $situacao, $telefoneResidencial, $celular)) {
                header("Location: /index.php?path=filiado/listar");
                exit();
            } else {
                // Mensagem de erro caso o cadastro falhe
                $_SESSION['mensagem_erro'] = 'Erro ao cadastrar filiado';
                return require __DIR__ . '/../Views/CadastrarFiliadoView.php'; //
            }
        } else {
            // Carregar a view de cadastro
            require __DIR__ . '/../Views/CadastrarFiliadoView.php';
        }
    }

    // Listar todos os filiados
    public function listar()
    {
        // Verifica se o usuário está logado e se é admin
        $usuarioLogado = CustomSessionHandler::get('usuario');
        $isAdmin = ($usuarioLogado && $usuarioLogado['usu_Tipo'] == 'admin'); // Verifica se o tipo de usuário é admin

        // Recupera a lista de filiados
        $filiados = $this->filiadoModel->listarFiliados();

        // Passa a variável $isAdmin para a view
        require __DIR__ . '/../Views/ListarFiliadoView.php';
    }


    // Editar filiado
    public function editar($id)
    {
        $filiado = $this->filiadoModel->buscarFiliadoPorId($id);
        if ($filiado) {
            require __DIR__ . '/../Views/EditarFiliadoView.php';
            exit();
        } else {
            $_SESSION['mensagem_erro'] = 'Filiado não encontrado';
            header("Location: /index.php?path=filiado/listar");
            exit();
        }
    }

    // Atualizar filiado
    public function atualizar($id)
    {
        // Verifica se o usuário logado é um admin
        $usuarioLogado = CustomSessionHandler::get('usuario');
        if (!$usuarioLogado || $usuarioLogado['usu_Tipo'] != 'admin') {
            echo "<p>Acesso restrito. Somente administradores podem editar usuários.</p>";
            header('Location: /index.php?path=filiado/listar');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Só obter os dados de empresa, cargo e situação para atualização
            $empresa = $_POST['empresa'];
            $cargo = $_POST['cargo'];
            $situacao = $_POST['situacao'];

            // Atualizar os dados do filiado
            if ($this->filiadoModel->atualizarFiliado($id, $empresa, $cargo, $situacao)) {
                $_SESSION['mensagem_sucesso'] = 'Filiado atualizado com sucesso!';
                header("Location: /index.php?path=filiado/editar&id=$id");
                exit();
            } else {
                $_SESSION['mensagem_erro'] = 'Erro ao atualizar filiado';
                header("Location: /index.php?path=filiado/editar&id=$id");
            }
        }
    }


    // Deletar filiado
    public function deletar($id)
    {
        // Verifica se o usuário logado é um admin
        $usuarioLogado = CustomSessionHandler::get('usuario');
        if (!$usuarioLogado || $usuarioLogado['usu_Tipo'] != 'admin') {
            echo "<p>Acesso restrito. Somente administradores podem excluir usuários.</p>";
            header('Location: /index.php?path=filiado/listar');
            exit(); // Termina o script após redirecionar
        }

        // Verifica se o ID é válido
        if (!isset($id) || !is_numeric($id)) {
            $_SESSION['mensagem_erro'] = 'ID inválido';
            header("Location: /index.php?path=filiado/listar");
            exit();
        }

        // Deleta o filiado
        if ($this->filiadoModel->deletarFiliado($id)) {
            header("Location: /index.php?path=filiado/listar");
            exit();
        } else {
            $_SESSION['mensagem_erro'] = 'Erro ao deletar filiado';
            header("Location: /index.php?path=filiado/listar");
            exit();
        }
    }

    public function dependentes($filiadoId)
    {
        // Obtemos os dependentes do filiado
        $dependentes = $this->dependenteModel->listarPorFiliado($filiadoId);

        // Se não houver dependentes, exibe uma mensagem
        if (empty($dependentes)) {
            $mensagem = "Não existem dependentes para este filiado.";
        } else {
            $mensagem = "";
        }

        // Exibe a view de dependentes
        include 'Views/DependenteListarView.php';
    }

}
?>
