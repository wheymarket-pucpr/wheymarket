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
                        -
                    </th>
                </tr>
                </thead>
                <tbody>
                <td>
                    <img class="product-image" src="./src/img/wheyn.webp">
                </td>
                <td>R$ 120,00</td>
                <td>
                    <div class="qty">
                        <button>-</button>
                        <span></span>
                        <button>+</button>
                    </div>
                </td>
                <td>R$ 240,00</td>
                <td>
                    <button>
                        <i class='bx bx-x'></i>
                    </button>
                </td>
                </tbody>
            </table>
        </section>

        <aside>Resumo das compras</aside>
    </div>
</main>
</body>
</html>

