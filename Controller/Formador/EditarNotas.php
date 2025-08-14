<?php 
include '../../Conect/conector.php';

class EditarNotas{
    public $notaID;
    public $nota;
    public $periodo;
    
    public function __construct() {
        $this->notaID  = $_POST['notaID']  ?? '';
        $this->nota    = $_POST['nota']    ?? '';
        $this->periodo = $_POST['periodo'] ?? '';
    }

    public function editarNota(){
        $conexao = new Conector();
        $conn = $conexao->getConexao();

        $sql = "UPDATE Nota SET Valor = ?, Periodo = ? WHERE NotaID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('isi', $this->nota, $this->periodo, $this->notaID);
        if ($stmt->execute()) {
            $msg = urlencode('Nota editada com sucesso!');
        } else {
            $msg = urlencode('Erro ao editar nota.');
        }
        $redirectUrl = '../../View/Formador/VerNotas.php?msg=' . $msg;
        header("Location: $redirectUrl");
        exit();
    }
}

$nota = new EditarNotas();
$nota->editarNota();
