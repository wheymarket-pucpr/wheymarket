<?php
session_start()
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
    <link rel = "icon" href ="https://cdn0.iconfinder.com/data/icons/fitness-filled/64/fitness-08-512.png" type = "image/x-icon">
</head>

<?php
    include_once('conexao.php');

    if(!empty($_GET['id']))
    {
        $id = $_GET['id'];
        $sqlSelect = "SELECT * FROM produto WHERE idProduto=$id";
        $result = $conn->query($sqlSelect);
        if($result->num_rows > 0)
        {
            while($produto = mysqli_fetch_assoc($result))
            {
                $nome = $produto['Nome'];
                $preco = $produto['Preco'];
                $quantidade = $produto['Quantidade'];
                $peso = $produto['Peso'];
                $tipo = $produto['fk_Categoria_Produto_ID'];
                $descricao = $produto['Descricao'];
                $imagem = $produto['imagem'];
            }
        }
        else
        {
            header('Location: listarProdutos.php');
        }
    }
    else
    {
        header('Location: listarProdutos.php');
    }
?>

<div class='.container-fluid'>
        <div class="row justify-content-center pt-5">
            <div class='col-10'>
                <div class="card">
                    <h3 class="card-header text-dark">Alterar dados do produto</h3>
                    <div class="card-body">
                        <div class='col'>
                            <form action="saveEdit.php" method="POST">
                                <input name = 'idProduto'type="hidden" value="<?php echo $id ?>">
                                <div class="mb-3">
                                    <label for="Nome" class="form-label">Nome do produto</label>
                                    <input type="text" name="Nome" class="form-control" id="Nome" value = <?php echo $nome?> >
                                </div>
                                <div class="mb-3">
                                    <label for="Preco" class="form-label">Preco</label>
                                    <input type="text" name="Preco" class="form-control" id="Preco" value = <?php echo $preco?> >
                                </div>
                                <div class="mb-3">
                                    <label for="Quantidade" class="form-label">Quantidade</label>
                                    <input type="text" name="Quantidade" class="form-control" id="Quantidade" value = <?php echo $quantidade?> >
                                </div>
                                <div class="mb-3">
                                    <label for="Peso" class="form-label">Peso</label>
                                    <input type="text" name="Peso" class="form-control" id="Peso" value = <?php echo $peso?> >
                                    <div class="mb-3">
                                        <p> </p>
                                    </div>
                                </div>
                                <!-- Categoria -->
                                <div class="mb-3">
                                    <h6>Categoria nao pode ser alterada</h6>
                                </div>
                                <!-- Descricao-->
                                <div class="mb-3">
                                    <label for="Descricao" class="form-label">Descrição do produto</label>
                                    <textarea name="Descricao" class="form-control" id="Descricao" rows="3" value = <?php echo $descricao?> ><?php echo $descricao?></textarea>
                                </div>
                                <!-- Selecao de foto -->
                                <div class="mb-3">
                                    <H5>A imagem nao pode ser alterada</H5>
                                </div>
                                <div class="mb-3">
                                    <button name ="update" type="update" class="btn btn-outline-primary">Alterar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>