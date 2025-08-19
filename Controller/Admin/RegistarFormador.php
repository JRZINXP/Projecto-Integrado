<?php
include '../../Conect/conector.php';

class Formador
{
    private $dados;

    public function addUser()
    {

        $conexao = new Conector();
        $conn = $conexao->getConexao();

        $nome = $_POST['nome'] ?? '';
        $email = $_POST['email'] ?? '';
        $senha = $_POST['senha'] ?? '';
        $sql = "INSERT INTO Usuario(Nome,Email,Senha,Tipo) VALUES (?,?,?, 'Formador')";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sss', $nome, $email, $senha);
        $stmt->execute();
        $_SESSION['email'] = $email;
    }

    public function buscarDados()
    {
        $conexao = new Conector();
        $conn = $conexao->getConexao();

        $sql = "SELECT * FROM Usuario where Email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $_SESSION['email']);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $this->dados = ['id' => $row['UsuarioID'], 'nome' => $row['Nome'], 'email' => $row['Email']];
        }
    }

    public function addFormador()
    {
        $conexao = new Conector();
        $conn = $conexao->getConexao();

        $sql = "INSERT INTO Formador(Nome,Email,UsuarioID) VALUES (?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssi', $this->dados['nome'], $this->dados['email'], $this->dados['id']);
        if ($stmt->execute()) {
            $msg = urlencode('Formador cadastrado com sucesso!');
        } else {
            $msg = urlencode('Erro ao cadastrar formador.');
        }

        $redirectUrl = '../../View/Admin/AdicionarFormador.php?msg=' . $msg;
        header("Location: $redirectUrl");
        exit();
    }
}

$user = new Formador();
$user->addUser();
$user->buscarDados();
$user->addFormador();
