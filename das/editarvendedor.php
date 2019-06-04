<?php
   include('session.php');
   $id = $_GET['id'];

   if (isset($_POST['name']) && isset($_POST['telefono']) && isset($_POST['cargos'])) {
     $name = $_POST['name'];
     $telefono = $_POST['telefono'];
     $cargos = $_POST['cargos'];
     $sql1 = "UPDATE vendedores SET
          name = '$name',
          telefono = '$telefono',
          cargos = '$cargos'
          WHERE id = ".$id;
     
     if (mysqli_query($db,$sql1)) {
    
        require dirname(__FILE__).'/extras/phpmailer/phpmailer/src/Exception.php';
        require dirname(__FILE__).'/extras/phpmailer/phpmailer/src/PHPMailer.php';

        $mail = new PHPMailer\PHPMailer\PHPMailer();

        $array = array("darwinvaleroreb@gmail.com","codigo2@tecnicom.pe");

        $asunto = '[Notificación] - Cambios datos de vendedor'; //Asunto

        $content = "";

        $content .= "El cliente ha modificado informacion personal del vendedor ".$name."<br>";
        $content .= "Telefono: ". $telefono."<br>";
        $content .= "Se debe Actualizar la cola";

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

        ?>
        <script>
          alert("Vendedor Actualizado");
          window.location = 'vendedores.php';
        </script>
        <?php

     }
  }
  include 'header.php';
?>
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                      <div class="card">
                        <div class="card-header">
                            <strong>Editar Vendedor</strong>
                        </div>
                        <?php
                          mysqli_query($db,"SET NAMES 'utf8'");  
                          $sql = "SELECT * FROM vendedores WHERE id=".$id;
                          $res = mysqli_query($db,$sql);
                          $fila = mysqli_fetch_array($res);
                        ?>
                        <div class="card-body card-block">
                          <form action="" method="POST">
                            <div class="form-group">
                                <label for="name" class=" form-control-label">Nombres y Apellidos</label>
                                <input type="text" name="name" placeholder="Ingrese Nombre y Apellido" class="form-control" value="<?= $fila['name']?>" required>
                            </div>
                            <div class="form-group">
                                <label for="telefono" class=" form-control-label">Telefono</label>
                                <input type="text" name="telefono" placeholder="123456789" class="form-control" value="<?= $fila['telefono']?>" required>
                            </div>
                            <div class="form-group">
                                <label for="cargos" class=" form-control-label">Cargo</label>
                                <input type="text" name="cargos" placeholder="Ingrese el cargo" class="form-control" value="<?= $fila['cargos']?>" required>
                            </div>
                            <input type="submit" class="btn btn-primary" value="Actualizar">
                          </form>
                        </div>
                    </div>                          
                </div>
            </div>                            
            <?php include 'footer.php'; ?>