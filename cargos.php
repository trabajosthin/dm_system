<?php
  $page_title = 'Cargos';
  require_once('includes/load.php');
  page_require_level(1);

  $all_cargos = find_all('cargos');
?>

<?php
 if(isset($_POST['add_cargo'])){
   $req_field = array('cargo-name');
   validate_fields($req_field);

   $car_name = remove_junk($db->escape($_POST['cargo-name']));

   if(empty($errors)){
    $sql = "INSERT INTO cargos (name) VALUES ('{$car_name}')";
      if($db->query($sql)){
        $session->msg("s", "Cargo agregado correctamente.");
        redirect('cargos.php',false);
      } else {
        $session->msg("d", "Error, intenta nuevamente ingresar el cargo.");
        redirect('cargos.php',false);
      }
   } else {
     $session->msg("d", $errors);
     redirect('cargos.php',false);
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
    <div class="col-md-5">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong><i class="fa-solid fa-plus" style="color: #74C0FC;"></i><span> NUEVO CARGO </span></strong>
        </div>
        <div class="panel-body">
          <form method="post" action="cargos.php">
            <div class="form-group">
              <input type="text" class="form-control" name="cargo-name" placeholder="Nombre del Cargo">
            </div>
            <button type="submit" name="add_cargo" class="btn btn-success">AGREGAR</button>
          </form>
        </div>
      </div>
    </div>

  <div class="col-md-7">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong><i class="fa-solid fa-toolbox" style="color: #74C0FC;"></i><span> CARGOS - DISTRIDEKO MUEBLES </span></strong>
      </div>
        <div class="panel-body">
          <table class="table table-bordered table-striped table-hover">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
                  <th>NOMBRE</th>
                  <th class="text-center" style="width: 100px;">ACCIONES</th>
              </tr>
            </thead>
      <tbody>
        <?php foreach ($all_cargos as $car):?>
          <tr>
            <td class="text-center"><?php echo count_id();?></td>
            <td><?php echo remove_junk(ucfirst($car['name'])); ?></td>
              <td class="text-center">
                <div class="btn-group">
                <a href="delete_cargo.php?id=<?php echo (int)$car['id'];?>" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Eliminar">
                  <span class="glyphicon glyphicon-trash"></span>
                </a>
                </div>
              </td>
          </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
    </div>  
  </div>
  </div>
  <?php include_once('layouts/footer.php'); ?>
