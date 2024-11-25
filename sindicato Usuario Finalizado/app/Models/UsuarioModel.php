<?php

/**
 * Modelo de usuário que interage com o banco de dados para realizar operações
 * relacionadas ao gerenciamento de usuários (login, cadastro, listagem e exclusão).
 *
 * @author Estevão carlosestevao@moobitech.com.br
 */
class UsuarioModel
{
    // Instância do objeto PDO para manipulação do banco de dados.
    private $pdo;

    /**
     * Construtor da classe UsuarioModel.
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
     * Verifica se um usuário existe no banco de dados, comparando o nome e a senha.
     *
     * @param mixed $mNome Nome do usuário a ser verificado.
     * @param mixed $mSenha Senha do usuário a ser verificada.
     * @return array|null Retorna os dados do usuário se encontrado e a senha for válida, ou null se não encontrado.
     */
    public function verificarUsuario($mNome, $mSenha)
    {
        // Prepara a consulta SQL para buscar o usuário pelo nome.
        $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE usu_Nome = ?");

        // Executa a consulta passando o nome do usuário.
        $stmt->execute([$mNome]);

        // Obtém o resultado da consulta.
        $mUsuario = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verifica se o usuário foi encontrado e se a senha é válida.
        if ($mUsuario && password_verify($mSenha, $mUsuario['usu_Senha'])) {
            return $mUsuario; // Retorna os dados do usuário se a senha for válida.
        }

        // Retorna null caso o usuário não seja encontrado ou a senha seja inválida.
        return null;
    }

    /**
     * Realiza o cadastro de um novo usuário no banco de dados.
     *
     * @param mixed $mNome Nome do usuário a ser cadastrado.
     * @param mixed $mSenha Senha do usuário a ser cadastrada.
     * @param mixed $mTipo Tipo do usuário (por exemplo, "admin", "comum").
     * @return bool Retorna verdadeiro se o cadastro for bem-sucedido, falso caso contrário.
     */
    public function cadastrar($mNome, $mSenha, $mTipo)
    {
        // Prepara a consulta SQL para verificar se o nome de usuário já existe.
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM usuarios WHERE usu_Nome = ?");

        // Executa a consulta passando o nome do usuário.
        $stmt->execute([$mNome]);

        // Verifica se o nome de usuário já está cadastrado.
        if ($stmt->fetchColumn() > 0) {
            return false; // Retorna falso caso o nome de usuário já exista.
        }

        // Cria o hash da senha utilizando a função password_hash para garantir segurança.
        $sSenhaHash = password_hash($mSenha, PASSWORD_DEFAULT);

        // Prepara a consulta SQL para inserir o novo usuário no banco de dados.
        $stmt = $this->pdo->prepare("INSERT INTO usuarios (usu_Nome, usu_Senha, usu_Tipo) VALUES (?, ?, ?)");

        // Executa a consulta com os dados fornecidos (nome, senha e tipo).
        return $stmt->execute([$mNome, $sSenhaHash, $mTipo]);
    }

    /**
     * Lista todos os usuários cadastrados no banco de dados.
     *
     * @return array Retorna um array com os dados dos usuários (ID, nome e tipo).
     */
    public function listarUsuarios()
    {
        // Prepara e executa a consulta SQL para obter todos os usuários.
        $stmt = $this->pdo->query("SELECT usu_Id, usu_Nome, usu_Tipo FROM usuarios");

        // Retorna todos os resultados da consulta como um array associativo.
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Deleta um usuário do banco de dados com base no ID fornecido.
     *
     * @param mixed $iId ID do usuário a ser deletado.
     * @return bool Retorna verdadeiro se a exclusão for bem-sucedida, falso caso contrário.
     */
    public function deletarUsuario($iId)
    {
        // Verifica se o ID é numérico para evitar falhas de execução.
        if (!is_numeric($iId)) {
            return false; // Retorna falso se o ID não for numérico.
        }

        // Prepara a consulta SQL para deletar o usuário com o ID fornecido.
        $stmt = $this->pdo->prepare("DELETE FROM usuarios WHERE usu_Id = ?");

        // Executa a consulta e retorna o sucesso ou falha.
        return $stmt->execute([$iId]);
    }

}
?>
