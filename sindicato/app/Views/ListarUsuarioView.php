<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Usuários</title>
</head>
<body>
<h1>Lista de Usuários</h1>
<?php if (!empty($nUsuario)): ?>
    <ul>
        <?php foreach ($nUsuario as $usuario): ?>
            <li><?php echo "{$usuario['usu_Nome']} - Tipo: {$usuario['usu_Tipo']}"; ?></li>
        <?php endforeach; ?>

    </ul>
<?php else: ?>
    <p>Nenhum usuário encontrado.</p>
<?php endif; ?>
<a href="/app/Views/DashboardAdminView.php">
    <button type="button">Voltar</button>
</a>
</body>
</html>
