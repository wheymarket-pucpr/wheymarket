<?php 
session_start();
include_once('conexao.php');
if (!empty($_GET['idProduto']) && !empty($_GET['idCarrinho'])) {
    $idProduto = $_GET['idProduto'];
    $idCarrinho = $_GET['idCarrinho'];
    $sql = "DELETE FROM  produto_carrinho WHERE fk_Produto_ID = $idProduto and fk_Carrinho_ID = $idCarrinho"; 
    if ($result = $conn->query($sql)) {
        $_SESSION['mensagem'] = "Produto excluido com sucesso";
        header('location: carrinho.php');
        exit();
    } else {
        $_SESSION['mensagem'] = "Erro executando INSERT: " . $conn->error . " Tente esvaziar o carrinho novamente.";
        header('location: carrinho.php');
        exit();
    }
}
?>