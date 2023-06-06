<?php
session_start();
if (isset($_SESSION['tipoLogin']) && $_SESSION['tipoLogin'] == 1) {
    header('Location: lojistaPage.php');
}
require('conexao.php');
$sql = "SELECT produto.* , lojista.Nome as Lojista FROM produto INNER JOIN lojista WHERE produto.fk_Lojista_ID = lojista.ID and Anuncio = 1";

if (!empty($_POST) && isset($_POST['busca']) && $_POST['busca'] != "") {
    $busca = $_POST['busca'];
    $sql .= " AND produto.nome LIKE '%$busca%'";
}

if (!empty($_GET['categorias'])) {
    $categorias = implode(',', $_GET['categorias']);
    $sql .= " AND fk_Categoria_Produto_ID in ($categorias)";
}

// Deve ser o ultimo filtro da query por ser um order by.
if (!empty($_GET['Ordem']) && $_GET['Ordem'] != "0") {
    $orderByType = $_GET['Ordem'];
    $sql .= " order by preco $orderByType";
}

$result = $conn->query($sql);
$rows = mysqli_num_rows($result);

?>

<!DOCTYPE html>
<html lang="Pt-br">

<?php include('htmlhead.php'); ?>

<body>
<?php require('navbar.php'); ?>
    <!-- Se nao tiver nada digitado na barra ou pesquisa vazia -->
    <!-- slider -->
    <?php if (!isset($_POST['busca']) || (isset($_POST['busca']) && $_POST['busca'] === "")) : ?>
        <div style="justify-content: center;padding: 25px 25px 25px">
            <div id="carouselExampleIndicators" class="carousel slide">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="src/img/slider1.jpg" height="550px" class="d-block w-100" style="object-fit: cover;" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="src/img/slider2.jpg" height="550px" class="d-block w-100" style="object-fit: cover;" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="src/img/slider3.jpg" height="550px" class="d-block w-100" style="object-fit: cover;" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Anterior</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Proxima</span>
                </button>
            </div>
        </div>


        <!-- /FILTROS -->
        <!-- Se a pesquisa estiver com algo -->
    <?php elseif (isset($_POST['busca']) && $_POST['busca'] != "") : ?>
        <div style="padding: 20px;">
            <h4>Resultados da busca:</h4>
        </div>
    <?php
    endif;
    ?>


    <div class="container" id="produtosContainer">
        <div class="row pb-3">
            <form action="#produtosContainer" method="GET" id="formFiltrosProduto">
                <div class="row justify-content-between">
                    <div class="col">
                        <input type="checkbox" class="btn-check" name="categorias[]" value="1" id="option1" autocomplete="off" <?php echo (!empty($_GET['categorias']) && isset($_GET['categorias']) && in_array('1', $_GET['categorias'])) ? "checked" : "" ?>>
                        <label class="btn btn-outline-dark" for="option1">Termogenicos</label>

                        <input type="checkbox" class="btn-check" name="categorias[]" value="2" id="option2" autocomplete="off" <?php echo (!empty($_GET['categorias']) && isset($_GET['categorias']) && in_array('2', $_GET['categorias'])) ? "checked" : "" ?>>
                        <label class="btn btn-outline-dark" for="option2">Aminoacidos</label>

                        <input type="checkbox" class="btn-check" name="categorias[]" value="3" id="option3" autocomplete="off" <?php echo (!empty($_GET['categorias']) && isset($_GET['categorias']) && in_array('3', $_GET['categorias'])) ? "checked" : "" ?>>
                        <label class="btn btn-outline-dark" for="option3">Acessórios</label>

                        <input type="checkbox" class="btn-check" name="categorias[]" value="4" id="option4" autocomplete="off" <?php echo (!empty($_GET['categorias']) && isset($_GET['categorias']) && in_array('4', $_GET['categorias'])) ? "checked" : "" ?>>
                        <label class="btn btn-outline-dark" for="option4">Whey</label>
                    </div>
                    <div class="col">
                        <select name="Ordem" class="form-select form-select-sm" aria-label=".form-select-sm example">
                            <option value="0">Ordenar por...</option>
                            <option value="DESC" <?php echo (!empty($_GET['Ordem']) && isset($_GET['Ordem']) && $_GET['Ordem'] == 'DESC') ? "selected" : "" ?>>Maior Preço</option>
                            <option value="ASC" <?php echo (!empty($_GET['Ordem']) && isset($_GET['Ordem']) && $_GET['Ordem'] == 'ASC') ? "selected" : "" ?>>Menor Preço</option>
                        </select>
                    </div>
                </div>
            </form>
        </div>
        <div class="row">
            <?php
            if ($rows >= 1) :
                while ($produto = mysqli_fetch_assoc($result)) :
            ?>
                    <div class="col-3 pb-3">
                        <div class="card p-4 h-100">
                            <img width="10px" class="card-img-top" height="300px" style="object-fit: scale-down; " src="data:image/jpeg;image/png;base64,<?php echo base64_encode($produto['imagem']) ?>" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title" style='display: -webkit-box;height:2.5em;-webkit-line-clamp: 2;-webkit-box-orient: vertical;overflow: hidden;text-overflow: ellipsis;'><?php echo $produto['Nome'] ?></h5>
                                <h4 class="card-title">R$ <?php echo $produto['Preco'] ?></h4>
                                <div style="display:flex;flex-direction: column-reverse;flex-wrap: wrap;justify-content: center;gap:10px">
                                    <a href='adicionarProdutoCarrinho.php?&id=<?php echo $produto['idProduto'] ?>' name="idProduto" class="btn btn-outline-danger">Adicionar ao carrinho</a>

                                                            <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $produto['idProduto']?>">
                                    Visualizar
                                    </button>

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
                                                        <p><b>Vendido por: </b><?php echo $produto['Lojista'] ?></p>
                                                        <p><b>Descrição:</b></p>
                                                        <p><?php echo $produto['Descricao'] ?></p>
                                                        <p><b>Quantidade disponível:</b> <?php echo $produto['Quantidade'] ?></p>
                                                        <div style="display:flex;flex-direction: column-reverse;flex-wrap: wrap;justify-content: center;gap:10px">
                                                            <a href='adicionarProdutoCarrinho.php?&id=<?php echo $produto['idProduto'] ?>' name="idProduto" class="btn btn-outline-danger">Adicionar ao carrinho</a>
                                                            <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Voltar</button>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                <?php
                endwhile;
            else :
                ?>
                <div style="padding: 20px;">
                    <h4>Nenhum produto encontrado.</h4>
                    <a class="btn btn-primary" href="produtos.php">Voltar</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <!-- Se nao foi encontrado produto com o nome buscado -->
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<!-- funcao para rodar os slides do carrossel -->
<script>
    const myCarouselElement = document.querySelector('carouselExampleIndicators')

    /*const carousel = new bootstrap.Carousel(myCarouselElement, {
        interval: 1700,
        touch: false
    })*/

    $(document).ready(function() {
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $(".dropdown-menu li").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

        $('#formFiltrosProduto input').on("click", function() {
            $('#formFiltrosProduto').submit();
        });

        $('#formFiltrosProduto select').on("change", function() {
            $('#formFiltrosProduto').submit();
        });
    });
</script>

</html>