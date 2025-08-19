<?php
include '../../Conect/conector.php';

class Aluno
{
    public $nome;
    public $email;
    public $senha;
    public $dataNasc;
    public $curso;
    public $turma;

    private $dados;

    public function __construct()
    {
        session_start();

        $this->nome = $_POST['nome'] ?? '';
        $this->email = $_POST['email'] ?? '';
        $this->senha = $_POST['senha'] ?? '';
        $this->dataNasc = $_POST['dataNasc'] ?? '';
        $this->curso = $_POST['curso'] ?? '';
        $this->turma = $_POST['turma'] ?? '';
    }

    public function addUser()
    {
        $conexao = new Conector();
        $conn = $conexao->getConexao();

        $sql = "INSERT INTO Usuario(Nome,Email,Senha,Tipo) VALUES (?,?,?,'Aluno')";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sss', $this->nome, $this->email, $this->senha);
        $stmt->execute();
    }

    public function buscarDados()
    {
        $conexao = new Conector();
        $conn = $conexao->getConexao();

        $sql = "SELECT * FROM Usuario where Email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $this->email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $this->dados = ['nome' => $row['Nome'], 'email' => $row['Email'], 'id' => $row['UsuarioID']];
        }
    }

    public function addAluno()
    {
        $conexao = new Conector();
        $conn = $conexao->getConexao();

        $sql = "INSERT INTO Aluno(Nome,Email,DataNascimento,UsuarioID) VALUES (?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssi', $this->dados['nome'], $this->dados['email'], $this->dataNasc, $this->dados['id']);
        $stmt->execute();
    }

    public function idAluno()
    {
        $conexao = new Conector();
        $conn = $conexao->getConexao();

        $sql = "SELECT * FROM Aluno where UsuarioID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $this->dados['id']);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $alunoID = $row['AlunoID'];
            $this->dados['alunoID'] = $alunoID;
        }
    }

    public function addMatricula()
    {
        $conexao = new Conector();
        $conn = $conexao->getConexao();

        $sql = "INSERT INTO Matricula(AlunoID,TurmaID) VALUES (?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ii', $this->dados['alunoID'], $this->turma);
        $stmt->execute();
    }
}

$user = new Aluno();
$user->addUser();
$user->buscarDados();
$user->addAluno();
$user->idAluno();
$user->addMatricula();
// Redireciona com mensagem de sucesso
header('Location: ../../View/Admin/AdicionarAluno.php?msg=Aluno registrado com sucesso!');
exit();
