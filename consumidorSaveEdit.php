<?php
    include('conexao.php');
    if(isset($_POST['update']))
    {
        $id = $_POST['ID'];
        $nome = $_POST['Nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];


        $sqlInsert = "UPDATE consumidor SET Nome='$nome',email='$email',senha=MD5('$senha')
        WHERE ID = $id";
        $result = $conn->query($sqlInsert);
    }
    session_start();
    $nomequery = "SELECT * from consumidor where id=$id";
    $result2 = $conn->query($nomequery);
    $novonome = mysqli_fetch_assoc($result2);
    $_SESSION['Nome'] = $novonome['Nome'];
    $_SESSION['mensagem'] = "Dados atualizados com sucesso!";
    header('Location: index.php');
  
 

?>