<?php
require 'gestão_funcoes.php';
verificarLogin();

require 'conexao.php';
$bStatement = $pdo->query("SELECT nome, email, perfil FROM usuarios");

echo "<h1>Lista de Usuários";
while ($mUsuario = $bStatement->fetch()) {
    echo "Nome: {$mUsuario['nome']} - Email: {$mUsuario['email']} - Perfil: {$mUsuario['perfil']}<br>";
}
?>