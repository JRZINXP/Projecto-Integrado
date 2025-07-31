<?php

if (!isset($_SESSION['nome']) or $_SESSION['tipo'] !== 'Formador') {
    header("Location: ../../View/Login.php");
}