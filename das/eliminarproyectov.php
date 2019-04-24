<?php 
  include('config.php');

    $id = $_POST['idpv'];

    $sql = "DELETE FROM proyecto_vendedor WHERE id=".$id;

    if (mysqli_query($db,$sql)) {
      $datos = array(
        'error' => 0,
        'mensaje' => 'Se ha eliminado el proyecto al vendedor'
      );
    }else{
      $datos = array(
        'error' => 1,
        'mensaje' => 'Ha ocurrido un error '.mysqli_error($db)
      );
    }

    echo json_encode($datos);
  
?>