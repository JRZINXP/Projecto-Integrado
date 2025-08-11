<?php
include '../../Controller/Admin/curso.php';
include '../../Controller/Admin/turma.php';  // inclua a classe turma
include '../../Controller/Admin/modulo.php';

$curso = new cursos();
$cursos = $curso->listarCursos();

$turma = new turma();
$turmas = $turma->listarTurmas();

$modulo = new Modulo();
$modulos = $modulo->listarModulos();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Style/login.css">
    <title>Laçar notas</title>
</head>

<body>
    <div class="container">
        <form action="../../Controller/Formador/LancarNotas.php" method="post">
            <p>
                <label for="nome">Nome do aluno:</label>
                <input type="text" id="nome" name="nome" class="container-campo">
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
                <label for="modulo">Módulo:</label>
                <select name="modulo" id="modulo" class="container-campo">
                    <?php if (!empty($modulo)): ?>
                    <?php foreach ($modulos as $modulo): ?>
                        <option value="<?= $modulo['ModuloID'] ?>">
                            <?= htmlspecialchars($modulo['Nome']) ?>
                        </option>
                    <?php endforeach; ?>
                <?php else: ?>
                    <option value="">Nenhum curso encontrado</option>
                <?php endif; ?>
                </select>
            </p>

            <p>
                <label for="periodo">Periodo:</label>
                <select name="periodo" id="periodo" class="container-campo">
                    <option value="1º Semestre">1º Semestre</option>
                    <option value="2º Semestre">2º Semestre</option>
                </select>
            </p>

            <p>
                <label for="nota">Nota:</label>
                <input type="number" name="nota" id="nota" class="container-campo">
            </p>

            <button type="submit">Lançar nota</button>
            <button type="button"><a href="Home.php">Voltar</a></button>
        </form>
    </div>
</body>

</html>