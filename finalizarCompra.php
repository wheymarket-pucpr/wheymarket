<?php
session_start();
include_once('conexao.php');
$idConsumidor = $_SESSION['id'];

if (!empty($_GET['idCarrinho']) && !empty($_GET['valorTotal'])) {
    $idCarrinho = $_GET['idCarrinho'];
    $valorTotal  =$_GET['valorTotal'];
    $sqlSelect = "SELECT pc.fk_Produto_ID, pc.quantidade FROM produto_carrinho as pc WHERE fk_Carrinho_ID = $idCarrinho";
    $result = $conn->query($sqlSelect);
    var_dump($result);

    $dataPedido = date("Y-m-d H:i:s");
    $criarPedido = $conn->query("INSERT INTO pedido (fk_Consumidor_ID, data_pedido , Total) VALUES ('$idConsumidor','$dataPedido', '$valorTotal')");

    $queryIdPedido = "SELECT ID FROM pedido WHERE fk_Consumidor_ID = $idConsumidor ORDER BY ID";
    $resultIdPedido = $conn->query($queryIdPedido);
    $Pedido = mysqli_fetch_assoc($resultIdPedido);
    $idPedido = $Pedido['ID'];


    
    while($prod_carrinho = mysqli_fetch_assoc($result)) {
        $idProduto = $prod_carrinho['fk_Produto_ID'];
        $quantidadeProduto = $prod_carrinho['quantidade'];
        $insert = $conn->query("INSERT INTO produto_pedido (fk_Pedido_ID, fk_Produto_ID, quantidade) VALUES ('$idPedido', '$idProduto', '$quantidadeProduto')");
    }
    $queryResetCarrinho = "DELETE FROM produto_carrinho WHERE fk_Carrinho_ID = $idCarrinho";
    $resetCarrinho = $conn->query($queryResetCarrinho);

    $_SESSION['mensagem'] = "Pedido efetuado com sucesso!";
    header('Location: index.php');
} else {
    header('Location: produtos.php');
}
