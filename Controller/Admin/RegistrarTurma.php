<?php

include '../../Conect/conector.php';

class Turma{
    public function addTurma(){
        $nome = $_POST['nomeTurma']??'';
        $anoLectivo = $_POST['anoLectivo']??'';
        $curso = $_POST['curso'];

        $conexao = new Conector();
        $conn = $conexao->getConexao();

        $sql = "INSERT INTO Turma(Nome, AnoLetivo,CursoID) VALUES(?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssi',$nome,$anoLectivo,$curso);
        if ($stmt->execute()) {
            $msg = urlencode('Turma cadastrada com sucesso!');
        } else {
            $msg = urlencode('Erro ao cadastrar turma.');
        }
        $redirectUrl = '../../View/Admin/AdicionarTurma.php?msg=' . $msg;
        header("Location: $redirectUrl");
        exit();
    }
}

$turma = new Turma();
$turma->addTurma();