<?php

class FormadorModel extends UserModel{

    public function __construct($nome,$email,$senha)
    {
        parent::__construct($nome,$email,$senha,"Formador");
    }
}