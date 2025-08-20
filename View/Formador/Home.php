<?php 
    session_start();
    include '../../Controller/Formador/Home.php';
    include_once '../../Controller/validaSessao.php';
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
    <div class="top-bar" style="display: flex; justify-content: flex-end; align-items: center; gap: 18px; background: linear-gradient(90deg, #1e3579 60%, #4a90e2 100%); box-shadow: 0 2px 12px 0 rgba(30,53,121,0.10); padding: 18px 32px 18px 0;">
        <form action="../../Controller/logout.php" method="post" style="display:inline; margin:0;">
            <button type="submit" class="btn" style="padding:10px 22px; font-size:15px; border-radius:24px; background:#e74c3c; color:#fff; font-weight:600; border:none; cursor:pointer; transition:background 0.2s;">Sair</button>
        </form>
    </div>
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