<?php
if (isset($_SESSION['mensagem'])) :
?>
  <div class="alert alert-info" role="alert">
    <?php echo $_SESSION['mensagem']; ?>
  </div>
<?php
  unset($_SESSION['mensagem']);

endif;
?>