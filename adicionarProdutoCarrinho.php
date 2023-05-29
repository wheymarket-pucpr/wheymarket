<?php 
session_start();
include_once('conexao.php');
$idConsumidor = $_SESSION['id'];

if (!empty($_GET['idProduto'])) {
    $idProduto = $_GET['idProduto'];
    $sql = "INSERT INTO produto_carrinho(fk_Carrinho_ID, fk_Produto_ID,quantidade) VALUES ('$idConsumidor','$idProduto', '1')  ";

    if ($result = $conn->query($sql)) {
        $_SESSION['mensagem'] = "Produto adicionado com sucesso. Você já pode acessar o seu carrinho! ";
        header('location: carrinho.php');
        exit();
    } else {
        $_SESSION['mensagem'] = "Erro executando INSERT: " . $conn->error . " Tente adicionar o produto novamente.";
        header('location: produtos.php');
        exit();
    }
}
?>