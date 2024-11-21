<?php

/**
 * Modelo de usuário que interage com o banco de dados para realizar operações
 * relacionadas ao gerenciamento de usuários (login, cadastro e listagem).
 *
 * Autor: Seu Nome (ou o nome do responsável pelo código)
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
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verifica se o usuário foi encontrado e se a senha é válida.
        if ($usuario && password_verify($mSenha, $usuario['usu_Senha'])) {
            return $usuario; // Retorna os dados do usuário se a senha for válida.
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
     * @return array Retorna um array com os dados dos usuários (nome e tipo).
     */
    public function listarUsuarios()
    {
        // Prepara e executa a consulta SQL para obter todos os usuários.
        $stmt = $this->pdo->query("SELECT usu_Nome, usu_Tipo FROM usuarios");

        // Retorna todos os resultados da consulta como um array associativo.
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
