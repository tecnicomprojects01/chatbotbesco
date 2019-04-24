<?php 
include('config.php');
$id = $_GET['id'];

  if (isset($_POST['proyecto'])) {
    
    $vendedor_id = $_POST['vendedor_id'];
    $proyecto_id = $_POST['proyecto'];
    $date = date('Y-m-d H:m:i');

    $sql = "UPDATE proyecto_vendedor SET
        proyecto_id = $proyecto_id,
        vendedor_id = $vendedor_id,
        date = '$date'
        WHERE id=".$id;

    if (mysqli_query($db,$sql)) {
      $datos = array(
        'error' => 0,
        'mensaje' => 'Se ha actualizado el proyecto del vendedor'
      );
    }else{
      $datos = array(
        'error' => 1,
        'mensaje' => 'Se ha producido un error '.mysql_error($db)
      );
    }

    //Enviar correo de que se han realizados cambios
    //Todos los cambios son reportados
    
    mysqli_query($db,"SET NAMES 'utf8'");  
    $sql2 = "SELECT * FROM vendedores WHERE id =".$id;
    $res2 = mysqli_query($db,$sql2);
    $fila = mysqli_fetch_array($res2);

    $sql1 = "SELECT * FROM proyectos WHERE id =1";
    $res1 = mysqli_query($db,$sql1);
    $fila1 = mysqli_fetch_array($res1);
   
    require dirname(__FILE__).'/extras/phpmailer/phpmailer/src/Exception.php';
    require dirname(__FILE__).'/extras/phpmailer/phpmailer/src/PHPMailer.php';

    $mail = new PHPMailer\PHPMailer\PHPMailer();

    $array = array("darwinvaleroreb@gmail.com","codigo2@tecnicom.pe");

    $asunto = '[Notificación] - Cambios proyectos de vendedor'; //Asunto

    $content = "";

    $content .= "El cliente ha modificado informacion de los proyectos del vendedor ".$fila['name']."<br>";
    $content .= "Nombre proyecto: ". $fila1['name']."<br>";
    $content .= "Se debe cambiar de cola";

    $mail->setFrom('devm4648@gmail.com', 'Besco cambios'); // Nuestro correo electrónico
    $mail->IsHTML(true); // Indicamos que el email tiene formato HTML                      
    $mail->Subject = $asunto; // El asunto del email
    $mail->Body = $content; // El cuerpo de nuestro mensaje

    // Recorremos nuestro array de e-mails.

    foreach ($array as $email) {
      $mail->AddAddress($email); // Cargamos el e-mail destinatario a la clase PHPMailer
      $mail->Send(); // Realiza el envío =)
      $mail->ClearAddresses(); // Limpia los "Address" cargados previamente para volver a cargar uno.
    }

    echo json_encode($datos);
  }
?>