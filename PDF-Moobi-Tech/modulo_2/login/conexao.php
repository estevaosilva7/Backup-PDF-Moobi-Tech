<?php
$sHost = 'localhost';
$sDb = 'sistema_login';
$sUsuario = 'root';
$sSenha = 'Test123@';

try {
    $pdo = new PDO("mysql:host=$sHost;dbname=$sDb", $sUsuario, $sSenha);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro de conexão: " . $e->getMessage());
}
?>