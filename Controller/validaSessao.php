<?php
include_once __DIR__ . '/../Conect/conector.php';


class Sessao
{
    public static function validar()
    {
        $token = $_COOKIE['session_token'] ?? '';

        if (empty($token)) {
            self::logout();
        }

        $conexao = new Conector();
        $conn = $conexao->getConexao();

        $sql = "SELECT s.UsuarioID, s.DataExpiracao, u.Nome, u.Tipo, u.Email 
                FROM Sessao s
                INNER JOIN Usuario u ON u.UsuarioID = s.UsuarioID
                WHERE s.Token = ? AND s.Ativo = 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $token);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            self::logout();
        }

        $sessao = $result->fetch_assoc();

        // Verifica se o token expirou
        if (strtotime($sessao['DataExpiracao']) < time()) {
            self::logout();
        }

        // Se passou em tudo, restaura sessão
        $_SESSION['id'] = $sessao['UsuarioID'];
        $_SESSION['nome'] = $sessao['Nome'];
        $_SESSION['tipo'] = $sessao['Tipo'];
        $_SESSION['email'] = $sessao['Email'];

        return true;
    }

    public static function logout()
    {
        // Apaga token e destrói sessão
        setcookie('session_token', '', time() - 3600, "/");
        session_destroy();
        header("Location: ../View/Login.php");
        exit();
    }
}

// Valida no início da página
Sessao::validar();
