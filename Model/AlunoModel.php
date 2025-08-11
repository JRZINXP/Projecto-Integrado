<?php

class AlunoModel extends UserModel{
    private $dataNasc;

    public function __construct($nome,$email,$senha,$dataNasc)
    {
        parent::__construct($nome,$email,$senha,"Aluno");
        $this->dataNasc = $dataNasc;
    }

    public function getDataNasc(){
        return $this->dataNasc;
    }

    public function setDataNasc($anoNasc){
        $this->dataNasc = $anoNasc;
    }

}