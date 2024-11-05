<?php
require 'gestão_funcoes.php';
verificarLogin();

echo "Bem-vindo, " . $_SESSION['usuario']['nome'] . "!<br>";
echo "Perfil: " . $_SESSION['usuario']['perfil'] . "<br>";
echo "Hora: " . date('H:i:s') . "<br>";
?>

<a href="cadastro.php">Cadastrar Usuários</a><br>;
<a href="lista_usuarios.php">Listar Usuários</a><br>;
<a href="logout.php">Logout</a>;

