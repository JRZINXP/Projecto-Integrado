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
        <?php if (isset($_GET['msg'])): ?>
            <div id="msg-sucesso" style="text-align:center;margin:18px 0;font-size:17px;font-weight:600;color:#27ae60;background:#eafaf1;padding:12px 0;border-radius:8px;">
                <?= htmlspecialchars($_GET['msg']) ?>
            </div>
            <script>
                setTimeout(function() {
                    var msg = document.getElementById('msg-sucesso');
                    if (msg) msg.style.display = 'none';
                }, 3000);
            </script>
        <?php endif; ?>
        <h1>Lançar notas</h1>
        <form action="../../Controller/Formador/LancarNotas.php" method="post">
            <p>
                <label for="nome">Código do aluno:</label>
                <input type="number" id="userID" name="userID" class="container-campo">
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
            <button type="button" onclick="window.location.href='Home.php'">Voltar</button>
        </form>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>

        <script>
            $(document).ready(function() {
                $("form").validate({
                    rules: {
                        nota: {
                            required: true,
                            number: true,
                            min: 0,
                            max: 100
                        }
                    },
                    messages: {
                        nota: {
                            required: "Por favor, insira a nota.",
                            number: "A nota deve ser um número.",
                            min: "A nota mínima é 0.",
                            max: "A nota máxima é 100."
                        }
                    },
                    errorElement: "div",
                    errorPlacement: function(error, element) {
                        error.css({
                            color: "red",
                            marginTop: "5px",
                            fontSize: "14px"
                        });
                        error.insertAfter(element);
                    }
                });
            });
        </script>

    </div>
</body>

</html>