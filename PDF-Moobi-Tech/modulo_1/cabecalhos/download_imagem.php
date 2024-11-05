<?php
$sCaminhoDaImagem = 'imagem/php.jpeg';
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="imagem_php.jpeg"');
readfile($sCaminhoDaImagem);
exit();
?>
