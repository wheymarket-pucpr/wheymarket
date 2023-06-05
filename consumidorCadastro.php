<?php
session_start(); // informa ao PHP que iremos trabalhar com sessão
require 'conexao.php';

if (!empty($_POST) && isset($_POST['email']) && isset($_POST['senha']) && isset($_POST['CPF'])) {
    $nome = $conn->real_escape_string($_POST['Nome']);
    $email    = $conn->real_escape_string($_POST['email']);
    $cpf   = $conn->real_escape_string($_POST['CPF']);
    $senha   = $conn->real_escape_string($_POST['senha']);

   $sql = "INSERT INTO consumidor (Nome, CPF, senha, email, fk_Cadastro_Tipo_ID) VALUES ('$nome','$cpf',md5('$senha'),'$email', 2)";
   
 
    if ($result = $conn->query($sql)) {
        $_SESSION['mensagem'] = "Cadastro efetuado com sucesso. Você já pode comprar em nosso site! Basta realizar o login.";
        header('location: index.php');
        exit();
    } else {
        $_SESSION['mensagem'] = "Erro executando INSERT: " . $conn->error . " Tente novo cadastro.";
        header('location: index.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
    <title>Cadastro</title>
    <link rel="icon" href="https://cdn0.iconfinder.com/data/icons/fitness-filled/64/fitness-08-512.png" type="image/x-icon">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<?php require('navbar.php'); ?>
    <div class='.container-fluid'>
        <div class="row justify-content-center pt-5">
            <div class='col-3'>
                <div class="card">
                    <h5 class="card-header text-dark">Cadastre-se e aproveite o WheyMarket !</h5>
                    <div class="card-body">
                        <div class='col'>
                            <form action="" id="formConsumidor" method="POST" class="needs-validation" novalidate>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" id="email" placeholder="example@example.com" maxlength="50" required />
                                    <div class="invalid-feedback">
                                        Informe um e-mail válido.
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="CPF" class="form-label">CPF</label>
                                    <input type="text" name="CPF" class="form-control cpf" id="CPF" maxlength="11" required />
                                    <div class="invalid-feedback">
                                        Informe um CPF válido.
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="Nome" class="form-label">Nome</label>
                                    <input type="text" name="Nome" class="form-control" id="Nome" placeholder="Nome Sobrenome" maxlength="100" required />
                                    <div class="invalid-feedback">
                                        Informe um nome válido.
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="senha" class="form-label">Senha</label>
                                    <input type="password" name="senha" class="form-control" id="senha" placeholder='********' pattern="^(?=.*[A-Z])(?=.*[0-9])(?=\S{8,20}$).*" minlength="8" maxlength="20" onkeyup="confereSenha()" required>
                                    <div class="invalid-feedback">
                                        Informe uma senha válida.
                                    </div>
                                    <div id="MensagemPassword" class="form-text">
                                        Sua senha deve ter 8-20 caracteres, no mínimo uma letra maiscula, no mínimo um número, e não deve conter espaços.
                                    </div>
                                </div>
                                <div class="mb-3 position-relative">
                                    <label for="senha" class="form-label">Confirmar Senha</label>
                                    <input type="password" name="confirma" class="form-control" id="confimar-senha" placeholder='********' pattern="^(?=.*[A-Z])(?=.*[0-9])(?=\S{8,20}$).*" minlength="8" maxlength="20" onkeyup="confereSenha()" required>
                                    <div class="invalid-tooltip">
                                        Senhas não conferem. Sua senha deve ser identica a informada acima.
                                    </div>
                                </div>
                                <div class="d-grid gap-2 mb-3 mt-3">
                                    <button class="btn btn-primary" type="submit">Enviar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="js/jquery.mask.min.js"></script>
<script type="text/javascript">
    // Buscando form do Consumidor
    const form = document.getElementById('formConsumidor');

    // Proibindo do form fazer submit caso tenha inputs do form com valores inválidos.
    form.addEventListener('submit', event => {
        if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
        }

        form.classList.add('was-validated')
    }, false);

    /**
     * #################################################################
     * VALIDAÇÃO DA SENHA E CONFIRMAÇÃO DE SENHA
     * #################################################################
     */

    function confereSenha() {
        const senha = document.getElementById('senha');
        const confirma = document.getElementById('confimar-senha');
        const divPasswordMessage = document.getElementById('MensagemPassword');

        var isSenhaValida = senha.value == confirma.value;

        //A linha abaixo só serve para que o campo seja consederado com erro no core do input HTML refletindo na cor do campo em vermelho pelo bootstrap.
        isSenhaValida ? confirma.setCustomValidity("") : confirma.setCustomValidity("Erro!");

        if (form.classList.contains('was-validated')) {
            if (!isSenhaValida) {
                confirma.classList.add("is-invalid");
                confirma.classList.remove("is-valid");
                //A linha abaixo só serve para que o campo seja consederado sem erro no core do input HTML refletindo na cor do campo em verde pelo bootstrap.
                divPasswordMessage.classList.remove("d-none");
            } else {
                confirma.classList.remove("is-invalid");
                confirma.classList.add("is-valid");
                divPasswordMessage.classList.add("d-none");
            }
        }
    }

    /**
     * #################################################################
     * INICIO VALIDAÇÃO CPF
     * #################################################################
     */

    var options = {
        onComplete: function(cpf) {
            tratarHtmlCPF(validarCPF(cpf));
        }
    };

    $(document).ready(function() {
        $('.cpf').mask('000.000.000-00', options, {
            placeholder: "_._._-__"
        });
    });

    function tratarHtmlCPF(isCpfValido) {
        const cpfInput = document.getElementById('CPF');
        isCpfValido ? cpfInput.setCustomValidity("") : cpfInput.setCustomValidity("Erro!");

        if (form.classList.contains('was-validated')) {
            if (isCpfValido) {
                cpfInput.classList.add("is-valid");
                cpfInput.classList.remove("is-invalid");
            } else {
                cpfInput.classList.add("is-invalid");
                cpfInput.classList.remove("is-valid");
            }
        }
    }

    function validarCPF(cpf) {
        cpf = cpf.replace(/[^\d]+/g, ''); // Remove caracteres não numéricos

        if (cpf.length !== 11 || /^(\d)\1+$/.test(cpf)) {
            return false;
        }

        var soma = 0;
        var resto;

        for (var i = 1; i <= 9; i++) {
            soma += parseInt(cpf.substring(i - 1, i)) * (11 - i);
        }

        resto = (soma * 10) % 11;

        if (resto === 10 || resto === 11) {
            resto = 0;
        }

        if (resto !== parseInt(cpf.substring(9, 10))) {
            return false;
        }

        soma = 0;

        for (var i = 1; i <= 10; i++) {
            soma += parseInt(cpf.substring(i - 1, i)) * (12 - i);
        }

        resto = (soma * 10) % 11;

        if (resto === 10 || resto === 11) {
            resto = 0;
        }

        if (resto !== parseInt(cpf.substring(10, 11))) {
            return false;
        }

        return true;
    }
</script>

</html>