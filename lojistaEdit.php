<?php

include_once('conexao.php');
session_start();    

if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $sqlSelect = "SELECT * FROM lojista WHERE ID=$id";
    $result = $conn->query($sqlSelect);
    if ($result->num_rows > 0) {
        $lojista = mysqli_fetch_assoc($result);
        $nome = $lojista['Nome'];
        $email = $lojista['email'];
        $cnpj = $lojista['CNPJ'];
    }
} else {
    
    header('Location: produtosListar.php');


}



?>
<!DOCTYPE html>
<html lang="Pt-br">

<?php include('htmlhead.php');?>


<body>
    <?php
    require('navbar.php');
    ?>
    <div class='.container-fluid'>
        <div class="row justify-content-center pt-5">
            <div class='col-3'>
                <div class="card">
                    <h5 class="card-header text-dark">Editar cadastro do lojista</h5>
                    <div class="card-body">
                        <div class='col'>
                            <form action="lojistaSaveEdit.php" method="POST" class="needs-validation" novalidate>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" id="email" placeholder="example@example.com" 
                                    value="<?php  echo $lojista['email']?>" maxlength="50" required />
                                    <div class="invalid-feedback">
                                        Informe um e-mail válido.
                                    </div>
                                </div>
                                <!-- nao vai ser editavel -->
                                <div class="mb-3">
                                    <label for="CNPJ" class="form-label">CNPJ <span style="color: red">(Nao editável)</span></label>
                                    <input type="text" name="CNPJ" class="form-control cnpj" id="CNPJ" maxlength="14" pattern="\d{2}.?\d{3}.?\d{3}/?\d{4}-?\d{2}"
                                     readonly value="<?php  echo $lojista['CNPJ']?>" />
                                    <div class="invalid-feedback" >
                                        Informe um CNPJ válido.
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="Nome" class="form-label">Nome</label>
                                    <input type="text" name="Nome" class="form-control" id="Nome" placeholder="Nome da loja"
                                    value="<?php echo  $lojista['Nome']?>" maxlength="100" required />
                                    <div class="invalid-feedback">
                                        Informe um nome válido.
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="senha" class="form-label">Senha</label>
                                    <input type="password" name="senha" class="form-control" id="senha" placeholder='********' pattern="^(?=.*[A-Z])(?=.*[0-9])(?=\S{8,20}$).*"
                                    minlength="8" maxlength="20" 
                                    onkeyup="confereSenha()" required>
                                    <div class="invalid-feedback">
                                        Informe uma senha válida.
                                    </div>
                                    <div id="MensagemPassword" class="form-text">
                                        Sua senha deve ter 8-20 caracteres, no mínimo uma letra maiscula, no mínimo um número, e não deve conter espaços.
                                    </div>
                                </div>
                                <div class="mb-3 position-relative">
                                    <label for="senha" class="form-label">Confirmar Senha</label>
                                    <input type="password" name="confirma" class="form-control" id="confimar-senha" placeholder='********' pattern="^(?=.*[A-Z])(?=.*[0-9])(?=\S{8,20}$).*"
                                    minlength="8" maxlength="20" onkeyup="confereSenha()" required>
                                    <div class="invalid-tooltip">
                                        Senhas não conferem. Sua senha deve ser identica a informada acima.
                                    </div>
                                </div>
                                <div class="d-grid gap-2 mb-3 mt-3">
                                    <input name="ID" type="hidden" value="<?php echo $lojista['ID'] ?>"> 
                                    <button name="update" class="btn btn-outline-primary" type="update">Enviar</button>
                                    <a class = "btn btn-outline-secondary"href="lojistaPage.php">Cancelar</a>
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

  function confereSenha() {
    console.log("chamou a função confereSenha");
    const senha = document.getElementById('senha');
    const confirma = document.getElementById('confimar-senha');
    const divPasswordMessage = document.getElementById('passwordHelpBlock');

    var classValidSenha = senha.value == confirma.value;

    if(!classValidSenha) {
        confirma.classList.add("is-invalid");
        confirma.classList.remove("is-valid");
        //A linha abaixo só serve para que o campo seja consederado sem erro no core do input HTML refletindo na cor do campo em verde pelo bootstrap.
        confirma.setCustomValidity("Erro!");
        divPasswordMessage.classList.remove("d-none");
    } else {
        confirma.classList.remove("is-invalid");
        confirma.classList.add("is-valid");
        //A linha abaixo só serve para que o campo seja consederado com erro no core do input HTML refletindo na cor do campo em vermelho pelo bootstrap.
        confirma.setCustomValidity("");
        divPasswordMessage.classList.add("d-none");
    }
}

function senhaOK(){
    alert("As senhas conferem!")
}


function alerta() {
  alert("Ocorreu algum erro ou voce nao tem permissoes para acessar esta pagina");
}


</script>
</html>