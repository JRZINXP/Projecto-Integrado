<?php 
    session_start();
    include '../../Controller/Aluno/Home.php';
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área do Aluno</title>
    <link rel="stylesheet" href="../../Style/home.css">
</head>


<body>
    <div class="top-bar" style="display: flex; justify-content: flex-end; align-items: center; gap: 18px; background: linear-gradient(90deg, #1e3579 60%, #4a90e2 100%); box-shadow: 0 2px 12px 0 rgba(30,53,121,0.10); padding: 18px 32px 18px 0;">
        <a href="Perfil.php" class="perfil-link" style="margin-right: 8px;">👤 Meu Perfil</a>
        <form action="../../Controller/logout.php" method="post" style="display:inline; margin:0;">
            <button type="submit" class="btn" style="padding:10px 22px; font-size:15px; border-radius:24px; background:#e74c3c; color:#fff; font-weight:600; border:none; cursor:pointer; transition:background 0.2s;">Sair</button>
        </form>
    </div>
    <div id="container">
        <div class="card">
            <h2>📊 Aproveitamento</h2>
            <p>Consulte gráficos, médias e progresso geral nas disciplinas.</p>
            <a href="#" class="btn">Ver Aproveitamento</a>
        </div>

        <div class="card">
            <h2>📝 Notas</h2>
            <p>Veja as suas notas mais recentes e resultados de avaliações.</p>
            <a href="Notas.php" class="btn">Ver Notas</a>
        </div>

        <div class="card">
            <h2>Olá, <?php echo $_SESSION['nome']; ?> 👋</h2>
            <p>Bem-vindo à sua área do aluno!</p>
            <p>Aqui você pode acompanhar o seu desempenho escolar.</p>
        </div>
    </div>
</body>

</html>