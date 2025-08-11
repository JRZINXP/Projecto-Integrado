<?php

include_once '../../Conect/conector.php';

class formador{

    public function listarFormadores() {
        $conexao = new Conector();
        $conn = $conexao->getConexao();

        // Ajusta charset antes da query
        $conn->set_charset("utf8mb4");

        $sql = "SELECT FormadorID, Nome FROM formador";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        $formadores = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $formadores[] = $row;
            }
        }

        return $formadores;
    }
}
