<?php

include_once '../../Conect/conector.php';

class turma {
    
    public function listarTurmas() {
        $conexao = new Conector();
        $conn = $conexao->getConexao();

        // Ajuste charset da conexão para UTF-8 antes da query
        $conn->set_charset("utf8mb4");

        $sql = "SELECT TurmaID, Nome FROM Turma";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        $turmas = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $turmas[] = $row; 
            }
        }

        return $turmas;
    }
}
