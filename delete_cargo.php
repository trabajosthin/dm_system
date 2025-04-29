<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
?>

<?php
  $cargo = find_by_id('cargos',(int)$_GET['id']);
  if(!$cargo){
    $session->msg("d","No existe el ID.");
    redirect('cargos.php');
  }
?>

<?php
  $delete_id = delete_by_id('cargos',(int)$cargo['id']);
  if($delete_id){
      $session->msg("s","Cargo eliminado correctamente.");
      redirect('cargos.php');
  } else {
      $session->msg("d","Error, intente eliminar nuevamente el cargo.");
      redirect('cargos.php');
  }
?>
