<?php

include '../../Model/NotasModel.php';

class Notas{
    
    public function exibir(){
        $test = new NotasModel;
        echo $test->getAlunoID();
    }
}