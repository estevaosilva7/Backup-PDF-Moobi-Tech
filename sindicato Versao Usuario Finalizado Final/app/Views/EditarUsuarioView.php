<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar Usuário</title>
</head>
<body>

<header>
    <!-- Cabeçalho da página, mostrando o título da operação (editar usuário) -->
    <h1>Editar Usuário</h1>
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

<?php if ($usuario): ?>
    <!-- Formulário de edição de usuário, que será preenchido com os dados do usuário específico -->
    <form action="/index.php?path=usuario/atualizar&id=<?php echo $usuario['usu_Id']; ?>" method="POST">
        <!-- Campo de entrada para o nome do usuário -->
        <label for="nome">Nome de Usuário:</label>
        <input type="text" name="nome" id="nome" value="<?php echo htmlspecialchars($usuario['usu_Nome']); ?>" required>
        <br><br>

        <!-- Campo de seleção para o tipo de usuário (admin ou comum) -->
        <label for="tipo">Tipo de Usuário:</label>
        <select name="tipo" id="tipo">
            <!-- Opção para admin, selecionando com base no tipo de usuário atual -->
            <option value="admin" <?php echo $usuario['usu_Tipo'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
            <!-- Opção para comum, selecionando com base no tipo de usuário atual -->
            <option value="comum" <?php echo $usuario['usu_Tipo'] == 'comum' ? 'selected' : ''; ?>>Comum</option>
        </select>
        <br><br>

        <!-- Botão para enviar o formulário e atualizar os dados do usuário -->
        <button type="submit">Atualizar Usuário</button>
    </form>

    <!-- Link para voltar à lista de usuários -->
    <a href="/index.php?path=usuario/listar"><button>Voltar</button></a>

<?php else: ?>
    <!-- Caso o usuário não seja encontrado, exibe uma mensagem de erro -->
    <p>Usuário não encontrado.</p>
<?php endif; ?>

</body>
</html>
