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
            $_SESSION['tipoLogin'] = "2";
            unset($_SESSION['nao_autenticado']);
            unset($_SESSION['mensagem_header']);
            header('location: index.php');
                    
        } else {
            $_SESSION['nao_autenticado'] = true;
            $_SESSION['mensagem_header'] = "Login";
            $_SESSION['mensagem']        = "ERRO: Login ou Senha inválidos.";
            header('location: consumidorLogin.php');
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

<?php include('htmlhead.php'); ?>

<body>
<?php require('navbar.php'); 
    include("mensagemSessao.php");
?>


    <div class='.container-fluid'>
        <div class="row justify-content-center pt-5">
            <div class='col-3'>
                <div class="card">
                    <h5 class="card-header text-dark">Acesse sua conta de consumidor</h5>
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
                                    <button class="btn btn-outline-primary" type="submit">Entrar</button>
                                </div>
                                <div class="row">
                                    <div class="text-center">
                                        <a href="consumidorCadastro.php" class="link-primary">Nao sou cadastrado</a>
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