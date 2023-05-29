<?php 
session_start();
include_once('conexao.php');
var_dump($_GET['id']);
if (!empty($_GET['id'])) {
    $idCarrinho = $_GET['id'];
    $sql = "DELETE FROM  produto_carrinho WHERE fk_Carrinho_ID = $idCarrinho"; 
    if ($result = $conn->query($sql)) {
        $_SESSION['mensagem'] = "Carrinho esvaziado com sucesso";
        header('location: carrinho.php');
        exit();
    } else {
        $_SESSION['mensagem'] = "Erro executando INSERT: " . $conn->error . " Tente esvaziar o carrinho novamente.";
        header('location: produtos.php');
        exit();
    }
}
?>