<?php 
  include('config.php');

  if (isset($_POST['proyecto'])) {
    $id = $_POST['idpv'];
    $vendedor_id = $_POST['vendedor_id'];
    $proyecto_id = $_POST['proyecto'];
    $date = date('Y-m-d H:m:i');

    $sql = "INSERT INTO proyecto_vendedor (proyecto_id, vendedor_id, date) VALUES ($proyecto_id, $vendedor_id, '$date')";

    if (mysqli_query($db,$sql)) {
      $datos = array(
        'error' => 0,
        'mensaje' => 'Se ha registrado un nuevo proyecto al vendedor'
      );
    }else{
      $datos = array(
        'error' => 1,
        'mensaje' => 'Ha ocurrido un error '.mysqli_error($db)
      );
    }

    echo json_encode($datos);
  }
?>