<?php
$sUsuario = 'root';
$sSenha = '1234';

if (!isset($_SERVER['PHP_AUTH_USER']) ||
    $_SERVER['PHP_AUTH_USER'] !== $sUsuario ||
    $_SERVER['PHP_AUTH_PW'] !== $sSenha) {
    header('WWW-Authenticate: Basic realm="My Realm"');
    header("HTTP 401 Unauthorized");
    echo 'Autenticação necessária';
    exit();
}
    echo "Seja bem-vindo, $sUsuario!";
?>






