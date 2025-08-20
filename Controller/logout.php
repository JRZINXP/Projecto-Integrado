<?php
session_start();
include_once '../Conect/conector.php';

$conexao = new Conector();
$conn = $conexao->getConexao();

$token = $_COOKIE['session_token'] ?? '';

if (!empty($token)) {
    // Atualiza DataExpiracao para o momento do logout
    $sqlEncerrar = "UPDATE Sessao SET Ativo = 0, DataExpiracao = NOW() WHERE Token = ?";
    $stmtEncerrar = $conn->prepare($sqlEncerrar);
    $stmtEncerrar->bind_param("s", $token);
    $stmtEncerrar->execute();
}

// Limpar cookies e sessão
setcookie('session_token', '', time() - 3600, "/");
setcookie('user_email', '', time() - 3600, "/");
session_destroy();

header("Location: ../View/Login.php");
exit();
