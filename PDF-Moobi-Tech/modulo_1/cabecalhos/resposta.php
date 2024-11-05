<?php
$sAccept = $_SERVER['HTTP_ACCEPT'];

switch ($sAccept) {
    case 'application/javascript':
        header('Content-Type: application/json');
        echo json_encode(['mensagem' => 'Hello World!']);
        break;

    case 'application/xml':
        header('Content-Type: application/xml');
        echo '<?xml version="1.0"?><mensagem>Hello World!</mensagem>';
        break;

    default:
        header('Content-Type: text/html');
        echo "<h1>Hello World!</h1>";
}
?>