<?php
    include('session.php');
    $id = $_GET['id'];

    if (isset($_POST['name']) && isset($_POST['descripcion']) && isset($_POST['url_imagen']) && isset($_POST['url_web'])) {
        $name = $_POST['name'];
        $descripcion = $_POST['descripcion'];
        $url_web = $_POST['url_web'];
        $url_imagen = $_POST['url_imagen'];

        $sql1 = "UPDATE metrajes SET
            name = '$name',
            descripcion = '$descripcion',
            url_web = '$url_web',
            url_imagen='$url_imagen'
            WHERE id = ".$id;
     
        if (mysqli_query($db,$sql1)) {
            ?>
            <script>
              alert("Metraje Actualizado");
              window.location = 'proyectos.php';
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
                            <strong>Editar Metraje</strong>
                        </div>
                        <?php
                          mysqli_query($db,"SET NAMES 'utf8'");  
                          $sql = "SELECT * FROM metrajes WHERE id=".$id;
                          $res = mysqli_query($db,$sql);
                          $fila = mysqli_fetch_array($res);
                        ?>
                        <div class="card-body card-block">
                          <form action="" method="POST">
                            <div class="form-group">
                                <label for="name" class=" form-control-label">Nombre</label>
                                <input type="text" name="name" class="form-control" value="<?= $fila['name']?>" required>
                            </div>
                            <div class="form-group">
                                <label for="telefono" class=" form-control-label">Descripcion</label>
                                <textarea type="text" name="descripcion" class="form-control" value="" required><?=  $fila['descripcion']?></textarea> 
                            </div>
                            <div class="form-group">
                                <label for="cargos" class=" form-control-label">Url Imagen</label>
                                <input type="text" name="url_imagen" class="form-control" value="<?= $fila['url_imagen']?>" required>
                            </div>
                              <div class="form-group">
                                <label for="cargos" class=" form-control-label">Url Web</label>
                                <input type="text" name="url_web" class="form-control" value="<?= $fila['url_web']?>" required>
                            </div>
                            <input type="submit" class="btn btn-primary" value="Actualizar">
                          </form>
                        </div>
                    </div>                          
                </div>
            </div>                            
            <?php include 'footer.php'; ?>