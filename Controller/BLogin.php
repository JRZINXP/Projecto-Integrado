<?php
include_once '../Conect/conector.php';

class Login
{
    public function verificar()
    {
        session_start();
        $email = $_POST['email'] ?? '';
        $senha = $_POST['senha'] ?? '';
        $erros = '';
        $_SESSION['email'] = $email;


        $conexao = new Conector();
        $conn = $conexao->getConexao();

        $sql = "SELECT * FROM Usuario WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($senha, $row['Senha'])) {
                $_SESSION['nome'] = $row['Nome'];
                $_SESSION['tipo'] = $row['Tipo'];
                $_SESSION['id'] = $row['UsuarioID'];

                // Criar token aleatório
                $token = bin2hex(random_bytes(32));

                // Capturar IP do usuário
                $ip = $_SERVER['REMOTE_ADDR'];

                // Definir data de expiração (7 dias à frente)
                $dataExpiracao = date('Y-m-d H:i:s', time() + (7 * 24 * 60 * 60));

                // Salvar sessão no banco
                $sqlSessao = "INSERT INTO Sessao (UsuarioID, Token, DataExpiracao, IP) VALUES (?, ?, ?, ?)";
                $stmtSessao = $conn->prepare($sqlSessao);
                $stmtSessao->bind_param("isss", $row['UsuarioID'], $token, $dataExpiracao, $ip);
                $stmtSessao->execute();

                // Salvar token no cookie para autenticação posterior (7 dias)
                setcookie('session_token', $token, time() + (7 * 24 * 60 * 60), "/", "", false, true);

                // Redirecionar conforme o tipo
                if ($row['Tipo'] === 'Aluno') {
                    $sqlAluno = "SELECT * FROM Aluno WHERE email = ?";
                    $stmtAluno = $conn->prepare($sqlAluno);
                    $stmtAluno->bind_param("s", $email);
                    $stmtAluno->execute();
                    $result = $stmtAluno->get_result();
                    if ($result->num_rows > 0) {
                        $rowAluno = $result->fetch_assoc();
                        $_SESSION['AlunoID'] = $rowAluno['AlunoID'];
                    }
                    header("Location: ../View/Aluno/Home.php");
                    exit();
                } elseif ($row['Tipo'] === 'Formador') {
                    header("Location: ../View/Formador/Home.php");
                    exit();
                } elseif ($row['Tipo'] === 'Admin') {
                    header("Location: ../View/Admin/Home.php");
                    exit();
                }
                } else {
                    header("Location: ../View/Login.php?erro=senha");
                    exit();
            }
        } else {
                header("Location: ../View/Login.php?erro=email");
                exit();
        }

        return $erros;
    }
}

$erros = '';
$login = new Login();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $erros = $login->verificar();
}
