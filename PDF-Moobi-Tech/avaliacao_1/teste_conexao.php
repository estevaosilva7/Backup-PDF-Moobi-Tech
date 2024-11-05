<?php
$config = require 'config/config.php';
require 'config/MoobiDatabaseHandler.php';


try {
    $database = new MoobiDatabaseHandler($config);
    $connection = $database->getConexao();

    if ($connection) {
        echo "Conexão bem-sucedida ao banco de dados!";
    }
} catch (Exception $e) {
    echo "Erro na conexão: " . $e->getMessage();
}
