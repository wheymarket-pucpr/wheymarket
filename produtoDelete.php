<?php

    if(!empty($_GET['id']))
    {
        include_once('conexao.php');

        $id = $_GET['id'];

        $sqlSelect = "SELECT *  FROM produto WHERE idProduto=$id";

        $result = $conn->query($sqlSelect);

        if($result->num_rows > 0)
        {
            $sqlDelete = "DELETE FROM produto WHERE idProduto=$id";
            $resultDelete = $conn->query($sqlDelete);
        }
    }
    header('Location: listarProdutos.php');
   
?>