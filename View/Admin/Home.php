<?php
include '../../Controller/Admin/Home.php';
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
    <h1>Painel de admin</h1>
    <div id="container">
        <div class="card">
            <h2>Registrar módulos</h2>
            <p>Registre os módulos disponíveis para organizar melhor o conteúdo das turmas.</p>
            <a href="AdicionarModulo.php" class="btn">Registrar e editar Módulos</a>
        </div>


        <div class="card">
            <h2>Registrar Nova Turma</h2>
            <p>Adicione novas turmas ao sistema e organize os alunos de forma eficiente.</p>
            <a href="AdicionarTurma.php" class="btn">Registrar Turma</a>
        </div>

        <div class="card">
            <h2>Registrar Novos Alunos</h2>
            <p>Cadastre novos alunos e mantenha o banco de dados sempre atualizado.</p>
            <a href="AdicionarAluno.php" class="btn">Registrar aluno</a>
        </div>

        <div class="card">
            <h2>Registrar Novos Formadores</h2>
            <p>Inclua novos formadores para ampliar a equipe e oferecer mais qualidade no ensino.</p>
            <a href="AdicionarFormador.php" class="btn">Registrar formador</a>
        </div>

        <div class="card">
            <h2>Bem-vindo ao painel de admin</h2>
            <p>Gerencie turmas, alunos, formadores e acompanhe o andamento de todo o sistema.</p>
        </div>

    </div>
</body>

</html>