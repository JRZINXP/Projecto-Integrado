<?php 
    session_start();
    include '../../Controller/Admin/Home.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <h1>Bem-vindo, <?php echo $_SESSION['nome']; echo $_SESSION['tipo'] ?></h1>
</body>
</html>