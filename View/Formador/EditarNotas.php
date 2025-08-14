<?php
include '../../Conect/conector.php';
$conexao = new Conector();
$conn = $conexao->getConexao();

// Buscar todas notas
$sqlNotas = "SELECT NotaID, MatriculaID, ModuloID, Periodo, Valor FROM Nota";
$stmtNotas = $conn->prepare($sqlNotas);
$stmtNotas->execute();
$resultNotas = $stmtNotas->get_result();

// Função para buscar nome do aluno
function getNomeAluno($conn, $matriculaID) {
    $sqlAlunoID = "SELECT AlunoID FROM Matricula WHERE MatriculaID = ?";
    $stmtAlunoID = $conn->prepare($sqlAlunoID);
    $stmtAlunoID->bind_param('i', $matriculaID);
    $stmtAlunoID->execute();
    $resultAluno = $stmtAlunoID->get_result();
    $alunoID = $resultAluno->fetch_assoc()['AlunoID'] ?? '';

    $sqlNome = "SELECT Nome FROM Aluno WHERE AlunoID = ?";
    $stmtNome = $conn->prepare($sqlNome);
    $stmtNome->bind_param('i', $alunoID);
    $stmtNome->execute();
    $resultNome = $stmtNome->get_result();
    return $resultNome->fetch_assoc()['Nome'] ?? '';
}

// Função para buscar nome do módulo
function getNomeModulo($conn, $moduloID) {
    $sqlModulo = "SELECT Nome FROM Modulo WHERE ModuloID = ?";
    $stmtModulo = $conn->prepare($sqlModulo);
    $stmtModulo->bind_param('i', $moduloID);
    $stmtModulo->execute();
    $resultModulo = $stmtModulo->get_result();
    return $resultModulo->fetch_assoc()['Nome'] ?? '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Style/notas.css">
    <title>Editar notas</title>
</head>
<body>
    <div class="container">
        
        <h1>Editar notas</h1>
        <table id="tabela-notas">
            <thead>
                <tr>
                    <th>Nota ID</th>
                    <th>Aluno</th>
                    <th>Módulo</th>
                    <th>Período</th>
                    <th>Nota</th>
                    <th>Resultado</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($resultNotas->num_rows > 0) {
                    while ($rowNota = $resultNotas->fetch_assoc()) {
                        $nomeAluno = getNomeAluno($conn, $rowNota['MatriculaID']);
                        $nomeModulo = getNomeModulo($conn, $rowNota['ModuloID']);
                        $resultado = ($rowNota['Valor'] >= 80) ? 'A' : 'NA';
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($rowNota['NotaID']) . "</td>";
                        echo "<td>" . htmlspecialchars($nomeAluno) . "</td>";
                        echo "<td>" . htmlspecialchars($nomeModulo) . "</td>";
                        echo "<td>" . htmlspecialchars($rowNota['Periodo']) . "</td>";
                        echo "<td>" . htmlspecialchars($rowNota['Valor']) . " %</td>";
                        echo "<td>" . $resultado . "</td>";
                        echo "<td>";
                        echo "<button onclick=\"document.getElementById('edit-" . $rowNota['NotaID'] . "').style.display='block'\">Editar</button>";
                        echo "</td>";
                        echo "</tr>";
                        // Formulário de edição oculto
                        echo "<tr id='edit-" . $rowNota['NotaID'] . "' style='display:none;background:#f9f9f9;'>";
                        echo "<td colspan='7'>";
                        echo "<form action='../../Controller/Formador/EditarNotas.php' method='post' style='display:flex;gap:16px;align-items:center;'>";
                        echo "<input type='hidden' name='notaID' value='" . $rowNota['NotaID'] . "'>";
                        echo "<label>Nota: <input type='number' name='nota' value='" . $rowNota['Valor'] . "' min='0' max='100' required></label>";
                        echo "<label>Período: <select name='periodo'><option value='1º Semestre'" . ($rowNota['Periodo']=='1º Semestre'?' selected':'') . ">1º Semestre</option><option value='2º Semestre'" . ($rowNota['Periodo']=='2º Semestre'?' selected':'') . ">2º Semestre</option></select></label>";
                        echo "<button type='submit'>Salvar</button>";
                        echo "<button type='button' onclick=\"document.getElementById('edit-" . $rowNota['NotaID'] . "').style.display='none'\">Cancelar</button>";
                        echo "</form>";
                        echo "</td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>Nenhuma nota registrada.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <div style="text-align:center; margin-top:32px;">
            <button onclick="window.location.href='Home.php'" style="padding:12px 32px; background:#1e3579; color:#fff; border:none; border-radius:8px; font-size:16px; font-weight:600; cursor:pointer; box-shadow:0 2px 8px rgba(30,53,121,0.10); transition:background 0.2s;">Voltar</button>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function(){
        $('#pesquisa-nota').on('keyup', function(){
            var valor = $(this).val().toLowerCase();
            $('#tabela-notas tbody tr').filter(function(){
                $(this).toggle($(this).text().toLowerCase().indexOf(valor) > -1);
            });
        });
    });
    </script>
</body>
</html>
