<?php
session_start();

if (!isset($_SESSION['nome']) or $_SESSION['tipo'] !== 'Admin') {
    header("Location: ../../View/Login.php");
    exit();
}