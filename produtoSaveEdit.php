<?php
    include('conexao.php');
    if(isset($_POST['update']))
    {
        $nome = $_POST['Nome'];
        $preco = $_POST['Preco'];
        $quantidade = $_POST['Quantidade'];
        $peso = $_POST['Peso'];
        $descricao = $_POST['Descricao'];
        $anuncio = $_POST['anunciar'];

        $sqlInsert = "UPDATE produto SET Nome='$nome',Preco='$preco',Quantidade='$quantidade',Peso='$peso',Descricao='$descricao',Anuncio ='$anuncio'
        WHERE idProduto=$_POST[idProduto]";
        $result = $conn->query($sqlInsert);
        print_r($result);
    }
    header('Location: produtosListar.php');

?>