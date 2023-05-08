<?php
    var_dump($_POST);
    include('conexao.php');
    if(isset($_POST['update']))
    {
        $id = $_POST['ID'];
        $nome = $_POST['Nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];


        $sqlInsert = "UPDATE lojista SET Nome='$nome',email='$email',senha=MD5('$senha')
        WHERE ID = $id";
        $result = $conn->query($sqlInsert);
        print_r($result);
    }
    header('Location: lojistaPage.php');

?>