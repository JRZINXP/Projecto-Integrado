<?php
include_once '../Conect/conector.php';

class Login
{
    public function verificar()
    {
        session_start();
        $email = $_POST['email'] ?? '';
        $senha = $_POST['senha'] ?? '';
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
            // Verifica senha (hash)
            if ($senha === $row['Senha']) {
                $_SESSION['nome'] = $row['Nome'];
                $_SESSION['tipo'] = $row['Tipo'];
                $_SESSION['id'] = $row['UsuarioID'];

                // Criar token aleatório
                $token = bin2hex(random_bytes(32));
                $ip = $_SERVER['REMOTE_ADDR'];
                $dataExpiracao = date('Y-m-d H:i:s', time() + (7 * 24 * 60 * 60));
                $sqlSessao = "INSERT INTO Sessao (UsuarioID, Token, DataExpiracao, IP) VALUES (?, ?, ?, ?)";
                $stmtSessao = $conn->prepare($sqlSessao);
                $stmtSessao->bind_param("isss", $row['UsuarioID'], $token, $dataExpiracao, $ip);
                $stmtSessao->execute();
                setcookie('session_token', $token, time() + (7 * 24 * 60 * 60), "/", "", false, true);

                $redirect = '';
                if ($row['Tipo'] === 'Aluno') {
                    $sqlAluno = "SELECT * FROM Aluno WHERE email = ?";
                    $stmtAluno = $conn->prepare($sqlAluno);
                    $stmtAluno->bind_param("s", $email);
                    $stmtAluno->execute();
                    $resultAluno = $stmtAluno->get_result();
                    if ($resultAluno->num_rows > 0) {
                        $rowAluno = $resultAluno->fetch_assoc();
                        $_SESSION['AlunoID'] = $rowAluno['AlunoID'];
                    }
                    $redirect = '../View/Aluno/Home.php';
                } elseif ($row['Tipo'] === 'Formador') {
                    $redirect = '../View/Formador/Home.php';
                } elseif ($row['Tipo'] === 'Admin') {
                    $redirect = '../View/Admin/Home.php';
                }
                return ['sucesso' => true, 'redirect' => $redirect];
            } else {
                return ['sucesso' => false, 'mensagem' => 'Senha incorreta.'];
            }
        } else {
            return ['sucesso' => false, 'mensagem' => 'Email não encontrado.'];
        }
    }
}

// Resposta AJAX
$login = new Login();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    $resposta = $login->verificar();
    echo json_encode($resposta);
    exit();
}
