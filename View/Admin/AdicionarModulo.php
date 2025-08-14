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
        <?php if (isset($_GET['msg'])): ?>
        <div id="msg-sucesso" style="text-align:center;margin:18px 0;font-size:17px;font-weight:600;color:#27ae60;background:#eafaf1;padding:12px 0;border-radius:8px;">
            <?= htmlspecialchars($_GET['msg']) ?>
        </div>
        <script>
            setTimeout(function(){
                var msg = document.getElementById('msg-sucesso');
                if(msg) msg.style.display = 'none';
            }, 3000);
        </script>
    <?php endif; ?>
    <h1>Adicionar Módulo</h1>
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
            <button type="button" onclick="window.location.href='Home.php'">Voltar</button>
        </form>
    </div>
</body>

</html>