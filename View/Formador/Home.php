<?php 
    session_start();
    include '../../Controller/Formador/Home.php';
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
    <div class="card">
        <h2>Lançar notas</h2>
        <p>Registre rapidamente as notas dos alunos, mantendo tudo organizado e atualizado.</p>
        <a href="LancarNotas.php" class="btn">Lançar notas</a>
    </div>

    <div class="card">
        <h2>Ver e editar notas</h2>
        <p>Acesse, revise e atualize as notas lançadas para garantir que tudo esteja correto.</p>
        <a href="VerNotas.php" class="btn">Ver e editar notas</a>
    </div>

    <div class="card">
        <h2>Olá, <?php echo $_SESSION['nome']; ?> 👋</h2>
        <p>Bem-vindo à sua área de formador!</p>
        <p>Gerencie avaliações, acompanhe o progresso dos alunos e mantenha o desempenho em dia.</p>
    </div>
</div>
</body>
</html>