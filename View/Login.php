<?php include_once '../Controller/BLogin.php'; ?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../Style/login.css">
    <style>
        span {
            display: block;
            text-align: center;
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Sistema de Gestão de Notas</h1>
        <form id="formLogin" action="../Controller/BLogin.php" method="post">
            <p>
                <label>Email:</label>
                <input type="email" id="email" class="container-campo" name="email" placeholder="ex: silva@gmail.com" required>
            </p>
            <p>
                <label>Senha:</label>
                <input type="password" id="senha" class="container-campo" name="senha" required>
            </p>
            <button id="registrar" type="submit">Entrar</button>
            <span id="resposta"></span>
        </form>
    </div>
</body>
</html>
