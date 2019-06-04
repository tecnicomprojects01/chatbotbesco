<?php
    include('session.php');
    $proyecto_id = $_GET['proyecto_id'];

    if (isset($_POST['name']) && isset($_POST['descripcion']) && isset($_POST['url_imagen']) && isset($_POST['url_web'])) {
        $name = $_POST['name'];
        $descripcion = $_POST['descripcion'];
        $url_web = $_POST['url_web'];
        $url_imagen = $_POST['url_imagen'];

        $sql1 = "INSERT INTO metrajes (proyecto_id, name, descripcion, url_imagen, created_at, url_web, status ) 
            VALUES ($proyecto_id, '$name' ,'$descripcion', '$url_imagen', CURRENT_TIMESTAMP, '$url_web', 1)";
     
        if (mysqli_query($db,$sql1)) {
            ?>
            <script>
              alert("Metraje Registrado");
              window.location = 'metraje.php?id=<?= $proyecto_id ?>';
            </script>
            <?php
        }
    }
    include('header.php');
?>
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                      <div class="card">
                        <div class="card-header">
                            <strong>Nuevo Metraje</strong>
                        </div>
                        <div class="card-body card-block">
                          <form action="" method="POST">
                            <div class="form-group">
                                <label for="name" class=" form-control-label">Nombre</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="telefono" class=" form-control-label">Descripcion</label>
                                <textarea name="descripcion" class="form-control"></textarea> 
                            </div>
                            <div class="form-group">
                                <label for="cargos" class=" form-control-label">Url Imagen</label>
                                <input type="text" name="url_imagen" class="form-control" required>
                            </div>
                              <div class="form-group">
                                <label for="cargos" class=" form-control-label">Url Web</label>
                                <input type="text" name="url_web" class="form-control" required>
                            </div>
                            <input type="submit" class="btn btn-primary" value="Registrar">
                          </form>
                        </div>
                    </div>                          
                </div>
            </div>                            
            <?php include 'footer.php'; ?>