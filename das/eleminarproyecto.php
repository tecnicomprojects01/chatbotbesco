<?php 
  include('config.php');

    $id = $_POST['id'];
    $op = $_POST['op'];

    $sql = "UPDATE proyectos SET
          status = $op
          WHERE id=".$id;

    $msj = $op == 1 ? "habilitado" : "deshabilitado"; 
    
    if (mysqli_query($db,$sql)) {
      $datos = array(
        'error' => 0,
        'mensaje' => 'Se ha '.$msj.' el pro'
      );
    }else{
      $datos = array(
        'error' => 1,
        'mensaje' => 'Ha ocurrido un error '.mysqli_error($db)
      );
    }

    echo json_encode($datos);
  
?>
 <script>
         
          window.location = 'proyectos.php';
        </script>