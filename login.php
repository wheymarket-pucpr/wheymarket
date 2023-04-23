<?php
session_start(); // informa ao PHP que iremos trabalhar com sessão
require 'bd/conectaBD.php'; 

    // Cria conexão
$conn = new mysqli($servername, $username, $password, $database);

    // Verifica conexão 
if ($conn->connect_error) {
    die("<strong> Falha de conexão: </strong>" . $conn->connect_error);
}

$usuario = $conn->real_escape_string($_POST['Login']); // prepara a string recebida para ser utilizada em comando SQL
$senha   = $conn->real_escape_string($_POST['Senha']); // prepara a string recebida para ser utilizada em comando SQL
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
    <form action="" method="post"></form>
        <p>
            <label for="">Email</label>
            <input type="text" name="email">
        </p>
        <p>
            <label for="">Senha</label>
            <input type="password" name="email">
        </p>
        <p>
            <button type="submit">Entrar</button>
        </p>
</body>
</html>