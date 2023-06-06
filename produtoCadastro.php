<?php
session_start();
require 'conexao.php';

// input e verificacao da imagem
$img = filter_input_array(INPUT_POST, FILTER_DEFAULT);
if (!empty($_FILES['imgProduto'])) {

    $img = $_FILES['imgProduto'];

    if ($img['type'] == "application/png" || "application/jpeg") {

        $imgBlob = addslashes(file_get_contents($img['tmp_name']));
    } else {
        echo "<p style='color: #f00;'>Erro: Extensão do arquivo inválido.";
    }
}

// input dos dados do produto 
if (!empty($_POST) && isset($_POST['Nome']) && isset($_POST['Preco']) && isset($_POST['Peso']) && isset($_POST['Quantidade']) && isset($_POST['Descricao']) && isset($_POST['anunciar'])) {
    $nome = $conn->real_escape_string($_POST['Nome']);
    $preco    = $conn->real_escape_string($_POST['Preco']);
    $quantidade    = $conn->real_escape_string($_POST['Quantidade']);
    $peso   = $conn->real_escape_string($_POST['Peso']);
    $categoria   = $conn->real_escape_string($_POST['fk_Categoria_Produto_ID']);
    $descricao   = $conn->real_escape_string($_POST['Descricao']);
    $anuncio = $conn->real_escape_string($_POST['anunciar']);
    $id = $_SESSION['id'];
    $sql = "INSERT INTO Produto(fk_Lojista_ID, fk_Categoria_Produto_ID, Nome, Preco, Quantidade, Peso, Descricao, imagem, Anuncio) 
                VALUES ('$id','$categoria','$nome','$preco','$quantidade','$peso','$descricao', '$imgBlob', '$anuncio')";

    if ($result = $conn->query($sql)) {
        $_SESSION['mensagem'] = "Cadastro efetuado com sucesso. Você já pode vender em nosso site! ";
        header('location: produtosListar.php');
        exit();
    } else {
        $_SESSION['mensagem'] = "Erro executando INSERT: " . $conn->error . " Tente novo cadastro.";
        header('location: index.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="Pt-br">

<?php include('htmlhead.php'); ?>

<body>
    <?php
    require('navbar.php');
    ?>
    <div class='.container-fluid'>
        <div class="row justify-content-center pt-5">
            <div class='col-10'>
                <div class="card">
                    <h5 class="card-header text-dark">Cadastre um produto</h5>
                    <h6><span style="color: red;">* Campos Obrigatórios</span></h6>
                    <div class="card-body">
                        <div class='col'>
                            <form action="" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                                <!-- Nome -->
                                <div class="mb-3">
                                    <label for="Nome" class="form-label">Nome do produto <span style="color: red;">*</span></label>
                                    <input type="text" name="Nome" class="form-control" id="Nome" placeholder='Ex: Creatina Growth' required>
                                    <div class="invalid-feedback">
                                        Este campo precisa ser preenchido.
                                    </div>
                                </div>
                                <!-- Preco -->
                                <div class="mb-3 d-block">
                                    <label for="Preco" class="form-label">Preco<span style="color: red;">*</span></label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">R$</span>
                                        <input type="text" name="Preco" class="form-control Preco" id="Preco" placeholder='Ex: R$60,00' required>
                                        <div class="invalid-feedback">
                                            Este campo precisa ser preenchido.
                                        </div>
                                    </div>
                                </div>
                                <!-- Quantidade -->
                                <div class="mb-3">
                                    <label for="Quantidade" class="form-label">Quantidade<span style="color: red;">*</span></label>
                                    <input type="number" name="Quantidade" class="form-control" id="Quantidade" L placeholder='Ex: 50 produtos' required>
                                    <div class="invalid-feedback">
                                        Este campo precisa ser preenchido.
                                    </div>
                                </div>
                                <!-- Peso -->
                                <div class="mb-3">
                                    <label for="Peso" class="form-label">Peso<span style="color: red;">*</span></label>
                                    <input type="number" name="Peso" class="form-control" id="Peso" placeholder="Ex: 900g" required>
                                    <div class="invalid-feedback">
                                        Este campo precisa ser preenchido.
                                    </div>
                                </div>
                                <!-- Categoria -->
                                <div class="mb-3">
                                    <h6>Tipo produto (Categoria)<span style="color: red;">*</span></h6>
                                    <select id='fk_Categoria_Produto_ID' class="form-select" name="fk_Categoria_Produto_ID" aria-label="Default select example" required>
                                        <option selected></option>
                                        <option value="1">Termogênicos</option>
                                        <option value="2">Aminoácidos</option>
                                        <option value="3">Acessórios</option>
                                        <option value="4">Whey</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Selecione uma categoria.
                                    </div>
                                </div>
                                <!-- Descricao-->
                                <div class="mb-3">
                                    <label for="Descricao" class="form-label">Descrição do produto</label>
                                    <textarea name="Descricao" class="form-control" id="Descricao" rows="3"></textarea>
                                </div>
                                <!-- Anunciar produto ou nao -->
                                <div class="form-check">
                                    <input class="form-check-input" value="1" type="radio" name="anunciar" id="flexRadioDefault1">
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
                                    <label for="imgProduto" class="form-label">Selecione uma foto do produto<span style="color: red;">*</span></label>
                                    <input class="form-control" type="file" id="imgProduto" name="imgProduto" required>
                                </div>

                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
<script type="text/javascript">
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }

            form.classList.add('was-validated')
        }, false)
    });
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="js/jquery.mask.min.js"></script>
<script>
    $(document).ready(function() {
        $('.Preco').mask('000.000.000.000.000,00', {
            reverse: true
        });
    });
</script>

</html>