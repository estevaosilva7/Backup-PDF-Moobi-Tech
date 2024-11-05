<?php
require_once 'models/Empresa.php';

class EmpresaController{
    private $model;

    public function __construct() {
        $this->model = new Empresa();
    }

    public function listar() {
        $aEmpresas = $this->model->listarEmpresas();
        require 'views/listagem.php';
    }

    public function criarOuEditar($id = null) {
        $mEmpresa = $id ? $this->model->buscarEmpresa($id) : null;
        require 'views/form.php';
    }

    public function salvar($mDados) {
        $aDadosFormatados = [
            ':nome' => $mDados['nome'],
            ':email' => $mDados['email'],
            ':cnpj' => $mDados['cnpj'],
            ':cep' => $mDados['cep'],
            ':estado' => $mDados['estado'],
            ':cidade' => $mDados['cidade'],
            ':bairro' => $mDados['bairro'],
            ':logradouro' => $mDados['logradouro'],
            ':telefone' => $mDados['telefone']
        ];

        if (isset($mDados['id']) && !empty($mDados['id'])) {
            $this->model->atualizarEmpresa($mDados['id'], mDados: $aDadosFormatados);
        } else {
            $this->model->criarEmpresa($aDadosFormatados);
        }

        header('Location: index.php');
    }

    public function deletar($id) {
        $this->model->deletarEmpresa($id);
        header('Location: index.php');

    }
}