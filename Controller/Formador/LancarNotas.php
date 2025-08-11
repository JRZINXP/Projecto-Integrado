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
        $this->nome    = $_POST['nome']    ?? '';
        $this->codigo  = $_POST['codigo']  ?? '';
        $this->turma   = $_POST['turma']   ?? '';
        $this->curso   = $_POST['curso']   ?? '';
        $this->modulo  = $_POST['modulo']  ?? '';
        $this->periodo = $_POST['periodo'] ?? '';
        $this->nota    = $_POST['nota']    ?? '';
    }
    
    public function turma(){
        $conexao = new Conector();
        $conn = $conexao->getConexao();

        $sql = "SELECT * FROM Turma WHERE Nome = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $this->turma);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $turmaID = $row['TurmaID'];
            $this->dados['turmaID'] = $turmaID;
        }
    }

    public function matricula(){
        $conexao = new Conector();
        $conn = $conexao->getConexao();


        $sql = "SELECT * FROM Matricula WHERE TurmaID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $this->dados['turmaID']);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $matriculaID = $row['MatriculaID'];
            $this->dados['matricula'] = $matriculaID;
        }
    }

    public function modulo(){
        $conexao = new Conector();
        $conn = $conexao->getConexao();

        $sql = "SELECT * FROM Modulo WHERE Nome = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $this->modulo);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $moduloID = $row['ModuloID'];
            $this->dados['moduloID'] = $moduloID;
        }   
    }

    public function addNotas(){
        $conexao = new Conector();
        $conn = $conexao->getConexao();
        

        $sql = "INSERT INTO Nota(MatriculaID, ModuloID, Periodo, Valor) VALUES (?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('iisd', $this->dados['matricula'], $this->dados['moduloID'], $this->periodo, $this->nota);
        $stmt->execute();
    } 
}

$lancar = new LancarNotas();
$lancar->turma();
$lancar->matricula();
$lancar->modulo();
$lancar->addNotas();