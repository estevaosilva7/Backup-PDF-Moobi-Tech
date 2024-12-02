<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Dependente</title>
</head>
<body>
<h1>Cadastrar Dependente</h1>
<form method="POST" action="/index.php?path=dependente/cadastrar">
    <input type="hidden" name="filiadoId" value="<?php echo $filiadoId; ?>">
    <label for="nome">Nome:</label>
    <input type="text" id="nome" name="nome" placeholder="Nome" required>
    <br>

    <label for="dataNascimento">Data de Nascimento:</label>
    <input type="date" id="dataNascimento" name="dataNascimento" required>
    <br>

    <label for="grauParentesco">Grau de Parentesco:</label>
    <input type="text" id="grauParentesco" name="grauParentesco" placeholder="Parentesco" required>
    <br>

    <button type="submit">Cadastrar Dependente</button>
</form>

<a href="/index.php?path=filiado/editar&id=<?php echo $filiadoId; ?>">Voltar</a>
</body>
</html>
