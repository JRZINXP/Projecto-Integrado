<?php
include_once '../../Conect/conector.php';

class modulo{
    public function listarModulos() {
        $conexao = new Conector();
        $conn = $conexao->getConexao();

        // Ajuste charset da conexão para UTF-8 antes da query
        $conn->set_charset("utf8mb4");

        $sql = "SELECT ModuloID, Nome FROM modulo";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        $modulo = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $modulo[] = $row; 
            }
        }
        return $modulo;
    }
}