<?php
include '../../Controller/Admin/curso.php';
include '../../Controller/Admin/turma.php';  // inclua a classe turma

$curso = new cursos();
$cursos = $curso->listarCursos();

$turma = new turma();
$turmas = $turma->listarTurmas();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Style/login.css">
    <title>Registrar aluno</title>
</head>
<body>
    <div class="container">
        <h1>Registrar novo aluno</h1>
        <form action="../../Controller/Admin/RegistrarAluno.php" method="post">
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

        <p>
            <label for="">Data de nascimento </label>
            <input type="date" name="dataNasc" id="dataNasc" class="container-campo">
        </p>

        <p>
            <label for="">Data de inscrição: </label>
            <input type="date" name="matricula" id="matricula" class="container-campo">
        </p>

        <p>
            <label for="">Curso: </label>
            <select name="curso" id="curso" class="container-campo">
                <?php if (!empty($cursos)): ?>
                    <?php foreach ($cursos as $curso): ?>
                        <option value="<?= $curso['CursoID'] ?>">
                            <?= htmlspecialchars($curso['Nome']) ?>
                        </option>
                    <?php endforeach; ?>
                <?php else: ?>
                    <option value="">Nenhum curso encontrado</option>
                <?php endif; ?>
            </select>
        </p>

        <p>
            <label for="">Turma: </label>
            <select name="turma" id="turma" class="container-campo">
                <?php if (!empty($turmas)): ?>
                    <?php foreach ($turmas as $turma): ?>
                        <option value="<?= $turma['TurmaID'] ?>">
                            <?= htmlspecialchars($turma['Nome']) ?>
                        </option>
                    <?php endforeach; ?>
                <?php else: ?>
                    <option value="">Nenhuma turma encontrada</option>
                <?php endif; ?>
            </select>
        </p>

        <button type="submit" id="registrar" >Registrar</button>
        <button><a href="Home.php">Voltar</a></button>
        </form>
    </div>
</body>
</html>
