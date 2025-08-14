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
            <p><strong>Email:</strong> <?php echo htmlspecialchars($_SESSION['email'] ?? ''); ?></p>
            <p><strong>Tipo:</strong> <?php echo htmlspecialchars($userData['Tipo'] ?? $_SESSION['tipo']); ?></p>
        </div>
        <hr>
        <h2>Alterar Senha</h2>
        <form id="formPerfil" method="post" action="../../Controller/Aluno/Perfil.php">
            <label for="senha_atual">Senha atual:</label>
            <input type="password" id="senha_atual" name="senha_atual" class="perfil-campo">
            <label for="nova_senha">Nova senha:</label>
            <input type="password" id="nova_senha" name="nova_senha" class="perfil-campo">
            <label for="confirma_senha">Confirmar nova senha:</label>
            <input type="password" id="confirma_senha" name="confirma_senha" class="perfil-campo">
            <button type="submit" name="alterar_senha">Alterar Senha</button>
            <span class="perfil-erro" id="perfil-feedback">
                <?php if (!empty($msg)) echo $msg; ?>
            </span>
        </form>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $("#formPerfil").on("submit", function(e) {
                    e.preventDefault();
                    var form = $(this);
                    $.ajax({
                        url: form.attr("action"),
                        type: form.attr("method"),
                        data: form.serialize(),
                        success: function(response) {
                            if (response.trim().toLowerCase().indexOf("sucesso") !== -1) {
                                $("#perfil-feedback").css("color", "#27ae60").html("✔ " + response);
                            } else {
                                $("#perfil-feedback").css("color", "#e74c3c").html("✖ " + response);
                            }
                        },
                        error: function() {
                            $("#perfil-feedback").css("color", "#e74c3c").html("✖ Erro ao enviar.");
                        }
                    });
                });
            });
        </script>
        <a href="Home.php">Voltar para Home</a>
    </div>
</body>
</html>