<!DOCTYPE html>
<html lang="pt-br">

<?php include('htmlhead.php'); ?>

<body>
    <header>
        <?php require 'header.php'; ?>
    </header>

    <main class="container">
        <?php if (isset($_SESSION['tipoLogin']) && $_SESSION['tipoLogin'] == 2) : ?>
            <?php if ($rows > 0) : ?>
                <div>
                    <?php include('mensagemSessao.php') ?>
                </div>
                <h1 class="text-center mt-4">Meu Carrinho</h1>

                <div class="row">
                    <div class="col-lg-8">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Produto</th>
                                    <th scope="col">Preço</th>
                                    <th scope="col">Quantidade</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Remover</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($produto = mysqli_fetch_assoc($result2)) : ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex">
                                                <img width="75px" height="100px" src="data:image/jpeg;image/png;base64,<?php echo base64_encode($produto['imagem']) ?>" class="mr-3">
                                                <div>
                                                    <div><?php echo $produto['Nome'] ?></div>
                                                    <div><?php echo $produto['Categoria'] ?></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>R$<?php echo $produto['Preco'] ?></td>
                                        <td>
                                            <div class="input-group">
                                                <button type="button" class="btn btn-outline-primary" onclick="alterarQtdeProdutoCarrinho(2,<?php echo $produto['idProduto'] ?>, <?php echo $fk_Carrinho_ID ?>)"><i class="fa-solid fa-minus"></i></button>
                                                <input type="text" class="form-control text-center" value="<?php echo $produto['quantidade'] ?>" readonly>
                                                <button type="button" class="btn btn-outline-primary" onclick="alterarQtdeProdutoCarrinho(1,<?php echo $produto['idProduto'] ?>, <?php echo $fk_Carrinho_ID ?>)"><i class="fa-solid fa-plus"></i></button>
                                            </div>
                                        </td>
                                        <td>R$ <span data-product-totalItemProduto="<?php echo $produto['idProduto'] ?>"><?php echo $produto['quantidade'] * $produto['Preco'] ?></span></td>
                                        <td>
                                            <a href="excluirProdutoCarrinho.php?&idCarrinho=<?php echo $fk_Carrinho_ID ?>&idProduto=<?php echo $produto['idProduto'] ?>" class="btn btn-outline-danger"><i class="fa-solid fa-x fa-sm"></i></a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">Resumo da compra</div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Sub-total</span>
                                    <span>R$ <span class="valorCarrinho"><?php echo $valorTotal['ValorTotal'] ?></span></span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>Frete</span>
                                    <span>Gratuito</span>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="d-flex justify-content-between">
                                    <span>Total</span>
                                    <span>R$ <span class="valorCarrinho"><?php echo $valorTotal['ValorTotal'] ?></span></span>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-3">
                            <a href="#" class="btn btn-primary">Finalizar Compra</a>
                            <a href="esvaziarCarrinho.php?&id=<?php echo $fk_Carrinho_ID ?>" class="btn btn-danger">Esvaziar Carrinho</a>
                        </div>
                    </div>
                </div>
            <?php else : ?>
                <div class="text-center mt-4">
                    <h4>Você ainda não adicionou nenhum produto ao carrinho!</h4>
                    <a class="btn btn-primary" href="produtos.php">Ver Produtos</a>
                </div>
            <?php endif; ?>
        <?php else : ?>
            <div class="text-center mt-4">
                <h4>Você precisa estar logado para acessar ou inserir itens no carrinho!</h4>
                <a class="btn btn-dark" href="produtos.php">Voltar</a>
                <a class="btn btn-primary" href="consumidorLogin.php">Login</a>
            </div>
        <?php endif; ?>
    </main>
</body>

</html>
