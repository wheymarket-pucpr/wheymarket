<?php
session_start();
include_once('conexao.php');
$idConsumidor = $_SESSION['id'];

if (!empty($_GET['id'])) {
    $idProduto = $_GET['id'];
    $sqlCarrinho = "SELECT * FROM carrinho WHERE fk_Consumidor_ID = $idConsumidor";
    $resultCarrinho = $conn->query($sqlCarrinho);
    $carrinho = mysqli_fetch_assoc($resultCarrinho);
    $idCarrinho = $carrinho['ID'];
    $verificaProduto = "SELECT * FROM produto_carrinho WHERE fk_Produto_ID = $idProduto and fk_Carrinho_ID = $idCarrinho";
    $resultVerifica = $conn->query($verificaProduto);
    if (mysqli_num_rows($resultVerifica) == 0) {
        $sql = "INSERT INTO produto_carrinho(fk_Carrinho_ID, fk_Produto_ID,quantidade) VALUES ('$idCarrinho','$idProduto', 1)";
        if ($result = $conn->query($sql)) {
            $_SESSION['mensagem'] = "Produto adicionado com sucesso. Você já pode acessar o seu carrinho! ";
            header('location: carrinho.php');
            exit();
        } else {
            var_dump($result);
            $_SESSION['mensagem'] = "Erro executando INSERT: " . $conn->error . " Tente adicionar o produto novamente.";
            header('location: produtos.php');
            exit();
        }
    }
    else{
        // FAZER LOGICA PARA SOMAR UM NO ATRIBUTO QUANTIDADE DA TABELA PRODUTO_CARRINHO

        $atualizaQuantidade = "UPDATE produto_carrinho SET quantidade = (quantidade + 1) 
        WHERE fk_Produto_ID = $idProduto and fk_Carrinho_ID = $idCarrinho;"; 
        if ($resultAttQnt = $conn->query($atualizaQuantidade)) {
            $_SESSION['mensagem'] = "Produto adicionado com sucesso. Você já pode acessar o seu carrinho! ";
            header('location: carrinho.php');
            exit();
        } else {
            $_SESSION['mensagem'] = "Erro executando INSERT: " . $conn->error . " Tente adicionar o produto novamente.";
            header('location: produtos.php');
            exit();
        }
    }
}