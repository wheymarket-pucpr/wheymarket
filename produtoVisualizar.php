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

<?php include('htmlhead.php');?>
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
                    <p><b>Quantidade disponível:</b> <?php echo $produto['Quantidade'] ?></p>
                    <div style="display:flex;flex-direction: column-reverse;flex-wrap: wrap;justify-content: center;gap:10px">
                    <a href='produtos.php' class="btn btn-danger">Voltar</a>
                        <a href="carrinho.php" class="btn btn-dark">Adicionar ao carrinho</a>

                       

                    </div>
                </div>

            </div>
        </div>
    </div>
</body>