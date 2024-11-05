<!-- registro.php -->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro</title>
</head>
<body>
<?php
session_start();

$sLogin = $_POST['login'];
$sSenha = $_POST['senha'];

if ($sLogin === $_SESSION['nome'] && $sSenha === 'moobitech') {
    $tHoraAtual = new DateTimeImmutable();
    $sHoraFormatada = $tHoraAtual->format('H:i:s');

    echo "<h1>Bem-vindo, {$_SESSION['nome']}!</h1>";
    echo "<p>Hora atual: $sHoraFormatada</p>";

    $sHora = $tHoraAtual->format('H');
    if ($sHora < 12) {
        echo "<p>Bom dia!</p>";
    } elseif ($sHora < 18) {
        echo "<p>Boa tarde!</p>";
    } else {
        echo "<p>Boa noite!</p>";
    }
} else {
    echo "<p>Login ou senha incorretos. Tente novamente por favor!</p>";
    echo '<a href="curriculo.php">Voltar</a>';
}
?>
</body>
</html>
