<form method="POST" action="router.php?action=salvar">
    <input type="hidden" name="id" value="<?php echo isset($mEmpresa['id']) ? $mEmpresa['id'] : ''; ?>">

    <label for="nome">Nome:</label>
    <input type="text" id="nome" name="nome" value="<?php echo isset($mEmpresa['nome']) ? $mEmpresa['nome'] : ''; ?>" required placeholder="Digite o nome da mEmpresa"><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo isset($mEmpresa['email']) ? $mEmpresa['email'] : ''; ?>" required placeholder="Digite o email"><br>

    <label for="cnpj">CNPJ:</label>
    <input type="text" id="cnpj" name="cnpj" value="<?php echo isset($mEmpresa['cnpj']) ? $mEmpresa['cnpj'] : ''; ?>" required placeholder="Digite o CNPJ"><br>

    <label for="cep">CEP:</label>
    <input type="text" id="cep" name="cep" value="<?php echo isset($mEmpresa['cep']) ? $mEmpresa['cep'] : ''; ?>" required placeholder="Digite o CEP"><br>

    <label for="estado">Estado:</label>
    <input type="text" id="estado" name="estado" value="<?php echo isset($mEmpresa['estado']) ? $mEmpresa['estado'] : ''; ?>" required placeholder="Digite o estado"><br>

    <label for="cidade">Cidade:</label>
    <input type="text" id="cidade" name="cidade" value="<?php echo isset($mEmpresa['cidade']) ? $mEmpresa['cidade'] : ''; ?>" required placeholder="Digite a cidade"><br>

    <label for="bairro">Bairro:</label>
    <input type="text" id="bairro" name="bairro" value="<?php echo isset($mEmpresa['bairro']) ? $mEmpresa['bairro'] : ''; ?>" required placeholder="Digite o bairro"><br>

    <label for="logradouro">Logradouro:</label>
    <input type="text" id="logradouro" name="logradouro" value="<?php echo isset($mEmpresa['logradouro']) ? $mEmpresa['logradouro'] : ''; ?>" required placeholder="Digite o logradouro"><br>

    <label for="telefone">Telefone:</label>
    <input type="text" id="telefone" name="telefone" value="<?php echo isset($mEmpresa['telefone']) ? $mEmpresa['telefone'] : ''; ?>" required placeholder="Digite o telefone"><br>

    <button type="submit">Salvar</button>
</form>
