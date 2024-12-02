<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Dependente</title>
</head>
<body>
<h1>Editar Dependente</h1>
<form method="POST" action="/index.php?path=dependente/editar&id=<?php echo $dependente['dpe_Id']; ?>">

    <input type="hidden" name="id" value="<?php echo $dependente['dpe_Id']; ?>">
    <input type="hidden" name="filiadoId" value="<?php echo $dependente['flo_Id']; ?>">

    <label for="nome">Nome:</label>
    <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($dependente['dpe_Nome']); ?>" required>
    <br>

    <label for="dataNascimento">Data de Nascimento:</label>
    <input type="date" id="dataNascimento" name="dataNascimento" value="<?php echo htmlspecialchars($dependente['dpe_Data_De_Nascimento']); ?>" required>
    <br>

    <label for="grauParentesco">Grau de Parentesco:</label>
    <input type="text" id="grauParentesco" name="grauParentesco" value="<?php echo htmlspecialchars($dependente['dpe_Grau_De_Parentesco']); ?>" required>
    <br>

    <button type="submit">Atualizar</button>
</form>

<a href="/index.php?path=filiado/editar&id=<?php echo $dependente['flo_Id']; ?>">
    <button type="button">Voltar</button>
</a>
</body>
</html>
