<?php
include_once '../../Conect/conector.php';
$conexao = new Conector();
$conn = $conexao->getConexao();

// Buscar todas notas
$sqlNotas = "SELECT * FROM Nota";
$stmtNotas = $conn->prepare($sqlNotas);
$stmtNotas->execute();
$resultNotas = $stmtNotas->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Style/notas.css">
    <title>Ver notas</title>
</head>

<body>
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
    <table>
        <div style="text-align:center; margin:32px 0 18px 0;">
            <input type="text" id="pesquisa-nota" placeholder="Pesquisar nota, aluno, módulo..." style="width:320px; padding:10px 16px; border-radius:8px; border:1px solid #1e3579; font-size:16px;">
        </div>
        <table id="tabela-notas">
        <thead>
            <tr>
                <th>Nota ID</th>
                <th>Código de aluno</th>
                <th>Nome do aluno</th>
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

                    // Buscar AlunoID da matrícula
                    $sqlAlunoID = "SELECT AlunoID FROM Matricula WHERE MatriculaID = ?";
                    $stmtAlunoID = $conn->prepare($sqlAlunoID);
                    $stmtAlunoID->bind_param('i', $rowNota['MatriculaID']);
                    $stmtAlunoID->execute();
                    $resultAluno = $stmtAlunoID->get_result();
                    $alunoID = $resultAluno->fetch_assoc()['AlunoID'] ?? '';

                    // Buscar Nome do Aluno
                    $sqlNome = "SELECT Nome FROM Aluno WHERE AlunoID = ?";
                    $stmtNome = $conn->prepare($sqlNome);
                    $stmtNome->bind_param('i', $alunoID);
                    $stmtNome->execute();
                    $resultNome = $stmtNome->get_result();
                    $nomeAluno = $resultNome->fetch_assoc()['Nome'] ?? '';

                    // Buscar Nome do Módulo
                    $sqlModulo = "SELECT Nome FROM Modulo WHERE ModuloID = ?";
                    $stmtModulo = $conn->prepare($sqlModulo);
                    $stmtModulo->bind_param('i', $rowNota['ModuloID']);
                    $stmtModulo->execute();
                    $resultModulo = $stmtModulo->get_result();
                    $nomeModulo = $resultModulo->fetch_assoc()['Nome'] ?? '';

                    // Exibir linha
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($rowNota['NotaID']) . "</td>";
                    echo "<td>" . htmlspecialchars($alunoID) . "</td>";
                    echo "<td>" . htmlspecialchars($nomeAluno) . "</td>";
                    echo "<td>" . htmlspecialchars($nomeModulo) . "</td>";
                    echo "<td>" . htmlspecialchars($rowNota['Periodo']) . "</td>";
                    echo "<td>" . htmlspecialchars($rowNota['Valor']) . " %" . "</td>";
                    $resultado = ($rowNota['Valor'] >= 80) ? 'A' : 'NA';
                    echo "<td>" . $resultado . "</td>";
                       echo "<td><button type='button' class='btn-editar-nota' data-notaid='" . $rowNota['NotaID'] . "' data-valor='" . $rowNota['Valor'] . "' data-periodo='" . htmlspecialchars($rowNota['Periodo']) . "'>Editar</button></td>";
                    echo "</tr>";
                       // Formulário de edição oculto
                       echo "<tr id='form-editar-" . $rowNota['NotaID'] . "' style='display:none;background:#f9f9f9;'>";
                       echo "<td colspan='8'>";
                       echo "<form class='form-editar-nota' action='../../Controller/Formador/EditarNotas.php' method='post' style='display:flex;gap:16px;align-items:center;'>";
                       echo "<input type='hidden' name='notaID' value='" . $rowNota['NotaID'] . "'>";
                       echo "<label>Nota: <input type='number' name='nota' value='" . $rowNota['Valor'] . "' min='0' max='100' required></label>";
                       echo "<label>Período: <select name='periodo'><option value='1º Semestre'" . ($rowNota['Periodo']=='1º Semestre'?' selected':'') . ">1º Semestre</option><option value='2º Semestre'" . ($rowNota['Periodo']=='2º Semestre'?' selected':'') . ">2º Semestre</option></select></label>";
                       echo "<button type='submit'>Salvar</button>";
                       echo "<button type='button' class='btn-cancelar-edicao' data-notaid='" . $rowNota['NotaID'] . "'>Cancelar</button>";
                       echo "</form>";
                       echo "</td></tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Nenhuma nota registrada.</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <div style="text-align:center; margin-top:32px;">
        <button onclick="window.location.href='Home.php'" style="padding:12px 32px; background:#1e3579; color:#fff; border:none; border-radius:8px; font-size:16px; font-weight:600; cursor:pointer; box-shadow:0 2px 8px rgba(30,53,121,0.10); transition:background 0.2s;">Voltar</button>
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
               // Mostrar formulário de edição ao clicar em editar
               $('.btn-editar-nota').on('click', function(){
                   var notaID = $(this).data('notaid');
                   // Oculta todos os formulários de edição
                   $('tr[id^="form-editar-"]').hide();
                   // Mostra o formulário da nota selecionada
                   $('#form-editar-' + notaID).show();
               });
               // Cancelar edição
               $('.btn-cancelar-edicao').on('click', function(){
                   var notaID = $(this).data('notaid');
                   $('#form-editar-' + notaID).hide();
               });
        });
        </script>
</body>

</html>