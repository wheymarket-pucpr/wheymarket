<?php
session_start(); // informa ao PHP que iremos trabalhar com sessão
require 'conexao.php';

if (!empty($_POST) && isset($_POST['email']) && isset($_POST['senha']) && isset($_POST['CNPJ'])) {
    $nome = $conn->real_escape_string($_POST['Nome']);
    $email    = $conn->real_escape_string($_POST['email']);
    $cnpj   = $conn->real_escape_string($_POST['CNPJ']);
    $senha   = $conn->real_escape_string($_POST['senha']);

    $sql = "INSERT INTO lojista (CNPJ, email, Nome, senha, fk_Cadastro_Tipo_ID) VALUES ('$cnpj', '$email', '$nome', MD5('$senha'),'1')";

    if ($result = $conn->query($sql)) {
        $_SESSION['mensagem'] = "Cadastro de Lojista efetuado com sucesso. Você já pode vender em nosso site! Basta realizar o login.";
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
    <?php
    require('header.php');
    ?>
    <div class='.container-fluid'>
        <div class="row justify-content-center pt-5">
            <div class='col-3'>
                <div class="card">
                    <h5 class="card-header text-dark">Cadastre-se como Lojista</h5>
                    <div class="card-body">
                        <div class='col'>
                            <form action="" method="POST" class="needs-validation" novalidate>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" id="email" placeholder="example@example.com" maxlength="50" required />
                                    <div class="invalid-feedback">
                                        Informe um e-mail válido.
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="CNPJ" class="form-label">CNPJ</label>
                                    <input type="text" name="CNPJ" class="form-control cnpj" id="CNPJ" maxlength="" pattern="\d{2}\.?\d{3}\.?\d{3}\/?\d{4}\-?\d{2}" required />
                                    <div class="invalid-feedback">
                                        Informe um CNPJ válido.
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="Nome" class="form-label">Nome</label>
                                    <input type="text" name="Nome" class="form-control" id="Nome" placeholder="Nome da loja" maxlength="100" required />
                                    <div class="invalid-feedback">
                                        Informe um nome válido.
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="senha" class="form-label">Senha</label>
                                    <input type="password" name="senha" class="form-control" id="senha" placeholder='********' pattern="^\d{2}\.?\d{3}\.?\d{3}\/?\d{4}\-?\d{2}"
                                    minlength="8" maxlength="20" onkeyup="confereSenha()" required>
                                    <div class="invalid-feedback">
                                        Informe uma senha válida.
                                    </div>
                                    <div id="MensagemPassword" class="form-text">
                                        Sua senha deve ter 8-20 caracteres, no mínimo uma letra maiscula, no mínimo um número, e não deve conter espaços.
                                    </div>
                                </div>
                                <div class="mb-3 position-relative">
                                    <label for="senha" class="form-label">Confirmar Senha</label>
                                    <input type="password" name="confirma" class="form-control" id="confimar-senha" placeholder='********' pattern="^(?=.*[A-Z])(?=.*[0-9])(?=\S{8,20}$).*"
                                    minlength="8" maxlength="20" onkeyup="confereSenha()" required>
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
<script type="text/javascript">
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
  const forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }

      form.classList.add('was-validated')
    }, false)
  });

  function confereSenha() {
    console.log("chamou a função confereSenha");
    const senha = document.getElementById('senha');
    const confirma = document.getElementById('confimar-senha');
    const divPasswordMessage = document.getElementById('passwordHelpBlock');

    var classValidSenha = senha.value == confirma.value;

    if(!classValidSenha) {
        confirma.classList.add("is-invalid");
        confirma.classList.remove("is-valid");
        //A linha abaixo só serve para que o campo seja consederado sem erro no core do input HTML refletindo na cor do campo em verde pelo bootstrap.
        confirma.setCustomValidity("Erro!");
        divPasswordMessage.classList.remove("d-none");
    } else {
        confirma.classList.remove("is-invalid");
        confirma.classList.add("is-valid");
        //A linha abaixo só serve para que o campo seja consederado com erro no core do input HTML refletindo na cor do campo em vermelho pelo bootstrap.
        confirma.setCustomValidity("");
        divPasswordMessage.classList.add("d-none");
    }
}

</script>
</html>