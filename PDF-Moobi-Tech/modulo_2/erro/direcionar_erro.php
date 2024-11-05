<?php
function configurarManipuladorDeErros($sErrosLog) {
    set_error_handler(function($errno, $errstr, $errfile, $errline) use ($sErrosLog) {

        $sMensagemFormatada = "Ocorreu um erro [$errno]: $errstr em $errfile na linha $errline\n";

        error_log($sMensagemFormatada, 3, $sErrosLog);
    });
}

function testarErro() {
    $teste01 = $variavelTeste;
}

$sErrosLog = 'erros.log';
configurarManipuladorDeErros($sErrosLog);

testarErro();
