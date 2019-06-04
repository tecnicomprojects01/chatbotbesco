<?php 
    include('session.php');
    $id = $_GET['id'];

    if (isset($_POST['name']) && isset($_POST['descripcion']) ){
        $name = $_POST['name'];
        $descripcion = $_POST['descripcion'];
        $target_path = __DIR__."/areas_comunes/";
        $destino=$_FILES['url_imagen']['name'];
        $target_path = $target_path . basename( $_FILES['url_imagen']['name']); 
        if(move_uploaded_file($_FILES['url_imagen']['tmp_name'], $target_path)) {
            echo "El archivo ".  basename( $_FILES['url_imagen']['name'])." ha sido subido";
            $sql1 = "UPDATE areas SET
                name = '$name',
                descripcion = '$descripcion',           
                url_imagen='http://chat.tecnicom.pe/das/areas_comunes/$destino'
                WHERE id = ".$id;
            }else{
                if (mysqli_query($db,$sql1)) {            
                ?> 
                    <script>
                        alert("Area comun Actualizado");
                        window.location = 'proyectos.php';
                    </script>
                <?php
                }
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
                            <strong>Editar Area comun</strong>
                        </div>
                        <?php
                          mysqli_query($db,"SET NAMES 'utf8'");  
                          $sql = "SELECT * FROM areas WHERE id=".$id;
                          $res = mysqli_query($db,$sql);
                          $fila = mysqli_fetch_array($res);
                        ?>
                        <div class="card-body card-block">
                          <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="name" class=" form-control-label">Nombre</label>
                                <input type="text" name="name" class="form-control" value="<?= $fila['name']?>" required>
                            </div>
                            <div class="form-group">
                                <label for="telefono" class=" form-control-label">Descripcion</label>
                                <textarea type="text" name="descripcion" class="form-control" value="" required><?=  $fila['descripcion']?></textarea> 
                            </div>
                            <div class="form-group">
                                <label for="cargos" class=" form-control-label">Imagen</label>
                                <input type="file" name="url_imagen" class="form-control" value="<?= $fila['url_imagen']?>" required>
                            </div>
                              
                            <input type="submit" class="btn btn-primary" value="Actualizar">
                          </form>
                        </div>
                    </div>                          
                </div>
            </div>                            
            <?php include 'footer.php';