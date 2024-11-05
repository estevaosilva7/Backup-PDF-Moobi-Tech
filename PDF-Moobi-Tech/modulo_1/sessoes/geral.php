<?php
require 'gestao_acesso.php';

$usuarioLogado =  GestaoAcesso::getValorDaSessao('logado');
if (!$usuarioLogado) {
    header('Location: login.php');
    exit();
}

if (isset($_GET['acao']) && $_GET['acao'] === 'sair') {
    GestaoAcesso::removeVariavel('logado');
    header('Location: login.php');
    exit();
}
?>

<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Geral</title>
</head>
<body>
    <h1>Bem vindo <?php echo htmlspecialchars($usuarioLogado['nome']) ?> !</h1>
    <a href="geral.php?acao=sair">Sair</a>
    <h2>Lista de usuários cadastrados:</h2>
    <ul>
        <?php
        $aUsuarios = GestaoAcesso::getValorDaSessao('usuarios') ?? [];
        foreach ($aUsuarios as $mU) {
            echo "<li>" . htmlspecialchars($mU['nome']) . " (" . htmlspecialchars($mU['usuario']) . ")</li>";
        }
        ?>
    </ul>
</body>
</html>
