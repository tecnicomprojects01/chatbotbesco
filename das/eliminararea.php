<?php 
  include('config.php');

  
    $id = $_POST['id'];
   

    $sql = "DELETE * FROM areas where id=$id";

    if (mysqli_query($db,$sql)) {
      $datos = array(
        'error' => 0,
        'mensaje' => 'Se ha registrado un nuevo proyecto al vendedor'
      );
    