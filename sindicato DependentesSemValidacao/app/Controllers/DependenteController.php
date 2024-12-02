<?php
require_once __DIR__ . '/../Database/MoobiDatabaseHandler.php';
require_once __DIR__ . '/../Models/DependenteModel.php';
require_once __DIR__ . '/../Session/CustomSessionHandler.php';

class DependenteController
{
    private $dependenteModel;

    /**
     * Construtor da classe DependenteController.
     * Inicializa o modelo DependenteModel com a conexão PDO.
     *
     * @param $dbHandler Instância da classe MoobiDatabaseHandler.
     */
    public function __construct()
    {
        $dbHandler = new MoobiDatabaseHandler();
        $this->dependenteModel = new DependenteModel($dbHandler);
    }

    /**
     * Cadastra um dependente.
     *
     * @param int $filiadoId ID do filiado.
     */
    public function cadastrar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtém os dados do formulário de cadastro.
            $nome = $_POST['nome'];
            $dataNascimento = $_POST['dataNascimento'];
            $grauParentesco = $_POST['grauParentesco'];
            $filiadoId = $_POST['filiadoId'];


            // Valida se o `filiadoId` é válido
            if (empty($filiadoId) || !is_numeric($filiadoId)) {
                die("Erro: O ID do filiado é inválido.");
            }

            // Chama o método do modelo para cadastrar o dependente.
            $this->dependenteModel->cadastrarDependente($nome, $dataNascimento, $grauParentesco, $filiadoId);

            header("Location: /index.php?path=dependente/listar&id={$filiadoId}");
            exit;  // Evitar execução de código após o redirecionamento.
        }

        // Obtém o ID do filiado pela URL (GET)
        $filiadoId = $_GET['filiadoId'] ?? null;

        // Valida se o `filiadoId` está definido
        if (!$filiadoId) {
            die("Erro: ID do filiado não fornecido.");
        }

        // Exibe a view de cadastro de dependente.
        require_once __DIR__ . '/../Views/CadastrarDependenteView.php';
    }



    /**
     * Lista os dependentes de um filiado.
     *
     * @param int $filiadoId ID do filiado.
     */
    public function listar($filiadoId)
    {

        // Obtém todos os dependentes de um filiado específico
        $dependentes = $this->dependenteModel->listarPorFiliado($filiadoId);


        require_once __DIR__ . '/../Views/ListarDependenteView.php';

    }


    /**
     * Edita um dependente.
     *
     * @param int $id ID do dependente.
     */
    public function editar($id)
    {
        // Verifica se o método é POST, o que significa que o formulário foi enviado
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Obtém os dados do formulário de edição.
            $nome = $_POST['nome'];
            $dataNascimento = $_POST['dataNascimento'];
            $grauParentesco = $_POST['grauParentesco'];

            // Chama o método do modelo para editar o dependente.
            $this->dependenteModel->editarDependente($id, $nome, $dataNascimento, $grauParentesco);

            // Redireciona para a lista de dependentes após a edição.
            header("Location: /index.php?path=dependente/listar&id=" . $_POST['filiadoId']);
            exit();  // Evitar a execução de código após o redirecionamento.
        }

        // Recupera os dados do dependente para edição
        $dependente = $this->dependenteModel->buscarPorId($id);

        // Verifique se o dependente foi encontrado
        if (!$dependente) {
            die("Erro: Dependente não encontrado.");
        }

        // Exibe a view de edição do dependente
        require_once __DIR__ . '/../Views/EditarDependenteView.php';
    }



    /**
     * Exclui um dependente.
     *
     * @param int $id ID do dependente.
     * @param int $filiadoId ID do filiado ao qual o dependente pertence.
     */
    public function deletar($id)
    {
        $filiadoId = $_GET['filiadoId'];

        // Chama o método do modelo para excluir o dependente.
        $this->dependenteModel->deletarDependente($id);

        // Redireciona para a lista de dependentes.
        header("Location: /index.php?path=dependente/listar&id={$filiadoId}");
        exit;  // Evitar execução de código após o redirecionamento.
    }

}


