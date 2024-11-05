<?php
require 'conexao.php';
session_start();

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mEmail = $_POST['email'];
    $mSenha = $_POST['senha'];

    $bStatement = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
    $bStatement->execute([$mEmail]);
    $mUsuario = $bStatement->fetch(PDO::FETCH_ASSOC);

    if ($mUsuario && password_verify($mSenha, $mUsuario['senha'])) {
    $_SESSION['usuario'] = [
        'id' => $mUsuario['id'],
        'nome' => $mUsuario['nome'],
        'perfil' => $mUsuario['perfil'],
        'email' => $mUsuario['email']
    ];
    header('Location: dashboard.php');
    exit();
} else {
        echo "E-mail ou senha incorretos!";
    }
}
?>

<form method="POST" action="">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="senha" placeholder="Senha" required>
    <button type="submit">Login</button>
</form>

<p>Não tem uma conta? <a href="registro.php">Registre-se aqui</a></p>

