<?php
    session_start(); // informa ao PHP que iremos trabalhar com sessão
    require 'conexao.php';

    // Cria conexão
    $conn = new mysqli($servername, $username, $password, $database);

    // Verifica conexão
    if ($conn->connect_error) {
        die("<strong> Falha de conexão: </strong>" . $conn->connect_error);
    }

    if(isset($_POST['email']) || isset($_POST['senha'])) {

    $email = $conn->real_escape_string($_POST['email']); // prepara a string recebida para ser utilizada em comando SQL
    $senha   = $conn->real_escape_string($_POST['senha']); // prepara a string recebida para ser utilizada em comando SQL

    // Faz Select na Base de Dados
    $sql = "SELECT id, email FROM login WHERE email = '$email' AND senha = md5('$senha')";
    if ($result = $conn->query($sql)) {
        if ($result->num_rows == 1) {         // Deu match: login e senha combinaram
            $row = $result->fetch_assoc();
            $_SESSION ['login']       = $row['email'];           // Ativa as variáveis de sessão
            $_SESSION ['id']  = $row['id'];
            $_SESSION ['logado'] = true;
            unset($_SESSION ['nao_autenticado']);
            unset($_SESSION ['mensagem_header'] ); 
            unset($_SESSION ['mensagem'] ); 
            header('location: index.php'); // Redireciona para a página de funcionalidades.
            exit();

        }else{
            $_SESSION ['logado'] = false;
            $_SESSION ['nao_autenticado'] = true;         // Ativa ERRO nas variáveis de sessão
            $_SESSION ['mensagem_header'] = "Login";
            $_SESSION ['mensagem']        = "ERRO: Login ou Senha inválidos.";
            //header('location: login.php'); // Redireciona para página inicial
            exit();
        }
    }
    else {
        echo "Erro ao acessar o BD: " . $conn ->error;
    }
    $conn->close();  //Encerra conexao com o BD
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="https://cdn0.iconfinder.com/data/icons/fitness-filled/64/fitness-08-512.png"type="image/x-icon">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="/css/cadastro.css">
</head>
<body>
    <h1>Acesse sua conta</h1>
    <form action="" method="POST">
        <p>
            <label for="">Email</label>
            <input type="text" name="email">
        </p>
        <p>
            <label for="">Senha</label>
            <input type="password" name="senha">
        </p>
        <p>
            <button type="submit">Entrar</button>
        </p>
    </form>
</body>
</html>