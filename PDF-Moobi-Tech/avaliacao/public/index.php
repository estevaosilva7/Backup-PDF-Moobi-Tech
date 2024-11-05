<?php
include '../Config/configuracoes.php';
include '../app/Libraries/Rota.php';
include '../app/Libraries/Controller.php';
include '../app/Database/MoobiDatabaseHandler.php';
$db = new MoobiDatabaseHandler();
?>

<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo APP_NOME; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo URL;?>/public/css/estilos.css">
</head>
<body>
    <?php
        include RAIZ . '/app/Views/topo.php';
        $teste = new Rota();
        include '../app/Views/rodape.php';
    ?>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo URL;?>/public/js/jquery.funcoes.js"></script>
</body>
</html>