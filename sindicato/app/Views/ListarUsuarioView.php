<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Usuários</title>
</head>
<body>
<h1>Lista de Usuários</h1>
<?php if (!empty($usuarios)): ?>
    <ul>
        <?php foreach ($usuarios as $usuario): ?>
            <li><?php echo "{$usuario['usu_Nome']} - Tipo: {$usuario['usu_Tipo']}"; ?></li>
        <?php endforeach; ?>

    </ul>
<?php else: ?>
    <p>Nenhum usuário encontrado.</p>
<?php endif; ?>
</body>
</html>
