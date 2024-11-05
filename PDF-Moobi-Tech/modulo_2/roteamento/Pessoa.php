<?php

class Pessoa {
    public $mNome;
    public $mDataNascimento;
    public $iIdade;
    public $mCpf;

    public function __construct($mNome, $mDataNascimento, $mCpf) {
        $this->mNome = $mNome;
        $this->mDataNascimento = $mDataNascimento;
        $this->mCpf = $mCpf;
        $this->calcularIdade();
    }    

        private function calcularIdade() {
            $this->iIdade = date('Y') - date('Y', strtotime($this->mDataNascimento));
        }
    }
