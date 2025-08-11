<?php
include_once '../../Conect/conector.php';

class Modulo
{
    private $dados = [];
    public $nome;
    public $curso;
    public $formador;
    public $turma;

    public function __construct(){
        $this->nome = $_POST['nome']?? '';
        $this->curso = $_POST['curso']?? 0;
        $this->formador = $_POST['formador']?? 0;
        $this->turma = $_POST['turma']?? 0;
    }

    public function addModulo(){
    $conexao = new Conector();
    $conn = $conexao->getConexao();

    $sql = "INSERT INTO Modulo(Nome,CursoID) VALUES(?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si', $this->nome, $this->curso);
    $stmt->execute();

    // Salva o ID recém inserido
    $this->dados['moduloID'] = $conn->insert_id;
}

    public function lecionar()
    {
        $conexao = new Conector();
        $conn = $conexao->getConexao();

        $sql = "INSERT INTO Leciona(FormadorID,ModuloID,TurmaID) VALUES(?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('iii', $this->formador, $this->dados['moduloID'], $this->turma);
        $stmt->execute();
    }
}

$modulo = new Modulo();
$modulo->addModulo();
$modulo->lecionar();
