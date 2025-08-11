<?php
include '../../Controller/Admin/curso.php';
include '../../Controller/Admin/formador.php';
include '../../Controller/Admin/turma.php';

$curso = new cursos();
$cursos = $curso->listarCursos();

$formador = new formador();
$formadores = $formador->listarFormadores();

$turma = new turma();
$turmas = $turma->listarTurmas();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Style/login.css">
    <title>Adicionar módulo</title>
</head>

<body>
    <div class="container">
        <form action="../../Controller/Admin/RegistraModulo.php" method="post">
            <p>
                <label for="">Nome do módulo:</label>
                <input type="text" id="nome" name="nome" class="container-campo">
            </p>

            <p>
                <label for="">Curso:</label>
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
                <label for="formador">Formador:</label>
                <select name="formador" id="formador" class="container-campo" required>
                    <?php if (!empty($formadores)): ?>
                        <?php foreach ($formadores as $f): ?>
                            <option value="<?= $f['FormadorID'] ?>"><?= htmlspecialchars($f['Nome']) ?></option>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <option value="">Nenhum formador encontrado</option>
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
            
            <button type="submit" id="registrar">Registrar</button>
            <button><a href="Home.php">Voltar</a></button>
        </form>
    </div>
</body>

</html>