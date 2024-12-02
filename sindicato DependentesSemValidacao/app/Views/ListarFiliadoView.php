<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista de Filiados</title>
</head>
<body>
<header>
    <h1>Lista de Filiados</h1>
</header>
<?php if (isset($_SESSION['mensagem_sucesso'])): ?>
    <div class="alert alert-success">
        <?php echo $_SESSION['mensagem_sucesso']; ?>
    </div>
    <?php unset($_SESSION['mensagem_sucesso']); ?>
<?php endif; ?>

<?php if (!empty($filiados)): ?>
    <h2>Filiados Cadastrados</h2>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
        <tr>
            <th>Nome</th>
            <th>CPF</th>
            <th>RG</th>
            <th>Data de Nascimento</th>
            <th>Idade</th>
            <th>Empresa</th>
            <th>Cargo</th>
            <th>Situação</th>
            <th>Telefone Residencial</th>
            <th>Celular</th>
            <th>Última Atualização</th>
            <!-- Se o usuário for admin, exibe a coluna de Ações -->
            <?php if ($isAdmin): ?>
                <th>Ações</th>
            <?php endif; ?>
            <th>Dependentes</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($filiados as $filiado): ?>
            <tr>
                <td><?php echo htmlspecialchars($filiado['flo_Nome']); ?></td>
                <td><?php echo htmlspecialchars($filiado['flo_CPF']); ?></td>
                <td><?php echo htmlspecialchars($filiado['flo_RG']); ?></td>
                <td><?php echo htmlspecialchars($filiado['flo_Data_De_Nascimento']); ?></td>
                <td><?php echo htmlspecialchars($filiado['flo_Idade']); ?></td>
                <td><?php echo htmlspecialchars($filiado['flo_Empresa']); ?></td>
                <td><?php echo htmlspecialchars($filiado['flo_Cargo']); ?></td>
                <td><?php echo htmlspecialchars($filiado['flo_Situacao']); ?></td>
                <td><?php echo htmlspecialchars($filiado['flo_Telefone_Residencial']); ?></td>
                <td><?php echo htmlspecialchars($filiado['flo_Celular']); ?></td>
                <td><?php echo htmlspecialchars($filiado['flo_Data_Ultima_Atualizacao']); ?></td>
                <?php if ($isAdmin): ?>
                    <td>
                        <!-- Link para editar os dados do filiado -->
                        <a href="/index.php?path=filiado/editar&id=<?php echo $filiado['flo_Id']; ?>">Editar</a> |
                        <!-- Link para excluir o filiado, com confirmação antes de realizar a ação -->
                        <a href="/index.php?path=filiado/deletar&id=<?php echo $filiado['flo_Id']; ?>"
                           onclick="return confirm('Tem certeza que deseja deletar este filiado?');">Excluir</a>

                    </td>
                <?php endif; ?>
                    <td>
                        <a href="/index.php?path=dependente/listar&id=<?php echo $filiado['flo_Id']; ?>">
                            <button type="button">Acessar</button>
                        </a>
                    </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <!-- Botão para voltar ao painel administrativo -->
    <a href="/app/Views/DashboardView.php">
        <button type="button">Voltar</button>
    </a>
<?php else: ?>
    <!-- Caso não haja filiados cadastrados, exibe uma mensagem informativa -->
    <p>Nenhum filiado encontrado.</p>
<?php endif; ?>

</body>
</html>
