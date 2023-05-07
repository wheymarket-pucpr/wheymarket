<?php
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
    <div>
        <div class="content-container">
            <div class="imagem">
                <img src="data:image/jpeg;image/png;base64,<?php echo base64_encode($produto['imagem']) ?>" class="imagem-img">
            </div>

            <div class="info">
                <!-- informacoes -->
                <div> <?php echo $produto['Nome'] ?></div>
                <div><b>Vendido por:</b> <?php echo $lojista['Nome'] ?></div>
            </div>

            <div>
                <?php echo $produto['Descricao'] ?>

            </div>

        </div>
    </div>
</body>