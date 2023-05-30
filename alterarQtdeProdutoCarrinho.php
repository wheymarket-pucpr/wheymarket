<?php
require('conexao.php');
const SOMAR = "1";
const SUBTRAIR = "2";

$typeChange = $_GET['typeChange'];
$idProduto = $_GET['idProduto'];
$idCarrinho = $_GET['idCarrinho'];
$carrinho = new stdClass();

if($typeChange == SOMAR){
    $atualizaQuantidade = "UPDATE produto_carrinho SET quantidade = (quantidade + 1) 
                            WHERE fk_Produto_ID = $idProduto and fk_Carrinho_ID = $idCarrinho;"; 
} else {
    $atualizaQuantidade = "UPDATE produto_carrinho SET quantidade = (quantidade - 1) 
                            WHERE fk_Produto_ID = $idProduto and fk_Carrinho_ID = $idCarrinho;"; 
}


if(!$conn->query($atualizaQuantidade)){
    
    $carrinho->status = 0;
    $carrinho->mensagemErro = "Erro ao atualizar produto.";
}

$queryProdutoCarrinho = "select produto.Nome,
                                produto_carrinho.fk_Produto_ID as produtoID,
                                produto_carrinho.quantidade,
                                round((produto_carrinho.quantidade * produto.Preco), 2) as TotalItemProduto,
                                sum(round((produto_carrinho.quantidade * produto.Preco), 2)) as ValorTotal
                        from produto_carrinho
                        inner join produto on produto.idProduto = produto_carrinho.fk_Produto_ID
                        where produto.idProduto = $idProduto";

$queryValorTotal = "select sum(round((produto_carrinho.quantidade * produto.Preco), 2)) as ValorTotal
                    from produto_carrinho
                    inner join produto on produto.idProduto = produto_carrinho.fk_Produto_ID
                    where produto_carrinho.fk_Carrinho_ID = $idCarrinho";


if($resultProdutoCarrinho = $conn->query($queryProdutoCarrinho)) {
    $produtoCarrinho = mysqli_fetch_assoc($resultProdutoCarrinho);
    $valorTotal = mysqli_fetch_assoc($conn->query($queryValorTotal));
    $carrinho->status = 1;
    $carrinho->produtoID = $produtoCarrinho['produtoID'];
    $carrinho->nomeProduto = $produtoCarrinho['Nome'];
    $carrinho->quantidadeProduto = $produtoCarrinho['quantidade'];
    $carrinho->TotalItemProduto = $produtoCarrinho['TotalItemProduto'];
    $carrinho->ValorTotal = $valorTotal['ValorTotal'];
} else {
    $carrinho->status = 0;
    $carrinho->mensagemErro = "Erro ao consultar carrinho.";
}

$myJSON = json_encode($carrinho);

echo $myJSON;