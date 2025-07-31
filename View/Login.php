<?php include_once '../Controller/BLogin.php'; ?>

<!DOCTYPE html>
<html lang="en">

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
        <h1>Sistema de gestão de notas</h1>
        <form action="" method="post">
            <p>
                <label for="">Email:</label>
                <input type="email" id="email" class="container-campo" name="email" placeholder="ex: silva@gmail.com">
            </p>
            <p>
                <label for="">Senha:</label>
                <input type="password" id="senha" class="container-campo" name="senha">
            </p>
            <button id="registrar">Entrar</button>
            <span><?php echo $erros; ?></span>
        </form>
    </div>
</body>

</html>