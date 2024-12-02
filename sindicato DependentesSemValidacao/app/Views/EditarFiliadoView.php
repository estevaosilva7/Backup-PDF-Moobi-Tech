<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Filiado</title>
</head>
<body>
<header>
    <h1>Atualizar Dados do Filiado</h1>
</header>
<?php
// Exibe a mensagem de erro, se houver
if ($mensagemErro = CustomSessionHandler::get('mensagem_erro')) {
    echo "<p>$mensagemErro</p>";  // Exibe a mensagem de erro armazenada na sessão
    CustomSessionHandler::remove('mensagem_erro'); // Remove a mensagem após exibi-la
}

// Exibe a mensagem de sucesso, se houver
if ($mensagemSucesso = CustomSessionHandler::get('mensagem_sucesso')) {
    echo "<p>$mensagemSucesso</p>";  // Exibe a mensagem de sucesso armazenada na sessão
    CustomSessionHandler::remove('mensagem_sucesso'); // Remove a mensagem após exibi-la
}
?>
<form method="POST" action="/index.php?path=filiado/atualizar&id=<?php echo $filiado['flo_Id']; ?>">
    <label for="nome">Nome:</label>
    <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($filiado['flo_Nome']); ?>" required readonly>
    <br>

    <label for="cpf">CPF:</label>
    <input type="text" id="cpf" name="cpf" value="<?php echo htmlspecialchars($filiado['flo_CPF']); ?>" required readonly>
    <br>

    <label for="rg">RG:</label>
    <input type="text" id="rg" name="rg" value="<?php echo htmlspecialchars($filiado['flo_RG']); ?>" required readonly>
    <br>

    <label for="dataNascimento">Data de Nascimento:</label>
    <input type="date" id="dataNascimento" name="dataNascimento" value="<?php echo htmlspecialchars($filiado['flo_Data_De_Nascimento']); ?>" required readonly>
    <br>

    <label for="idade">Idade:</label>
    <input type="text" id="idade" name="idade" value="<?php echo htmlspecialchars($filiado['flo_Idade']); ?>" required readonly>
    <br>

    <label for="empresa">Empresa:</label>
    <input type="text" id="empresa" name="empresa" value="<?php echo htmlspecialchars($filiado['flo_Empresa']); ?>" required>
    <br>

    <label for="cargo">Cargo:</label>
    <input type="text" id="cargo" name="cargo" value="<?php echo htmlspecialchars($filiado['flo_Cargo']); ?>" required>
    <br>

    <label for="situacao">Situação:</label>
    <select id="situacao" name="situacao" required>
        <option value="ativo" <?php echo $filiado['flo_Situacao'] == 'ativo' ? 'selected' : ''; ?>>Ativo</option>
        <option value="aposentado" <?php echo $filiado['flo_Situacao'] == 'aposentado' ? 'selected' : ''; ?>>Aposentado</option>
        <option value="licenciado" <?php echo $filiado['flo_Situacao'] == 'licenciado' ? 'selected' : ''; ?>>Licenciado</option>
    </select>
    <br>

    <label for="telefoneResidencial">Telefone Residencial:</label>
    <input type="text" id="telefoneResidencial" name="telefoneResidencial" value="<?php echo htmlspecialchars($filiado['flo_Telefone_Residencial']); ?>" placeholder="Telefone Residencial" readonly>
    <br>

    <label for="celular">Celular:</label>
    <input type="text" id="celular" name="celular" value="<?php echo htmlspecialchars($filiado['flo_Celular']); ?>" placeholder="Celular" readonly>
    <br>

    <button type="submit">Atualizar</button>
</form>
<a href="/index.php?path=filiado/listar"><button>Voltar</button></a>
</body>
</html>
