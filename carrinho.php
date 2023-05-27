<?php
session_start();
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
    <div class="page-title">
        Seu Carrinho
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
                    <th>

                    </th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <div class="product">
                            <img class="product-image" src="./src/img/wheyn.webp">
                            <div class="product-info">
                                <div class="info-title">Nome do produto</div>
                                <div class="info-category">Categoria</div>
                            </div>
                        </div>
                    </td>
                    <td>R$ 120,00</td>
                    <td>
                        <div class="qty">
                            <button class="qty-sub-button">-</button>
                            <span>4</span>
                            <button class="qty-sum-button">+</button>
                        </div>
                    </td>
                    <td>R$ 240,00</td>
                    <td>
                        <button class="remove-button">
                            <i class='bx bx-x'></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="product">
                            <img class="product-image" src="./src/img/wheyn.webp">
                            <div class="product-info">
                                <div class="info-title">Nome do produto</div>
                                <div class="info-category">Categoria</div>
                            </div>
                        </div>
                    </td>
                    <td>R$ 120,00</td>
                    <td>
                        <div class="qty">
                            <button class="qty-sub-button">-</button>
                            <span>4</span>
                            <button class="qty-sum-button">+</button>
                        </div>
                    </td>
                    <td>R$ 240,00</td>
                    <td>
                        <button class="remove-button">
                            <i class='bx bx-x'></i>
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
        </section>

        <aside>
            <div class="box">
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
            <button class="box-button">Finalizar Compra</button>

        </aside>
    </div>
</main>
</body>
</html>

