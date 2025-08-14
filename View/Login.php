<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../Style/login.css">
    <style>
        span {
            display: block;
            text-align: center;
            color: red;
            margin-top: 10px;
        }
        label.error {
            color: red;
            font-size: 0.9em;
            display: block;
            margin-top: 5px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>


</head>
<body>
    <div class="container">
        <h1>Sistema de Gestão de Notas</h1>
        <form id="formLogin" action="../Controller/BLogin.php" method="post">
            <p>
                <label>Email:</label>
                <input type="email" id="email" class="container-campo" name="email" placeholder="ex: silva@gmail.com">
            </p>
            <p>
                <label>Senha:</label>
                <input type="password" id="senha" class="container-campo" name="senha">
            </p>
            <button id="registrar" type="submit">Entrar</button>
            <span id="resposta"><?php echo $erros ?? ''; ?></span>
               <?php
               if (isset($_GET['erro'])) {
                   if ($_GET['erro'] === 'senha') {
                       echo '<span id="msg-erro">Senha incorreta.</span>';
                   } elseif ($_GET['erro'] === 'email') {
                       echo '<span id="msg-erro">Email não encontrado.</span>';
                   }
               }
               ?>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $("#formLogin").validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    senha: {
                        required: true,
                    }
                },
                messages: {
                    email: {
                        required: "Por favor, informe o email",
                        email: "Por favor, informe um email válido"
                    },
                    senha: {
                        required: "Por favor, informe a senha",
                    }
                },
                errorPlacement: function(error, element) {
                    error.insertAfter(element); // mostra o erro abaixo do input
                },
                submitHandler: function(form) {
                    form.submit(); // envia o formulário se estiver válido
                }
            });
        });
    </script>
</body>
</html>
