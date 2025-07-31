<?php

if (!isset($_SESSION['nome']) or $_SESSION['tipo'] !== 'Aluno') {
    header("Location: ../../View/Login.php");
}