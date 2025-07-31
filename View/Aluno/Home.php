<?php 
    session_start();
    include '../../Controller/Aluno/Home.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Style/home.css">
    <title>Home</title>
</head>
<body>
    <div id="container">
        <div></div>
        <div>
            <h1>Bem-vindo, <?php echo $_SESSION['nome']; echo $_SESSION['tipo']?></h1>
            <p>Você está na página inicial do aluno.</p>
            <p>Nesta página você poderá ver suas notas, e seu aproveitamento</p>
        </div>
        <div>Div 3</div>
    </div>
</body>
</html>