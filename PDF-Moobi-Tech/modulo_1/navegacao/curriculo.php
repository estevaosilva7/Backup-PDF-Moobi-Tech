<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Currículo</title>
</head>
<body>
<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['nome'] = $_POST['nome'];
    $_SESSION['idade'] = $_POST['idade'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['telefone'] = $_POST['telefone'];
}

$sNome = $_SESSION['nome'];
$sIdade = $_SESSION['idade'];
$sEmail = $_SESSION['email'];
$sTelefone = $_SESSION['telefone'];

echo "<h1>Informações Cadastradas</h1>";
echo "<p>Nome: $sNome</p>";
echo "<p>Idade: $sIdade</p>";
echo "<p>Email: $sEmail</p>";
echo "<p>Telefone: $sTelefone</p>";
?>

<form action="registro.php" method="POST">
    <label for="login">Login:</label>
    <input type="text" id="login" name="login" required><br>

    <label for="senha">Senha:</label>
    <input type="password" id="senha" name="senha" required><br>

    <button type="submit">Registrar</button>
</form>
</body>
</html>
