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
                <td></td>
                <td>R$ 120,00</td>
                <td></td>
                <td>R$ 240,00</td>
                <td></td>
                </tbody>
            </table>
        </section>

        <aside>Resumo das compras</aside>
    </div>
</main>
</body>
</html>

