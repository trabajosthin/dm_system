<?php
  $page_title = 'Nuevo Colaborador';
  require_once('includes/load.php');
  page_require_level(2);

$all_cargos = find_all('cargos');

?>



<?php
 if(isset($_POST['add_collaborator'])){
   $req_fields = array('collaborator-cedula', 'collaborator-name', 'collaborator-cargo', 'collaborator-salario', 'collaborator-date');
   validate_fields($req_fields);

   if(empty($errors)){
     $p_cedula  = remove_junk($db->escape($_POST['collaborator-cedula']));
     $p_name  = remove_junk($db->escape($_POST['collaborator-name']));
     $p_car   = remove_junk($db->escape($_POST['collaborator-cargo']));
     $p_salario  = remove_junk($db->escape($_POST['collaborator-salario']));
     $p_datec  = remove_junk($db->escape($_POST['collaborator-date']));

     $query  = "INSERT INTO collaborators (numero_cedula, nombre, cargo, salario, fecha_contratacion) ";
     $query .= "VALUES ('{$p_cedula}', '{$p_name}', '{$p_car}', '{$p_salario}', '{$p_datec}') ";
     $query .= "ON DUPLICATE KEY UPDATE nombre='{$p_name}', cargo='{$p_car}', salario='{$p_salario}', fecha_contratacion='{$p_datec}'";

     if($db->query($query)){
       $session->msg('s', "Colaborador agregado correctamente.");
       redirect('collaborator_information.php', false);
     } else {
       $session->msg('d', 'Error, intenta agregar el empleado nuevamente.');
       redirect('add_collaborator.php', false);
     }
   } else {
     $session->msg("d", $errors);
     redirect('add_collaborator.php', false);
   }
 }
?>

<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
</div>

<div class="row">
  <div class="col-md-8">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong><i class="fa-solid fa-user-plus" style="color: #74C0FC;"></i> Nuevo Colaborador</strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="add_collaborator.php" class="clearfix">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa-solid fa-id-card"></i></span>
                  <input type="text" class="form-control" name="collaborator-cedula" placeholder="Cédula">
               </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa-solid fa-user"></i></span>
                  <input type="text" class="form-control" name="collaborator-name" placeholder="Nombre">
               </div>
              </div>

              <div class="form-group">
                <select class="form-control" name="collaborator-cargo">
                  <option value="">SELECCIONAR CARGO</option>
                  <?php foreach ($all_cargos as $car): ?>
                      <option value="<?php echo (int)$car['id']; ?>">
                        <?php echo htmlspecialchars($car['name']); ?>
                      </option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa-solid fa-dollar-sign"></i></span>
                  <input type="number" class="form-control" name="collaborator-salario" placeholder="Salario" step="0.01">
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa-solid fa-calendar"></i></span>
                  <input type="date" class="form-control" name="collaborator-date">
                </div>
              </div>

              <button type="submit" name="add_collaborator" class="btn btn-success">Agregar Colaborador</button>
          </form>
         </div>
        </div>
      </div>
  </div>
</div>

<?php include_once('layouts/footer.php'); ?>
