<?php

class UsuarioModel
{
    private $pdo;

    public function __construct($dbHandler)
    {
        $this->pdo = $dbHandler->getConnection();
    }

    public function verificarUsuario($nome, $senha)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE usu_Nome = ?");
        $stmt->execute([$nome]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($senha, $usuario['usu_Senha'])) {
            return $usuario;
        }

        return null;
    }

    public function cadastrar($nome, $senha, $tipo)
    {
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("INSERT INTO usuarios (usu_Nome, usu_Senha, usu_Tipo) VALUES (?, ?, ?)");
        return $stmt->execute([$nome, $senhaHash, $tipo]);
    }

    public function listarUsuarios()
    {
        $stmt = $this->pdo->query("SELECT usu_Nome, usu_Tipo FROM usuarios");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
