<?php
session_start();

function verificarLogin() {
    if (!isset($_SESSION['usuario'])) {
        header('Location: index.php');
        exit();
    }
}

function verificarAdmin() {
    return isset($_SESSION['usuario']) && $_SESSION['usuario']['perfil'] === 'admin';
}
