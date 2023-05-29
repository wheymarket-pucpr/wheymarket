<?php
session_start();
require('conexao.php');
$idConsumidor = $_SESSION['id'];
$sql = "SELECT pc.fk_Carrinho_ID, pc.fk_Produto_ID, pc.quantidade, c.fk_Consumidor_ID FROM produto_carrinho as pc INNER JOIN carrinho as c WHERE c.fk_Consumidor_ID = $idConsumidor";
$result = $conn->query($sql);
$rows = mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html lang="Pt-br">

<?php include('htmlhead.php'); ?>
<link rel="stylesheet" href="css/carrinho.css">
<header>
    <?php
    require 'header.php';
    ?>
</header>

<body>
    <main>
        <?php
        if (isset($_SESSION['tipoLogin']) && $_SESSION['tipoLogin'] == 2) : // Verifica se o usuário está logado e se é um consumidor
        ?>
            <div class="page-title">
                Meu Carrinho
            </div>
            <?php
            if ($rows > 0) : // Verifica se o usuario ja adicionou algum produto ao carrinho
            ?>
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
                                while ($produto_carrinho = mysqli_fetch_assoc($result)) :
                                    $fk_Carrinho_ID = $produto_carrinho['fk_Carrinho_ID'];
                                    $sql2 = "SELECT p.nome, p.Preco, p.Quantidade as Estoque, p.imagem,  c.Nome as Categoria FROM produto as p, produto_carrinho as pc, carrinho as cr INNER JOIN Categoria_Produto as c 
                                    WHERE p.fk_Categoria_Produto_ID = c.ID and $fk_Carrinho_ID = cr.ID;";
                                    $result2 = $conn->query($sql2);
                                    $produto = mysqli_fetch_assoc($result2);
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
                                        <td><?php echo $produto['Preco'] ?></td>
                                        <td>
                                            <div class="qty">
                                                <button type="button" class="btn btn-outline-primary btn-sm">-</button>
                                                <span><?php echo $produto_carrinho['quantidade'] ?></span>
                                                <button type="button" class="btn btn-outline-primary btn-sm">+</button>
                                            </div>
                                        </td>
                                        <td><?php echo $produto_carrinho['quantidade'] * $produto['Preco'] ?></td>
                                        <td>
                                            <button type="button" class="btn btn-outline-danger btn-sm">x</button>
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
                        <div class="botoes-carrinho">
                            <a class="btn btn-primary btn-lg" href="#">Finalizar Compra</a>
                        </div>
                        <div class="botoes-carrinho">
                            <a class="btn btn-danger btn-lg" href="#">Esvaziar Carrinho</a>
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
    </main>
</body>

</html>