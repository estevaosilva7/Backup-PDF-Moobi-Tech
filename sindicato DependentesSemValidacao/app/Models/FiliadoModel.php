<?php

class FiliadoModel
{
    // Instância do objeto PDO para manipulação do banco de dados.
    private $pdo;

    /**
     * Construtor da classe FiliadoModel.
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
     * Realiza o cadastro de um novo filiado no banco de dados.
     *
     * @param mixed $nome Nome do filiado a ser cadastrado.
     * @param mixed $cpf CPF do filiado.
     * @param mixed $rg RG do filiado.
     * @param mixed $dataNascimento Data de nascimento do filiado.
     * @param mixed $idade Idade do filiado.
     * @param mixed $empresa Empresa onde o filiado trabalha.
     * @param mixed $cargo Cargo do filiado.
     * @param mixed $situacao Situação do filiado (ativo, aposentado, etc).
     * @param mixed $telefoneResidencial Telefone residencial.
     * @param mixed $celular Telefone celular.
     * @return bool Retorna verdadeiro se o cadastro for bem-sucedido, falso caso contrário.
     */
    public function cadastrar($nome, $cpf, $rg, $dataNascimento, $idade, $empresa, $cargo, $situacao, $telefoneResidencial, $celular)
    {
        // Prepara a consulta SQL para inserir o novo filiado no banco de dados.
        $stmt = $this->pdo->prepare("INSERT INTO filiados (flo_Nome, flo_CPF, flo_RG, flo_Data_De_Nascimento, flo_Idade, flo_Empresa, flo_Cargo, flo_Situacao, flo_Telefone_Residencial, flo_Celular, flo_Data_Ultima_Atualizacao)
                                     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");

        // Executa a consulta com os dados fornecidos.
        return $stmt->execute([$nome, $cpf, $rg, $dataNascimento, $idade, $empresa, $cargo, $situacao, $telefoneResidencial, $celular]);
    }

    /**
     * Lista todos os filiados cadastrados no banco de dados.
     *
     * @return array Retorna um array com os dados dos filiados.
     */
    public function listarFiliados()
    {
        // Prepara e executa a consulta SQL para obter todos os filiados.
        $stmt = $this->pdo->query("SELECT * FROM filiados");

        // Retorna todos os resultados da consulta como um array associativo.
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Deleta um filiado do banco de dados com base no ID fornecido.
     *
     * @param mixed $id ID do filiado a ser deletado.
     * @return bool Retorna verdadeiro se a exclusão for bem-sucedida, falso caso contrário.
     */
    public function deletarFiliado($id)
    {
        // Verifica se o ID é numérico para evitar falhas de execução.
        if (!is_numeric($id)) {
            return false;
        }

        // Prepara a consulta SQL para deletar o filiado com o ID fornecido.
        $stmt = $this->pdo->prepare("DELETE FROM filiados WHERE flo_Id = ?");

        // Executa a consulta e retorna o sucesso ou falha.
        return $stmt->execute([$id]);
    }

    /**
     * Busca um filiado no banco de dados pelo seu ID.
     *
     * @param mixed $id ID do filiado a ser buscado.
     * @return array|null Retorna os dados do filiado se encontrado, ou null se não encontrado.
     */
    public function buscarFiliadoPorId($id)
    {
        // Prepara a consulta SQL para buscar um filiado pelo ID.
        $stmt = $this->pdo->prepare("SELECT * FROM filiados WHERE flo_Id = ?");
        $stmt->execute([$id]);

        // Retorna o filiado encontrado ou false se não encontrar.
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Atualiza os dados de um filiado no banco de dados.
     *
     * @param mixed $id ID do filiado a ser atualizado.
     * @param mixed $nome Novo nome do filiado.
     * @param mixed $cpf Novo CPF do filiado.
     * @param mixed $rg Novo RG do filiado.
     * @param mixed $dataNascimento Nova data de nascimento do filiado.
     * @param mixed $idade Nova idade do filiado.
     * @param mixed $empresa Nova empresa do filiado.
     * @param mixed $cargo Novo cargo do filiado.
     * @param mixed $situacao Nova situação do filiado.
     * @param mixed $telefoneResidencial Novo telefone residencial.
     * @param mixed $celular Novo telefone celular.
     * @return bool Retorna verdadeiro se a atualização for bem-sucedida, falso caso contrário.
     */
    public function atualizarFiliado($id, $empresa, $cargo, $situacao)
    {
        // Prepara a consulta SQL para atualizar apenas os campos empresa, cargo e situação
        $stmt = $this->pdo->prepare("UPDATE filiados 
                                 SET flo_Empresa = ?, flo_Cargo = ?, flo_Situacao = ?, flo_Data_Ultima_Atualizacao = NOW()
                                 WHERE flo_Id = ?");

        // Executa a consulta com os novos dados
        return $stmt->execute([$empresa, $cargo, $situacao, $id]);
    }

}
?>
