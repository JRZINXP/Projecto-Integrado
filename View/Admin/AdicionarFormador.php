<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Style/login.css">
    <link rel="stylesheet" href="../../Style/home.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>

    <title>Registrar formador</title>
</head>

<body>
    <div class="container">
        <?php if (isset($_GET['msg'])): ?>
        <div id="msg-sucesso" style="text-align:center;margin:18px 0;font-size:17px;font-weight:600;color:#27ae60;background:#eafaf1;padding:12px 0;border-radius:8px;">
            <?= htmlspecialchars($_GET['msg']) ?>
        </div>
        <script>
            setTimeout(function(){
                var msg = document.getElementById('msg-sucesso');
                if(msg) msg.style.display = 'none';
            }, 3000);
        </script>
    <?php endif; ?>
        <h1>Registrar novo formador</h1>
        <form action="../../Controller/Admin/RegistarFormador.php" id="meuForm" method="post">
            <p>
                <label for="">Nome: </label>
                <input type="text" name="nome" id="nome" class="container-campo">
            </p>

            <p>
                <label for="">Email: </label>
                <input type="email" name="email" id="email" class="container-campo">
            </p>

            <p>
                <label for="">Senha: </label>
                <input type="password" name="senha" id="senha" class="container-campo">
            </p>

            <button type="submit" id="registrar">Registrar</button>
            <button type="button" onclick="window.location.href='Home.php'">Voltar</button>

        </form>

        <script>
            $(document).ready(function() {
                $("#meuForm").validate({
                    rules: {
                        nome: {
                            required: true,
                            minlength: 3
                        },
                        email: {
                            required: true,
                            email: true
                        },
                        senha: {
                            required: true,
                            minlength: 8
                        }
                    },
                    messages: {
                        nome: {
                            required: "Por favor, insira seu nome",
                            minlength: "O nome deve ter pelo menos 3 caracteres"
                        },
                        email: {
                            required: "Informe seu email",
                            email: "Digite um email válido"
                        },
                        senha: {
                            required: "Crie uma senha",
                            minlength: "A senha deve ter no mínimo 8 caracteres"
                        }
                    },
                    submitHandler: function(form) {
                        alert("Formulário válido! Enviando...");
                        form.submit();
                    }
                });
            });
        </script>

    </div>
</body>

</html>