<?php
session_start();
require('conexao.php');
if (isset($_SESSION['id'])) {
    $idConsumidor = $_SESSION['id'];
    // verifica se carrinho esta vazio
    $sql = "SELECT pc.fk_Carrinho_ID, pc.fk_Produto_ID, pc.quantidade, c.fk_Consumidor_ID FROM produto_carrinho as pc INNER JOIN carrinho as c WHERE c.fk_Consumidor_ID = $idConsumidor"; 
    $result = $conn->query($sql);
    $rows = mysqli_num_rows($result);
    $produtos_carrinho= mysqli_fetch_assoc($result); // cada tupla equivale a um produto diferente que foi adicionado
    if ($rows > 0) {
        $fk_Carrinho_ID = $produtos_carrinho['fk_Carrinho_ID'];
        // Query para pegar informacoes de todos os produtos que estao no carrinho do usuario que esta acessando
        $sql2 = "SELECT p.Nome, p.idProduto, p.Preco, p.Quantidade as Estoque, p.imagem, c.ID, c.Nome  as Categoria, pc.quantidade FROM produto as p, Categoria_Produto as c, carrinho as cr INNER JOIN produto_carrinho as pc 
            WHERE cr.ID =  $fk_Carrinho_ID  and p.idProduto = pc.fk_Produto_ID  and c.ID = p.fk_Categoria_Produto_ID";
        $result2 = $conn->query($sql2);

        //Consulta para pegar o valor total dos produtos do carrinho
        $queryValorTotal = "select sum(round((produto_carrinho.quantidade * produto.Preco), 2)) as ValorTotal
                            from produto_carrinho
                            inner join produto on produto.idProduto = produto_carrinho.fk_Produto_ID
                            where produto_carrinho.fk_Carrinho_ID = $fk_Carrinho_ID";

        $valorTotal = mysqli_fetch_assoc($conn->query($queryValorTotal));
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
                <div>
                    <?php include('mensagemSessao.php')?>
                </div>
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
                                                <div class="product-info" data-product-id=<?php echo $produto['idProduto'] ?>>
                                                    <div class="info-title"><?php echo $produto['Nome'] ?></div>
                                                    <div class="info-category"><?php echo $produto['Categoria'] ?></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>R$<?php echo $produto['Preco'] ?></td>
                                        <td>
                                            <div class="qty">
                                                <button type="button" class="btn btn-outline-primary btn-sm" onclick="alterarQtdeProdutoCarrinho(2,<?php echo $produto['idProduto'] ?>, <?php echo $fk_Carrinho_ID ?>)"><i class="fa-solid fa-minus"></i></button>
                                                <span class="p-2" data-product-quantidade=<?php echo $produto['idProduto'] ?>><?php echo $produto['quantidade'] ?></span>
                                                <button type="button" class="btn btn-outline-primary btn-sm" onclick="alterarQtdeProdutoCarrinho(1,<?php echo $produto['idProduto'] ?>, <?php echo $fk_Carrinho_ID ?>)"><i class="fa-solid fa-plus"></i></button>
                                            </div>
                                        </td>
                                        <td>R$ <span data-product-totalItemProduto=<?php echo $produto['idProduto'] ?>><?php echo $produto['quantidade'] * $produto['Preco'] ?></span></td>
                                        <td>
                                            <a href="excluirProdutoCarrinho.php?&idCarrinho=<?php echo $fk_Carrinho_ID ?>&idProduto=<?php echo $produto['idProduto'] ?>" class="btn btn-outline-danger btn-sm"><i class="fa-solid fa-x fa-sm"></i></a>
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
                                    R$ <span class="valorCarrinho"> <?php echo $valorTotal['ValorTotal']?></span>
                                </div>
                                <div>
                                    <span>Frete</span>
                                    <span>Gratuito</span>
                                </div>

                            </div>
                            <footer class="box-footer">
                                <span>Total</span>
                                R$ <span class="valorCarrinho"> <?php echo $valorTotal['ValorTotal']?> </span>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script type="text/javascript">
    
    function alterarQtdeProdutoCarrinho(typeChange, idProduto, idCarrinho) {

        const quantidadeProduto = $(".qty [data-product-quantidade="+idProduto+"]").text();
        
        //  Se o tipo é subtrair um produto e a quantidade já for 1 vamos chamar a rotina de excluir o produto do carrinho.
        if(typeChange == 2 && parseInt(quantidadeProduto) == 1) {
            console.log("excluindo produto do carrinho");
            window.location.href = "excluirProdutoCarrinho.php?&idCarrinho="+idCarrinho+"&idProduto="+idProduto;
            return;
        }

        $.ajax({
            type: "GET",
            dataType: "json",
            url: "alterarQtdeProdutoCarrinho.php",
            data: {
                idProduto: idProduto,
                idCarrinho: idCarrinho,
                typeChange: typeChange
            }
        }).done(function(data) {
            console.log(data);
            $(".qty [data-product-quantidade="+idProduto+"]").html(data.quantidadeProduto);
            $("td span[data-product-totalItemProduto="+idProduto+"]").html(data.TotalItemProduto);
            $(".valorCarrinho").html(data.ValorTotal);
        }).fail(function(request, status, error) {
            console.log(request);
            console.log(error);
        });
    }
</script>

</html>
