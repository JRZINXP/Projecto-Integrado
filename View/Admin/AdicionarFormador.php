<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Style/login.css">
    <title>Registrar formador</title>
</head>
<body>
    <div class="container">
        <h1>Registrar novo formador</h1>
        <form action="../../Controller/Admin/RegistarFormador.php" method="post">
        <p>
            <label for="">Nome: </label>
            <input type="text" name="nome" id="nome" class="container-campo">
        </p>

        <p>
            <label for="">Email: </label>
            <input type="email" name="email" id="email" class="container-campo">
        </p>
        
        <p>
            <label for="">Senha: </label>
            <input type="password" name="senha" id="senha" class="container-campo">
        </p>

        <button type="submit" id="registrar" >Registrar</button>
        <button><a href="Home.php">Voltar</a></button>
    </form>
    </div>
</body>
</html>