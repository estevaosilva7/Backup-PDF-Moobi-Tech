<?php

class DependenteModel
{
    // Instância do objeto PDO para manipulação do banco de dados.
    private $pdo;

    /**
     * Construtor da classe DependenteModel.
     * Inicializa a conexão com o banco de dados utilizando o manipulador de banco.
     *
     * @param $dbHandler Objeto responsável pela conexão com o banco de dados.
     */
    public function __construct($dbHandler)
    {
        // Obtém a conexão com o banco de dados através do manipulador passado.
        $this->pdo = $dbHandler->getConnection();
    }

    /**
     * Cadastra um novo dependente.
     *
     * @param string $nome Nome do dependente.
     * @param string $dataNascimento Data de nascimento do dependente.
     * @param string $grauParentesco Grau de parentesco do dependente.
     * @param int $filiadoId ID do filiado ao qual o dependente pertence.
     */
    public function cadastrarDependente($nome, $dataNascimento, $grauParentesco, $filiadoId)
    {
        $sql = "INSERT INTO dependentes (dpe_Nome, dpe_Data_De_Nascimento, dpe_Grau_De_Parentesco, flo_Id)
                VALUES (:nome, :dataNascimento, :grauParentesco, :filiadoId)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':nome' => $nome,
            ':dataNascimento' => $dataNascimento,
            ':grauParentesco' => $grauParentesco,
            ':filiadoId' => $filiadoId

        ]);
    }

    /**
     * Lista todos os dependentes de um filiado específico.
     *
     * @param int $filiadoId ID do filiado.
     * @return array Lista de dependentes.
     */
    public function listarPorFiliado($filiadoId)
    {
        $sql = "SELECT * FROM dependentes WHERE flo_Id = :filiadoId";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':filiadoId' => $filiadoId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    /**
     * Edita as informações de um dependente.
     *
     * @param int $id ID do dependente.
     * @param string $nome Nome do dependente.
     * @param string $dataNascimento Data de nascimento.
     * @param string $grauParentesco Grau de parentesco.
     */
    public function editarDependente($id, $nome, $dataNascimento, $grauParentesco)
    {
        $sql = "UPDATE dependentes SET dpe_Nome = :nome, dpe_Data_De_Nascimento = :dataNascimento, dpe_Grau_De_Parentesco = :grauParentesco WHERE dpe_Id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':nome' => $nome,
            ':dataNascimento' => $dataNascimento,
            ':grauParentesco' => $grauParentesco,
            ':id' => $id
        ]);
    }

    /**
     * Exclui um dependente.
     *
     * @param int $id ID do dependente.
     */
    public function deletarDependente($id)
    {
        $sql = "DELETE FROM dependentes WHERE dpe_Id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
    }

    public function buscarPorId($id)
    {
        $sql = "SELECT * FROM dependentes WHERE dpe_Id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $dependente = $stmt->fetch(PDO::FETCH_ASSOC);
        var_dump($dependente); // Verifique se o dependente está sendo retornado corretamente
        return $dependente;
    }

}
