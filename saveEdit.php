<?php
    var_dump($_POST);
    include('conexao.php');
    if(isset($_POST['update']))
    {
        $nome = $_POST['Nome'];
        $preco = $_POST['Preco'];
        $quantidade = $_POST['Quantidade'];
        $peso = $_POST['Peso'];
        $descricao = $_POST['Descricao'];

        $sqlInsert = "UPDATE produto SET Nome='$nome',Preco='$preco',Quantidade='$quantidade',Peso='$peso',Descricao='$descricao'
        WHERE idProduto=$_POST[idProduto]";
        $result = $conn->query($sqlInsert);
        print_r($result);
    }
    header('Location: listarProdutos.php');

?>