<?php
session_start(); // Necessário para acessar variáveis de sessão
include_once '../../Conect/conector.php';
$conexao = new Conector();
$conn = $conexao->getConexao();

// Pegando o ID do aluno logado
// Supondo que no login você salvou $_SESSION['AlunoID'] ou $_SESSION['UsuarioID']
if (!isset($_SESSION['AlunoID'])) {
    die("Acesso negado. Você precisa estar logado como aluno.");
}
$alunoLogadoID = $_SESSION['AlunoID'];

// Buscar todas as notas SOMENTE do aluno logado
$sqlNotas = "SELECT * FROM Nota 
             WHERE MatriculaID IN (
                 SELECT MatriculaID FROM Matricula WHERE AlunoID = ?
             )";
$stmtNotas = $conn->prepare($sqlNotas);
$stmtNotas->bind_param('i', $alunoLogadoID);
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
    <div style="text-align:center; margin:20px 0;">
        <input type="text" id="pesquisa-nota" placeholder="Pesquisar..." style="padding:8px 12px; width:300px; font-size:16px; border-radius:6px; border:1px solid #ccc;">
    </div>

    <table id="tabelaNotas">
        <thead>
            <tr>
                <th>Código de aluno</th>
                <th>Nome do aluno</th>
                <th>Módulo</th>
                <th>Período</th>
                <th>Nota</th>
                   <th>Resultado</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($resultNotas->num_rows > 0) {
                while ($rowNota = $resultNotas->fetch_assoc()) {

                    // Buscar Nome do Módulo
                    $sqlModulo = "SELECT Nome FROM Modulo WHERE ModuloID = ?";
                    $stmtModulo = $conn->prepare($sqlModulo);
                    $stmtModulo->bind_param('i', $rowNota['ModuloID']);
                    $stmtModulo->execute();
                    $resultModulo = $stmtModulo->get_result();
                    $nomeModulo = $resultModulo->fetch_assoc()['Nome'] ?? '';

                    // Buscar Nome do aluno logado
                    $sqlNome = "SELECT Nome FROM Aluno WHERE AlunoID = ?";
                    $stmtNome = $conn->prepare($sqlNome);
                    $stmtNome->bind_param('i', $alunoLogadoID);
                    $stmtNome->execute();
                    $resultNome = $stmtNome->get_result();
                    $nomeAluno = $resultNome->fetch_assoc()['Nome'] ?? '';

                    // Exibir linha
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($alunoLogadoID) . "</td>";
                    echo "<td>" . htmlspecialchars($nomeAluno) . "</td>";
                    echo "<td>" . htmlspecialchars($nomeModulo) . "</td>";
                    echo "<td>" . htmlspecialchars($rowNota['Periodo']) . "</td>";
                    echo "<td>" . htmlspecialchars($rowNota['Valor']) ." %". "</td>";
                       $resultado = ($rowNota['Valor'] >= 80) ? 'A' : 'NA';
                       echo "<td>" . $resultado . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Nenhuma nota registrada.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <div style="text-align:center; margin-top:32px;">
        <button onclick="window.location.href='Home.php'" style="padding:12px 32px; background:#1e3579; color:#fff; border:none; border-radius:8px; font-size:16px; font-weight:600; cursor:pointer; box-shadow:0 2px 8px rgba(30,53,121,0.10); transition:background 0.2s;">Voltar</button>
    </div>

    <script>
        // Função de pesquisa
        document.getElementById('pesquisaNotas').addEventListener('keyup', function() {
            let filtro = this.value.toLowerCase();
            let linhas = document.querySelectorAll('#tabelaNotas tbody tr');

            linhas.forEach(function(linha) {
                let textoLinha = linha.textContent.toLowerCase();
                if (textoLinha.indexOf(filtro) > -1) {
                    linha.style.display = '';
                } else {
                    linha.style.display = 'none';
                }
            });
        });
    </script>
</body>

</html>
