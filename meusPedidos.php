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

<body>
    <?php require('navbar.php'); ?>
    <?php include('mensagemSessao.php') ?>
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
                            <h5 class="card-title">Pedido #<?php echo $idPedido ?> </h5>
                            <br>
                            Valor total: R$ <?php echo $pedido['Total'] ?>
                            <br>
                            Data/Hora do pedido: <?php echo $pedido['data_pedido'] ?>
                            <button class="btn btn-link" type="button" data-bs-toggle="collapse" data-bs-target="#datatoggle<?php echo $idPedido ?>" aria-expanded="false" aria-controls="datatoggle<?php echo $idPedido ?>">
                                Ver detalhes
                            </button>
                            <div class="collapse" id="datatoggle<?php echo $idPedido ?>">
                                <table class="table table-sm table-bordered border-danger caption-top">
                                    <caption style="color: black;"><b>Produtos</b></caption>
                                    <thead>
                                        <tr>
                                            <th scope="col" style="width: 15rem;">Nome</th>
                                            <th scope="col" style="width: 5rem;">Preço</th>
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
                                                <td scope="row"> <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $produto['idProduto'] ?>">
                                                        Visualizar
                                                    </button></td>
                                            </tr>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal<?php echo $produto['idProduto'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel<?php echo $produto['idProduto'] ?>"><?php echo $produto['Nome'] ?></h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="card-body">
                                                                <h5 class="card-title" style='display: -webkit-box;height:2.5em;-webkit-line-clamp: 2;-webkit-box-orient: vertical;overflow: hidden;text-overflow: ellipsis;'><?php echo $produto['Nome'] ?></h5>
                                                                <img width="10px" class="card-img-top" height="300px" style="object-fit: scale-down; " src="data:image/jpeg;image/png;base64,<?php echo base64_encode($produto['imagem']) ?>" alt="Card image cap">
                                                                <h4 class="card-title">R$ <?php echo $produto['Preco'] ?></h4>
                                                                <p><b>Vendido por: </b><?php echo $lojista['Nome'] ?></p>
                                                                <p><b>Descrição:</b></p>
                                                                <p><?php echo $produto['Descricao'] ?></p>
                                                                <p><b>Quantidade disponível:</b> <?php echo $produto['Quantidade'] ?></p>
                                                                <div style="display:flex;flex-direction: column-reverse;flex-wrap: wrap;justify-content: center;gap:10px">
                                                                    <a href="carrinho.php" class="btn btn-danger">Adicionar ao carrinho</a>
                                                                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Voltar</button>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
                </div>
            <?php endwhile; ?>
        </div>

    <?php else : ?>
        <div style="padding: 20px;">
            <h4>Você ainda não fez nenhum pedido!</h4>
            <a class="btn btn-outline-dark" href="produtos.php">Ver Produtos</a>
        </div>
    <?php endif; ?>




</body>


</html>