<?php

class Empresa {
    public $mCnpj;
    public $mRazaoSocial;
    public $mNomeFantasia;
    public $mEmail;
    public $mTelefone;

    public function __construct($mCnpj, $mRazaoSocial, $mNomeFantasia, $mEmail, $mTelefone) {
        $this->mCnpj = $mCnpj;
        $this->mRazaoSocial = $mRazaoSocial;
        $this->mNomeFantasia = $mNomeFantasia;
        $this->mEmail = $mEmail;
        $this->mTelefone = $mTelefone;
    }
}