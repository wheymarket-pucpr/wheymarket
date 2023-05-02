<?php
session_start();
require 'conexao.php';

if (isset($_POST['email']) || isset($_POST['senha'])) {

    $email = $conn->real_escape_string($_POST['email']); // prepara a string recebida para ser utilizada em comando SQL
    $senha   = $conn->real_escape_string($_POST['senha']); // prepara a string recebida para ser utilizada em comando SQL

    // Faz Select na Base de Dados
    $sql = "SELECT id, email, Nome, fk_Cadastro_Tipo_ID from consumidor where email = '$email' AND senha = md5('$senha')";
    if ($result = $conn->query($sql)) {
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $_SESSION['Nome']  = $row['Nome'];
            $_SESSION['login']  = $row['email'];
            $_SESSION['id']  = $row['id'];
            $_SESSION['logado'] = true;
            $_SESSION['tipoLogin'] = $row['fk_Cadastro_Tipo_ID'];
            unset($_SESSION['nao_autenticado']);
            unset($_SESSION['mensagem_header']);
            header('location: index.php');
                    
        } else {
            $_SESSION['logado'] = false;
            $_SESSION['nao_autenticado'] = true;
            $_SESSION['mensagem_header'] = "Login";
            $_SESSION['mensagem']        = "ERRO: Login ou Senha inválidos.";
            header('location: index.php');
            exit();
        }
    } else {
        echo "Erro ao acessar o BD: " . $conn->error;
    }
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
    <title>Login</title>
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
                    <h5 class="card-header text-dark">Acesse sua conta</h5>
                    <div class="card-body">
                        <div class='col'>
                            <form action="" method="POST">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" name="email" class="form-control" id="email">
                                </div>
                                <div class="mb-3">
                                    <label for="senha" class="form-label">Senha</label>
                                    <input type="password" name="senha" class="form-control" id="senha">
                                </div>
                                <div class="d-grid gap-2 mb-3">
                                    <button class="btn btn-primary" type="submit">Entrar</button>
                                </div>
                                <div class="row">
                                    <div class="text-center">
                                        <a href="cadastroConsumidor.php" class="link-primary">Nao sou cadastrado</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>