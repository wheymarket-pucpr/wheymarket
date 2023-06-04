<?php
session_start();
include_once('conexao.php');

if (!empty($_SESSION['id'])) {
    $idConsumidor = $_SESSION['id'];
    $queryPedidos = $conn->query("SELECT * FROM pedido WHERE fk_Consumidor_ID = $idConsumidor");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('htmlhead.php'); ?>
</head>
<header>
    <?php require 'navbar.php'; ?>
</header>

<body>

    <?php if (mysqli_num_rows($queryPedidos) > 0) : ?>
        <figure class="text-center">
            <blockquote class="blockquote">
                <h2>Meus Pedidos</h2>
            </blockquote>
        </figure>
        <div class="row row-cols-1 row-cols-md-1 g-4">
            <?php while ($pedido = mysqli_fetch_assoc($queryPedidos)) : ?>
                <?php
                $idPedido = $pedido['ID'];
                $queryProdutosPedido = $conn->query("SELECT pp.quantidade, prod.Nome, prod.Preco, prod.idProduto FROM produto_pedido as pp INNER JOIN produto as prod 
                    WHERE pp.fk_Pedido_ID = $idPedido and pp.fk_Produto_ID = prod.idProduto");
                ?>

                <div class="col d-flex justify-content-center">
                    <div class="card p-2 border-danger mb-3  h-100">
                        <div class="card-body">
                            <h5 class="card-title">Pedido #<?php echo $pedido['ID'] ?></h5>
                            <table class="table table-danger table-sm table-bordered border-danger caption-top">
                                <caption style="color: black;"><b>Produtos</b></caption>
                                <thead>
                                    <tr>
                                        <th scope="col" style= "width: 15rem;">Nome</th>
                                        <th scope="col" style= "width: 5rem;">Preco</th>
                                        <th scope="col">Quantidade</th>
                                        <th scope="col">Link</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($produto = mysqli_fetch_assoc($queryProdutosPedido)) :
                                    ?>
                                        <tr>
                                            <td scope="row" style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;"><?php echo $produto['Nome'] ?></td>
                                            <td scope="row"> R$ <?php echo $produto['Preco'] ?></td>
                                            <td scope="row"><?php echo $produto['quantidade'] ?></td>
                                            <td scope="row"><a class=" btn btn-sm btn-dark" href="produtoVisualizar.php?id=<?php echo $produto['idProduto'] ?>">Visualizar Produto</a></td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Data</th>
                                        <th scope="col">Valor Total</th>
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider">
                                    <tr>
                                        <th scope="row"><?php echo $pedido['data_pedido'] ?></th>
                                        <th scope="row">R$ <?php echo $pedido['Total'] ?></th>
                                    </tr>
                            </table>
                        </div>
                    </div>
                </div>


            <?php endwhile; ?>
        </div>
    <?php endif; ?>
</body>

</html>