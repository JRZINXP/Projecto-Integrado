    <?php 

include '../../Conect/conector.php';

class LancarNotas{
    public $nome;
    public $codigo;
    public $turma;
    public $curso;
    public $modulo;
    public $periodo;
    public $nota;
    public $dados;
    
    public function __construct() {
        $this->codigo  = $_POST['userID']  ?? '';
        $this->turma   = $_POST['turma']   ?? '';
        $this->curso   = $_POST['curso']   ?? '';
        $this->modulo  = $_POST['modulo']  ?? '';
        $this->periodo = $_POST['periodo'] ?? '';
        $this->nota    = $_POST['nota']    ?? '';
    }
    
    public function matricula(){
        $conexao = new Conector();
        $conn = $conexao->getConexao();

        $sql = "SELECT * FROM Matricula WHERE AlunoID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $this->codigo);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $this->dados['matricula'] = $row['MatriculaID'];
        }
    }

    public function addNota(){
        $conexao = new Conector();
        $conn = $conexao->getConexao();

        $sql = "INSERT INTO Nota(MatriculaID,ModuloID,Periodo,Valor) VALUES(?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('iisi',$this->dados['matricula'],$this->modulo, $this->periodo, $this->nota);
        if ($stmt->execute()) {
            $msg = urlencode('Nota lançada com sucesso!');
        } else {
            $msg = urlencode('Erro ao lançar nota.');
        }
        $redirectUrl = '../../View/Formador/LancarNotas.php?msg=' . $msg;
        header("Location: $redirectUrl");
        exit();
    }
}

$nota = new LancarNotas();
$nota->matricula();
$nota->addNota();