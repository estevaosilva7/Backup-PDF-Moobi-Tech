<?php
require 'gestao_acesso.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mNome = $_POST['nome'];
    $mUsuario = $_POST['usuario'];
    $mSenha = $_POST['senha'];

    $aUsuarios = GestaoAcesso::getValorDaSessao('usuarios') ?? [];
    $aUsuarios[] = ['nome' => $mNome, 'usuario' => $mUsuario, 'senha' => $mSenha];

    GestaoAcesso::setVariavel('usuarios', $aUsuarios);

    echo "Usuário cadastrado! <a href='login.php'>Página de login</a>";
}
?>

<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cadastro</title>
</head>
<body>
    <h1>Cadastro</h1>
    <form method="POST">
        Nome: <input type="text" name="nome" required>
        Usuário: <input type="text" name="usuario" required>
        Senha: <input type="password" name="senha" required>
        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>