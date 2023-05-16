<?php
session_start();
include_once('conexao.php');

if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $sqlSelect = "SELECT * FROM produto WHERE idProduto=$id";
    $result = $conn->query($sqlSelect);
    if ($result->num_rows > 0) {
        $produto = mysqli_fetch_assoc($result);
        $idlojista = $produto['fk_Lojista_ID'];
        $sql = "SELECT * FROM lojista WHERE ID=$idlojista";
        $result = $conn->query($sql);
        $lojista = mysqli_fetch_assoc($result);
    } else {
        header('Location: produtos.php');
    }
}


?>
<!DOCTYPE html>
<html lang="Pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/style.css">
    <title>WheyMarket</title>
    <link rel="icon" href="https://cdn0.iconfinder.com/data/icons/fitness-filled/64/fitness-08-512.png" type="image/x-icon">
</head>

<?php
require('header.php');
?>

<body>
    <div class="d-flex justify-content-center pt-5">
        <div class="col-3 pb-3">
            <div class="card p-4 h-100">
                <img width="10px" class="card-img-top" height="300px" style="object-fit: scale-down; " src="data:image/jpeg;image/png;base64,<?php echo base64_encode($produto['imagem']) ?>" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title" style='display: -webkit-box;height:2.5em;-webkit-line-clamp: 2;-webkit-box-orient: vertical;overflow: hidden;text-overflow: ellipsis;'><?php echo $produto['Nome'] ?></h5>
                    <h4 class="card-title">R$ <?php echo $produto['Preco'] ?></h4>
                    <p><b>Vendido por: </b><?php echo $lojista['Nome'] ?></p>
                    <p><b>Descrição:</b></p>
                    <p><?php echo $produto['Descricao'] ?></p>
                    <div style="display:flex;flex-direction: column-reverse;flex-wrap: wrap;justify-content: center;gap:10px">
                    <a href='produtos.php' class="btn btn-primary">Voltar</a>
                        <a href="#" class="btn btn-primary">Comprar</a>

                       

                    </div>
                </div>

            </div>
        </div>
    </div>
</body>