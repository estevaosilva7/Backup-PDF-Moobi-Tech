<?php
require 'gestao_acesso.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mUsuario = $_POST['usuario'];
    $mSenha = $_POST['senha'];
    $aUsuarios = GestaoAcesso::getValorDaSessao('usuarios') ?? [];

    foreach ($aUsuarios as $mU) {
        if ($mU['usuario'] === $mUsuario && $mU['senha'] === $mSenha) {
            GestaoAcesso::setVariavel('logado', $mU);
            header('Location: geral.php');
            exit();
        }
    }
    echo "Usuário ou senha inválidos!";
}
?>

<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form method="POST">
        Usuário: <input type="text" name="usuario" required>
        Senha: <input type="password" name="senha" required>
        <button type="submit">Acessar</button>
    </form>

</body>
</html>
