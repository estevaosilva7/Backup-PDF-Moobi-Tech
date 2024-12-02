<h2>Dependentes</h2>
<?php if (!empty($dependentes)): ?>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
        <tr>
            <th>Nome</th>
            <th>Data de Nascimento</th>
            <th>Grau de Parentesco</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($dependentes as $dependente): ?>
            <tr>
                <td><?php echo htmlspecialchars($dependente['dpe_Nome']); ?></td>
                <td><?php echo htmlspecialchars($dependente['dpe_Data_De_Nascimento']); ?></td>
                <td><?php echo htmlspecialchars($dependente['dpe_Grau_De_Parentesco']); ?></td>
                <td>
                    <a href="/index.php?path=dependente/editar&id=<?php echo $dependente['dpe_Id']; ?>&filiadoId=<?php echo $filiadoId; ?>">Editar</a> |
                    <a href="/index.php?path=dependente/deletar&id=<?php echo $dependente['dpe_Id']; ?>&filiadoId=<?php echo $filiadoId; ?>"
                       onclick="return confirm('Deseja excluir este dependente?');">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>Nenhum dependente cadastrado.</p>
<?php endif; ?>

<a href="/index.php?path=dependente/cadastrar&filiadoId=<?php echo $filiadoId; ?>">
    <button type="button">Adicionar Dependente</button>
</a>
<br>
<a href="index.php?path=filiado/listar">
    <button type="button">Voltar</button>
</a>
