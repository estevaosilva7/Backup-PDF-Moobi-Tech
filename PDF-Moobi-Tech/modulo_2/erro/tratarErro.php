<?php
class TratadorDeErros
{
    private $sErrosLog;

    public function __construct($sErrosLog)
    {
        $this->$sErrosLog = $sErrosLog;
        $this->configurarManipuladorDeErros();
    }

    private function configurarManipuladorDeErros()
    {
        set_error_handler(function ($errno, $errstr, $errfile, $errline) {
            $mensagemErro = "Ocorreu um erro [$errno]: $errstr em $errfile na linha $errline\n";
            error_log($mensagemErro, 3, $this->caminhoArquivo);
        });
    }
}

$sErrosLog = 'erros.log';
$tratador = new TratadorDeErros($sErrosLog);



