<?php
require 'MoobiDatabaseHandler.php';

$host = 'localhost';
$port = 3306;
$usuario = 'root';
$senha = 'Test123@';
$dbname = 'empresa';

$db = new MoobiDatabaseHandler($host, $port, $usuario, $senha, $dbname);
/*
$nome = 'Carla da Silva';
$email = 'carla@gmail.com';
$cnpj = '12345678000195';
$cep = '12345-678';
$estado = 'SP';
$cidade = 'São Paulo';
$bairro = 'Centro';
$logradouro = 'Rua Exemplo, 123';
$telefone = '(11) 91234-5678';

$inserido = $db->execute(
    "INSERT INTO clientes (nome, email, cnpj, cep, estado, cidade, bairro, logradouro, telefone)
     VALUES (:nome, :email, :cnpj, :cep, :estado, :cidade, :bairro, :logradouro, :telefone)",
    [
        ':nome' => $nome,
        ':email' => $email,
        ':cnpj' => $cnpj,
        ':cep' => $cep,
        ':estado' => $estado,
        ':cidade' => $cidade,
        ':bairro' => $bairro,
        ':logradouro' => $logradouro,
        ':telefone' => $telefone
    ]
);

if ($inserido) {
    echo "Cliente inserido com sucesso!<br>";
} else {
    echo "Falha ao inserir cliente.<br>";
}
*/
$clientes = $db->query("SELECT * FROM clientes");

if ($clientes) {
    echo "<h2>Clientes cadastrados:</h2>";
    echo "<table border='1'><tr><th>ID</th><th>Nome</th><th>Email</th><th>CNPJ</th><th>CEP</th><th>Estado</th><th>Cidade</th><th>Bairro</th><th>Logradouro</th><th>Telefone</th></tr>";

    foreach ($clientes as $cliente) {
        echo "<tr>";
        echo "<td>{$cliente['id']}</td>";
        echo "<td>{$cliente['nome']}</td>";
        echo "<td>{$cliente['email']}</td>";
        echo "<td>{$cliente['cnpj']}</td>";
        echo "<td>{$cliente['cep']}</td>";
        echo "<td>{$cliente['estado']}</td>";
        echo "<td>{$cliente['cidade']}</td>";
        echo "<td>{$cliente['bairro']}</td>";
        echo "<td>{$cliente['logradouro']}</td>";
        echo "<td>{$cliente['telefone']}</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Nenhum cliente encontrado.<br>";
}
?>
