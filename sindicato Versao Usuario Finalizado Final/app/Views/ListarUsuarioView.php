<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Listar Usuários</title>
</head>
<body>

<header>
    <!-- Cabeçalho da página, mostrando o título da operação (listar usuários) -->
    <h1>Usuários Cadastrados</h1>
</header>

<?php if (!empty($usuarios)): ?>
    <!-- Tabela para exibir os dados dos usuários cadastrados -->
    <table border="1" cellpadding="10">
        <thead>
        <tr>
            <!-- Definindo as colunas da tabela -->
            <th>ID</th>
            <th>Nome</th>
            <th>Tipo</th>
            <!-- Se o usuário for admin, exibe a coluna de Ações -->
            <?php if ($isAdmin): ?>
                <th>Ações</th>
            <?php endif; ?>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($usuarios as $usuario): ?>
            <tr>
                <!-- Exibindo os dados dos usuários -->
                <td><?php echo htmlspecialchars($usuario['usu_Id']); ?></td>
                <td><?php echo htmlspecialchars($usuario['usu_Nome']); ?></td>
                <td><?php echo htmlspecialchars($usuario['usu_Tipo']); ?></td>

                <!-- Se o usuário for admin, exibe a coluna de Ações com links para editar e excluir -->
                <?php if ($isAdmin): ?>
                    <td>
                        <!-- Link para editar os dados do usuário -->
                        <a href="/index.php?path=usuario/editar&id=<?php echo $usuario['usu_Id']; ?>">Editar</a> |
                        <!-- Link para excluir o usuário, com confirmação antes de realizar a ação -->
                        <a href="/index.php?path=usuario/deletar&id=<?php echo $usuario['usu_Id']; ?>"
                           onclick="return confirm('Tem certeza que deseja deletar este usuário?');">Excluir</a>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <!-- Caso não haja usuários cadastrados, exibe uma mensagem informativa -->
    <p>Nenhum usuário encontrado.</p>
<?php endif; ?>


<!-- Botão para voltar ao painel administrativo -->
<a href="/app/Views/DashboardView.php">
    <button type="button">Voltar</button>
</a>

</body>
</html>
