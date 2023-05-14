<?php
session_start();

require('conexao.php');
$busca = $_POST['busca'];
$sql = "SELECT * FROM produto WHERE nome LIKE '%$busca%'";
if ($result = $conn->query($sql)) {
} else {
}

$rows = mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html lang="Pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/style.css">
    <title>WheyMarket</title>
    <link rel="icon" href="https://cdn0.iconfinder.com/data/icons/fitness-filled/64/fitness-08-512.png" type="image/x-icon">
</head>

<body>
    <header>
        <?php
        require 'header.php';
        ?>
    </header>
<?php if ($rows >= 1): ?>
    <div class="container" style="padding:15px">
        <div class="row" style="display: grid; grid-template-columns: 1fr 1fr 1fr 1fr">
            <?php
            while ($produto = mysqli_fetch_assoc($result)) :
            ?>
                <div class="col">
                    <div class="card p-4" style="width: 17rem;">
                        <img width="10px" class="card-img-top" height="300px" style="object-fit: scale-down; " src="data:image/jpeg;image/png;base64,<?php echo base64_encode($produto['imagem']) ?>" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title" style='display: -webkit-box;height:2.5em;-webkit-line-clamp: 2;-webkit-box-orient: vertical;overflow: hidden;text-overflow: ellipsis;'><?php echo $produto['Nome'] ?></h5>
                            <h4 class="card-title">R$ <?php echo $produto['Preco'] ?></h4>
                            <div style="display:flex;flex-direction: column-reverse;flex-wrap: wrap;justify-content: center;gap:10px">
                                <a href="#" class="btn btn-primary">Comprar</a>

                                <a target="_blank" href='visualizaProduto.php?&id=<?php echo $produto['idProduto'] ?> 'name="idProduto" class="btn btn-primary">Visualizar</a>
                                
                            </div>
                        </div>

                    </div>
                </div>
            <?php
            endwhile;
            ?>
        </div>
    </div>
    <?php else: ?>
        <div style="padding: 20px;">
        <h4>Nenhum produto foi encontrado na busca.</h4>
        <a class="btn btn-primary" href="produtos.php">Voltar</a>
    </div>

    <?php endif; ?>
</body>



</html>