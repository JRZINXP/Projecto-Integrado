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
                <label for="turma">Turma:</label>
                <select name="turma" id="turma" class="container-campo">
                    <option value="TPW3">TPW3</option>
                    <option value="TPW1">TPW1</option>
                </select>
            </p>

            <p>
                <label for="curso">Curso:</label>
                <input type="text" id="curso" name="curso" class="container-campo">
            </p>

            <p>
                <label for="modulo">Módulo:</label>
                <select name="modulo" id="modulo" class="container-campo">
                    <option value="PLOO">PLOO</option>
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