
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dados Pessoais</title>
</head>
<body>
<?php
$sNome = htmlspecialchars($_GET['nome']);
echo "<h1>Olá, $sNome!</h1>";
?>
<form action="curriculo.php" method="POST">
    <label for="idade">Insira sua idade por favor:</label>
    <input type="text" id="idade" name="idade" required placeholder="Digite sua idade">

    <label for="email">Insira seu e-mail por favor:</label>
    <input type="email" id="email" name="email" required placeholder="email@exemplo.com">

    <label for="telefone">Insira seu telefone por favor:</label>
    <input type="tel" id="telefone" name="telefone" required placeholder="(XX) XXXX-XXXX">

    <input type="hidden" name="nome" value="<?php echo $sNome; ?>">
    <button type="submit">Avançar</button>
</form>
</body>
</html>
