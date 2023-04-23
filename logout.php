<?php
    session_start();
    session_destroy();
    session_start();
    $_SESSION['logado'] = false;
    $_SESSION['mensagemLogout'] = 'logout com sucesso';
    header('location: index.php');
    exit();
?>