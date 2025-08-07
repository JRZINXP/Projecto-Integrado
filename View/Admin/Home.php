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
    <div id="container">
        <div class="card">
            <h2>📊 Aproveitamento</h2>
            <p>Consulte gráficos, médias e progresso geral nas disciplinas.</p>
            <a href="#" class="btn">Ver Aproveitamento</a>
        </div>

        <div class="card">
            <h2>Olá, <?php echo $_SESSION['nome']; ?> 👋</h2>
            <p>Bem-vindo à sua área do aluno!</p>
            <p>Aqui você pode acompanhar o seu desempenho escolar.</p>
        </div>

        <div class="card">
            <h2>📝 Notas</h2>
            <p>Veja as suas notas mais recentes e resultados de avaliações.</p>
            <a href="Notas.php" class="btn">Ver Notas</a>
        </div>
    </div>
</body>
</html>