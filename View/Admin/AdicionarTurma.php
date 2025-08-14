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
        <?php if (isset($_GET['msg'])): ?>
            <div id="msg-sucesso" style="text-align:center;margin:18px 0;font-size:17px;font-weight:600;color:#27ae60;background:#eafaf1;padding:12px 0;border-radius:8px;">
                <?= htmlspecialchars($_GET['msg']) ?>
            </div>
            <script>
                setTimeout(function(){
                    var msg = document.getElementById('msg-sucesso');
                    if(msg) msg.style.display = 'none';
                }, 2000);
            </script>
        <?php endif; ?>
        <h1>Registrar Turma</h1>
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
            <button type="button" onclick="window.location.href='Home.php'">Voltar</button>
        </form>
    </div>
</body>

</html>