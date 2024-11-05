<a href="router.php?action=criar">Nova Empresa</a>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Email</th>
        <th>CNPJ</th>
        <th>CEP</th>
        <th>Estado</th>
        <th>Cidade</th>
        <th>Bairro</th>
        <th>Logradouro</th>
        <th>Telefone</th>
        <th>Ações</th>
    </tr>
    <?php foreach ($aEmpresas as $mEmpresa): ?>
        <tr>
            <td><?php echo $mEmpresa['id'] ?></td>
            <td><?php echo $mEmpresa['nome'] ?></td>
            <td><?php echo $mEmpresa['email'] ?></td>
            <td><?php echo $mEmpresa['cnpj'] ?></td>
            <td><?php echo $mEmpresa['cep'] ?></td>
            <td><?php echo $mEmpresa['estado'] ?></td>
            <td><?php echo $mEmpresa['cidade'] ?></td>
            <td><?php echo $mEmpresa['bairro'] ?></td>
            <td><?php echo $mEmpresa['logradouro'] ?></td>
            <td><?php echo $mEmpresa['telefone'] ?></td>
            <td>
                <a href="router.php?action=editar&id=<?php echo $mEmpresa['id'] ?>">Editar</a> |
                <a href="router.php?action=deletar&id=<?php echo $mEmpresa['id'] ?>">Deletar</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
