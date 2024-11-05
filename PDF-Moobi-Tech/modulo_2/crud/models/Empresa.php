<?php
require_once 'banco_de_dados/MoobiDatabaseHandler.php';

class Empresa {
    private $db;

    public function __construct() {
        $this->db = new MoobiDatabaseHandler('localhost', '3306', 'root', 'Test123@', 'empresa');
    }

    public function listarEmpresas() {
        return$this->db->query("SELECT * FROM clientes");
    }

    public function buscarEmpresa($id) {
        return $this->db->query("SELECT * FROM clientes WHERE id = :id", [':id' => $id])[0];
    }

    public function criarEmpresa($mDados) {
        $this->db->execute(
            "INSERT INTO clientes (nome, email, cnpj, cep, estado, cidade, bairro, logradouro, telefone) 
         VALUES (:nome, :email, :cnpj, :cep, :estado, :cidade, :bairro, :logradouro, :telefone)",
            $mDados
        );
    }

    public function atualizarEmpresa($id, $mDados) {
        $mDados[':id'] = $id;
        $this->db->execute(
            "UPDATE clientes SET nome = :nome, email = :email, cnpj = :cnpj, cep = :cep, estado = :estado, 
             cidade = :cidade, bairro = :bairro, logradouro = :logradouro, telefone = :telefone 
             WHERE id = :id",
            $mDados
        );
    }

    public function deletarEmpresa($id) {
        $this->db->execute("DELETE FROM clientes WHERE id = :id", [':id' => $id]);
    }
}
?>