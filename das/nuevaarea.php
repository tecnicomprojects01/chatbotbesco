<?php
    include('session.php');
    $proyecto_id = $_GET['proyecto_id'];
    if (isset($_POST['nombre']) && isset($_POST['descripcion'])) {       
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];  
        $target_path = __DIR__."/areas_comunes/";
        $destino=$_FILES['url_imagen']['name'];
        $target_path = $target_path . basename( $_FILES['url_imagen']['name']); 
        if(move_uploaded_file($_FILES['url_imagen']['tmp_name'], $target_path)) {
            echo "El archivo ".  basename( $_FILES['url_imagen']['name'])." ha sido subido";
            $sql1 = "INSERT INTO areas (proyecto_id, name, descripcion, url_imagen,status ) 
                    VALUES ('$proyecto_id', '$nombre' ,'$descripcion', 'http://chat.tecnicom.pe/das/areas_comunes/$destino', '1')";
   
            if (mysqli_query($db,$sql1)) { ?>
            <script>
                alert("Metraje Registrado");
                window.location = 'areasc.php?id=<?= $proyecto_id ?>';
            </script>
            <?php
            }
        } else{
          echo $_FILES["url_imagen"]["error"];
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
                            <strong>Nueva Area</strong>
                        </div>
                        <div class="card-body card-block">
                          <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="name" class=" form-control-label">Nombre</label>
                                <input type="text" name="nombre" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="telefono" class=" form-control-label">Descripcion</label>
                                <textarea name="descripcion" class="form-control"></textarea> 
                            </div>
                            <div class="form-group">
                                <label for="cargos" class=" form-control-label"> Imagen</label>
                                <input type="file" name="url_imagen" class="form-control" required>
                            </div>
                              
                            <input type="submit" class="btn btn-primary" value="Registrar">
                          </form>
                        </div>
                    </div>                          
                </div>
            </div>                            
            <?php include 'footer.php'; ?>