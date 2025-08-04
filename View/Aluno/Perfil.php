<?php
session_start();
include '../../Controller/Aluno/Perfil.php';

// Supondo que $userData seja preenchido pelo Perfil.php
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Style/perfil.css">
    <title>Perfil do Usuário</title>
</head>
<body>
    <div class="perfil-container">
        <h1>Perfil de <?php echo htmlspecialchars($_SESSION['nome']); ?></h1>
        <div class="dados-usuario">
            <p><strong>Nome:</strong> <?php echo htmlspecialchars($userData['Nome'] ?? $_SESSION['nome']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($userData['Email'] ?? ''); ?></p>
            <p><strong>Tipo:</strong> <?php echo htmlspecialchars($userData['Tipo'] ?? $_SESSION['tipo']); ?></p>
        </div>
        <hr>
        <h2>Alterar Senha</h2>
        <form method="post" action="../../Controller/Aluno/Perfil.php">
            <label for="senha_atual">Senha atual:</label>
            <input type="password" id="senha_atual" name="senha_atual" required class="perfil-campo">
            <label for="nova_senha">Nova senha:</label>
            <input type="password" id="nova_senha" name="nova_senha" required class="perfil-campo">
            <label for="confirma_senha">Confirmar nova senha:</label>
            <input type="password" id="confirma_senha" name="confirma_senha" required class="perfil-campo">
            <button type="submit" name="alterar_senha">Alterar Senha</button>
            <span class="perfil-erro">
                <?php if (!empty($msg)) echo $msg; ?>
            </span>
        </form>
        <a href="Home.php">Voltar para Home</a>
    </div>
</body>
</html>
