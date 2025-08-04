<?php
include_once '../Conect/conector.php';

class Login
{
    public function verificar()
    {
        $email = $_POST['email'] ?? '';
        $senha = $_POST['senha'] ?? '';
        $erros = '';

        $conexao = new Conector();
        $conn = $conexao->getConexao();

        $sql = "SELECT * FROM Usuario WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($senha === $row['Senha']) {
                session_start();
                $_SESSION['nome'] = $row['Nome'];
                $_SESSION['tipo'] = $row['Tipo'];
                // Lembrar usuário por 1h
                setcookie('user_email', $email, time() + 3600, "/");
                if ($row['Tipo'] === 'Aluno') {
                    header("Location: ../View/Aluno/Home.php");
                    exit();
                } elseif ($row['Tipo'] === 'Formador') {
                    header("Location: ../View/Formador/Home.php");
                    exit();
                } elseif ($row['Tipo'] === 'Admin') {
                    header("Location: ../View/Admin/Home.php");
                    exit();
                } else {
                    $erros .= "Tipo de usuário desconhecido.<br>";
                }
            } else {
                $erros .= "Senha incorreta.<br>";
            }
        } else {
            $erros .= "Email não encontrado.<br>";
        }

        return $erros;
    }
}

$erros = ''; 
$login = new Login();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $erros = $login->verificar();
}