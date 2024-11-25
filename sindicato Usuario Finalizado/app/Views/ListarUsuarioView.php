<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuários</title>
</head>
<body>

<h1>Lista de Usuários</h1>

<?php if (!empty($usuarios)): ?>
    <!-- Tabela para exibir os dados -->
    <table border="1" cellpadding="10">
        <thead>
        <tr>
            <th>Nome</th>
            <th>Tipo</th>
            <th>Ação</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($usuarios as $usuario): ?>
            <tr>
                <!-- Exibe o nome e o tipo do usuário em colunas -->
                <td><?php echo $usuario['usu_Nome']; ?></td>
                <td><?php echo $usuario['usu_Tipo']; ?></td>

                <!-- Coluna para ação de deletar o usuário -->
                <td>
                    <a href="/index.php?path=usuario/deletar&id=<?php echo urlencode($usuario['usu_Id']); ?>"
                       onclick="return confirm('Tem certeza que deseja deletar este usuário?');">Deletar</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <!-- Caso não haja usuários cadastrados, exibe uma mensagem informativa -->
    <p>Nenhum usuário encontrado.</p>
<?php endif; ?>

<!-- Botão para voltar ao painel administrativo -->
<a href="/app/Views/DashboardAdminView.php">
    <button type="button">Voltar</button>
</a>

</body>
</html>
