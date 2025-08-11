<?php

include_once '../Conect/conector.php';

Class NotasModel{
    public $formador;
    public $turma;
    public $modulo;
    public $nota;

    
    public function getAlunoID(){
    $conexao = new Conector();
    $conn = $conexao->getConexao();

    $sql = "SELECT * from aluno where UsuarioID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $_SESSION['id']);
    $stmt->execute(); // faltava executar
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        return $row['AlunoID']; // Retorna o valor
    }

    return 'Not found'; // Se não encontrar
}


    public function querys(){

        $conexao = new Conector();
        $conn = $conexao->getConexao();

        $alunoQuery = "SELECT AlunoID from aluno where UsuarioID = ?";
        $stmtAluno = $conn->prepare($alunoQuery);
        $stmtAluno->bind_param('i',$_SESSION['id']);
        $alunoResult = $stmtAluno->get_result();

        $matriculaQuery = "SELECT MatriculaID from matricula where AlunoID = ?";
        $stmtMatricula = $conn->prepare($matriculaQuery);
        $stmtMatricula->bind_param('s',$_SESSION['AlunoID']);


        
    }
}