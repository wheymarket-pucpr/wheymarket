<?php
session_start()
?>
<!DOCTYPE html>
<html lang="Pt-br">
<?php include('htmlhead.php');?>

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
                $anuncio = $produto['Anuncio'];
            }
        }
        else
        {
            header('Location: produtosListar.php');
        }
    }
    else
    {
        header('Location: produtosListar.php');
    }
?>

<div class='.container-fluid'>
        <div class="row justify-content-center pt-5">
            <div class='col-10'>
                <div class="card">
                    <h3 class="card-header text-dark">Alterar dados do produto</h3>
                    <div class="card-body">
                        <div class='col'>
                            <form action="produtoSaveEdit.php" method="POST">
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
                                <!-- Anunciar ou nao -->
                                <div class="form-check">
                                    <input class="form-check-input" value= "1" type="radio" name="anunciar" id="flexRadioDefault1">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Anunciar produto
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" value="0" type="radio" name="anunciar" id="flexRadioDefault2" checked>
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Não anunciar produto
                                    </label>
                                </div>
                                <br>   
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