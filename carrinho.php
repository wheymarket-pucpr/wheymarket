<?php
session_start();
require('conexao.php');
if (isset($_SESSION['id'])) {
    $idConsumidor = $_SESSION['id'];
    $sql = "SELECT pc.fk_Carrinho_ID, pc.fk_Produto_ID, pc.quantidade, c.fk_Consumidor_ID FROM produto_carrinho as pc INNER JOIN carrinho as c WHERE c.fk_Consumidor_ID = $idConsumidor";
    $result = $conn->query($sql);
    $rows = mysqli_num_rows($result);
    $produto_carrinho = mysqli_fetch_assoc($result);
    if ($rows > 0) {
        $fk_Carrinho_ID = $produto_carrinho['fk_Carrinho_ID'];
        $sql2 = "SELECT p.Nome, p.idProduto, p.Preco, p.Quantidade as Estoque, p.imagem, c.ID, c.Nome  as Categoria FROM produto as p, Categoria_Produto as c, carrinho as cr INNER JOIN produto_carrinho as pc 
            WHERE cr.ID =  $fk_Carrinho_ID  and p.idProduto = pc.fk_Produto_ID  and c.ID = p.fk_Categoria_Produto_ID";
        $result2 = $conn->query($sql2);
    }
}
?>

<!DOCTYPE html>
<html lang="Pt-br">

<?php include('htmlhead.php'); ?>
<link rel="stylesheet" href="css/carrinho.css">
<header>
</header>

<body>
    <section>
        <?php
        require 'header.php';
        ?>
        <?php
        if (isset($_SESSION['tipoLogin']) && $_SESSION['tipoLogin'] == 2) : // Verifica se o usuário está logado e se é um consumidor
        ?>
            <?php
            if ($rows > 0) : // Verifica se o usuario ja adicionou algum produto ao carrinho
            ?>
                <div class="page-title">
                    Meu Carrinho
                </div>

                <div class="content">
                    <section>
                        <table>
                            <thead>
                                <tr>
                                    <th>
                                        Produto
                                    </th>
                                    <th>
                                        Preço
                                    </th>
                                    <th>
                                        Quantidade
                                    </th>
                                    <th>
                                        Total
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($produto = mysqli_fetch_assoc($result2)) :
                                ?>
                                    <tr>
                                        <td>
                                            <div class="product">
                                                <img width="75px" height="100px" src="data:image/jpeg;image/png;base64,<?php echo base64_encode($produto['imagem']) ?>">
                                                <div class="product-info">
                                                    <div class="info-title"><?php echo $produto['Nome'] ?></div>
                                                    <div class="info-category"><?php echo $produto['Categoria'] ?></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>R$<?php echo $produto['Preco'] ?></td>
                                        <td>
                                            <div class="qty">
                                                <button type="button" class="btn btn-outline-primary btn-sm">-</button>
                                                <span><?php echo $produto_carrinho['quantidade'] ?></span>
                                                <button type="button" class="btn btn-outline-primary btn-sm">+</button>
                                            </div>
                                        </td>
                                        <td>R$<?php echo $produto_carrinho['quantidade'] * $produto['Preco'] ?></td>
                                        <td>
                                            <a href="excluirProdutoCarrinho.php?&idCarrinho=<?php echo $fk_Carrinho_ID?>&idProduto=<?php echo $produto['idProduto']?>" class="btn btn-outline-danger btn-sm">x</a>
                                        </td>
                                    </tr>
                                    <tr>
                                    <?php
                                endwhile;
                                    ?>
                            </tbody>
                        </table>
                    </section>
                    <aside>
                        <div class="box" ;>
                            <header class="box-header">Resumo da compra</header>
                            <div class="box-info">
                                <div>
                                    <span>Sub-total</span>
                                    <span>R$ 418,00</span>
                                </div>
                                <div>
                                    <span>Frete</span>
                                    <span>Gratuito</span>
                                </div>

                            </div>
                            <footer class="box-footer">
                                <span>Total</span>
                                <span>R$ 418,00 </span>
                            </footer>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="d-flex p-2">
                                <a class="btn btn-primary" href="#">Finalizar Compra</a>
                            </div>
                            <div class="d-flex p-2">
                                <a href="esvaziarCarrinho.php?&id=<?php echo $fk_Carrinho_ID ?>" class="btn btn-danger">Esvaziar Carrinho</a>
                            </div>
                        </div>
                    </aside>
                </div>
            <?php
            else :
            ?>
                <div style="padding: 20px;">
                    <h4>Você ainda não adicionou nenhum produto ao carrinho!</h4>
                    <a class="btn btn-primary" href="produtos.php">Ver Produtos</a>
                </div>
            <?php
            endif;
            ?>
        <?php
        else :
        ?>
            <div style="padding: 20px;">
                <h4>Você precisa estar logado para acessar ou inserir itens no carrinho!</h4>
                <a class="btn btn-dark" href="produtos.php">Voltar</a>
                <a class="btn btn-primary" href="consumidorLogin.php">Login</a>
            </div>
        <?php
        endif;
        ?>
    </section>
</body>

</html>