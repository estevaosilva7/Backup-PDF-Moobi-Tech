<?php
$sCaminhoDaImagem = 'imagem/php.jpeg';
header('Content-Type: image/jpeg');
readfile($sCaminhoDaImagem);
exit();
?>;

