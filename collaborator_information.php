<<<<<<< Tabnine <<<<<<<
<?php
    $page_title = 'Información de Colaboradores';
    require_once('includes/load.php');
    page_require_level(3);
    $collaborators = join_collaborator_table();
?>

<?php include_once('layouts/header.php'); ?>
  <div class="row">
    <div class="col-md-12">
        <?php echo display_msg($msg); ?>
    </div>
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
         <div class="pull-right">
           <a href="add_collaborator.php" class="btn btn-primary">Nuevo Colaborador</a>
           <a href="cargos.php" class="btn btn-primary">Cargos Laborales</a>
         </div>
        </div>

    <div class="panel-body">
        <table class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center" style="width: 20%;">#</th>
                <th class="text-center" style="width: 40%;"> NOMBRE </th>
                <th class="text-center" style="width: 20%;"> NÚMERO DE IDENTIFICACIÓN </th>
                <th class="text-center" style="width: 10%;"> CARGO </th>
                <th class="text-center" style="width: 10%;"> FECHA DE INGRESO </th>
                <th class="text-center" style="width: 10%;"> SALARIO </th>
                <th class="text-center" style="width: 100%;"> ACCIONES </th>
              </tr>
            </thead>
    <tbody>
        <?php foreach ($collaborators as $collaborator):?>
            <tr>
                <td class="text-center"><?php echo count_id();?></td>
                <td> <?php echo remove_junk($collaborator['nombre']); ?></td>
                <td class="text-center"> <?php echo remove_junk($collaborator['numero_cedula'])?></td>
                <td class="text-center"> <?php echo remove_junk($collaborator['cargo']); ?></td>
                <td class="text-center"> <?php echo remove_junk($collaborator['fecha_contratacion']); ?></td>
                <td class="text-center"> <?php echo remove_junk($collaborator['salario']); ?></td>
                <td class="text-center">
                  <div class="btn-group">
                    <a href="edit_product.php?id=<?php echo (int)$product['id'];?>" class="btn btn-info btn-xs"  title="Editar" data-toggle="tooltip">
                    <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                    <a href="delete_product.php?id=<?php echo (int)$product['id'];?>" class="btn btn-danger btn-xs"  title="Eliminar" data-toggle="tooltip">
                    <i class="fa-solid fa-trash"></i>
                    </a>
                    <a href="employment_letter.php?id=<?php echo (int)$product['id'];?>" class="btn btn-success btn-xs"  title="Carta Laboral" data-toggle="tooltip">
                    <i class="fa-solid fa-file-pdf"></i>
                    </a>
                  </div>
                </td>
              </tr>
             <?php endforeach; ?>
            </tbody>
          </tabel>
        </div>
      </div>
    </div>
  </div>
  <?php include_once('layouts/footer.php'); ?>