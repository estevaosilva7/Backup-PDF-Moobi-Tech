<?php
require 'gestão_funcoes.php';
verificarLogin();

if (!verificarAdmin()) {
    echo "Acesso negado!";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require 'conexao.php';

    $mNome = $_POST['nome'];
    $mEmail = $_POST['email'];
    $mSenha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $mPerfil = $_POST['perfil'];

    $bStatement = $pdo->prepare("INSERT INTO usuarios (nome, email, , perfil) VALUES (?, ?, ?, ?)");
    $bStatement->execute([$mNome, $mEmail, $mSenha, $mPerfil]);

    echo "Usuário cadastrado com sucesso!";
}
?>

<form method="POST" action="">
    <input type="text" name="nome" placeholder="Nome" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="senha" placeholder="Senha" required>
    <select name="perfil">
        <option value="comum">Comum</option>
        <option value="admin">Admin</option>
    </select>
    <button type="submit">Cadastrar</button>
</form>

