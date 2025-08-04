<?php
include_once '../../Conect/conector.php';

$msg = '';
$userData = [];

// Buscar dados do usuário
if (isset($_SESSION['nome'])) {
    $conexao = new Conector();
    $conn = $conexao->getConexao();
    $stmt = $conn->prepare("SELECT Nome, Email, Tipo, Senha FROM Usuario WHERE Nome = ?");
    $stmt->bind_param("s", $_SESSION['nome']);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $userData = $result->fetch_assoc();
    }
}

// Alterar senha
if (isset($_POST['alterar_senha'])) {
    $senha_atual = $_POST['senha_atual'] ?? '';
    $nova_senha = $_POST['nova_senha'] ?? '';
    $confirma_senha = $_POST['confirma_senha'] ?? '';
    if ($senha_atual !== $userData['Senha']) {
        $msg = 'Senha atual incorreta!';
    } elseif ($nova_senha !== $confirma_senha) {
        $msg = 'As senhas não coincidem!';
    } elseif (strlen($nova_senha) < 4) {
        $msg = 'A nova senha deve ter pelo menos 4 caracteres!';
    } else {
        $stmt = $conn->prepare("UPDATE Usuario SET Senha = ? WHERE Nome = ?");
        $stmt->bind_param("ss", $nova_senha, $_SESSION['nome']);
        if ($stmt->execute()) {
            $msg = 'Senha alterada com sucesso!';
        } else {
            $msg = 'Erro ao alterar senha!';
        }
    }
}
