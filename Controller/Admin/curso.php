<?php

include_once '../../Conect/conector.php';

class cursos {
    
    public function listarCursos() {
        $conexao = new Conector();
        $conn = $conexao->getConexao();

        // Busca CursoID e Nome
        $sql = "SELECT CursoID, Nome FROM curso";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        $cursos = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $cursos[] = $row;
            }
        }
        
        // Ajuste charset da conexão para UTF-8
        $conn->set_charset("utf8mb4");

        return $cursos;
    }
}
