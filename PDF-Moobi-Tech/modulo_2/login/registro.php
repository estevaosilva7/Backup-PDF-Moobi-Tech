<?php
require 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mNome = $_POST['nome'];
    $mEmail = $_POST['email'];
    $mSenha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $mPerfil = $_POST['perfil'];

    //
    $bStatement = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
    $bStatement->execute([$mEmail]);

    if ($bStatement->rowCount() > 0) {
        echo "E-mail já cadastrado! Escolha outro.";
    } else {
        $bStatement = $pdo->prepare("INSERT INTO usuarios (nome, email, senha, perfil) VALUES (?, ?, ?, ?)");
        $bStatement->execute([$mNome, $mEmail, $mSenha, $mPerfil]);

        echo "Usuário cadastrado com sucesso! <a href='index.php'>Clique aqui para logar</a>";
    }
}
?>

<h1>Registro de Usuário</h1>
<form method="POST" action="">
    <input type="text" name="nome" placeholder="Nome" required><br><br>
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="password" name="senha" placeholder="Senha" required><br><br>
    <label>Escolha seu perfil:</label><br>
    <select name="perfil" required>
        <option value="comum">Comum</option>
        <option value="admin">Administrador</option>
    </select><br><br>
    <button type="submit">Registrar</button>
</form>
