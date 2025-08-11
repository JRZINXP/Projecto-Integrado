<?php
include '../../Controller/Admin/curso.php';
$curso = new cursos();
$cursos = $curso->listarCursos();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Style/login.css">
    <title>Registrar turma</title>
</head>

<body>
    <div class="container">
        <form action="../../Controller/Admin/RegistrarTurma.php" method="post">
            <p>
                <label for="">Nome: </label>
                <input type="text" name="nomeTurma" id="nomeTurma" class="container-campo">
            </p>

            <p>
                <label for="">Ano lectivo: </label>
                <input type="number" name="anoLectivo" id="anoLectivo" class="container-campo">
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


            <button type="submit">Registrar</button>
            <button><a href="Home.php">Voltar</a></button>
        </form>
    </div>
</body>

</html>