<?php
    include('session.php');

    if (isset($_POST['nombre']) && isset($_POST['usuario']) && isset($_POST['clave'])) {
        $nombre = $_POST['nombre'];
        $usuario = $_POST['usuario'];
        $clave = $_POST['clave'];

        $conversiones = isset($_POST['conversiones']) ? 1 : 0;
        $modificaciones = isset($_POST['modificaciones']) ? 1 : 0;
        $usuarios = isset($_POST['usuarios']) ? 1 : 0;        

        $sql1 = "INSERT INTO usuarios (nombre, usuario, password, conversiones, modificaciones, usuarios ) 
            VALUES ('$nombre', '$usuario', '$clave', $conversiones, $modificaciones, $usuarios)";
   
        if (mysqli_query($db,$sql1)) {
            ?>
            <script>
              alert("Usuario Registrado");
              window.location = 'usuarios.php';
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
                            <strong>Nuevo Usuario</strong>
                        </div>
                        <div class="card-body card-block">
                          <form action="nuevousuario.php" method="POST">
                            <div class="form-group">
                                <label for="nombre" class=" form-control-label">Nombre</label>
                                <input type="text" name="nombre" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="usuario" class=" form-control-label">Usuario</label>
                                <input type="text" name="usuario" class="form-control" required> 
                            </div>
                            <div class="form-group">
                                <label for="clave" class=" form-control-label">Clave</label>
                                <input type="password" name="clave" class="form-control" required>
                            </div>
                            <legend>Privilegios</legend>
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>Conversiones &emsp;<input type="checkbox" name="conversiones" value="1"></label>
                                </div>
                                <div class="checkbox">
                                    <label>Modificaciones &emsp;<input type="checkbox" name="modificaciones" value="1"></label>
                                </div>
                                <div class="checkbox">
                                    <label>Usuarios &emsp;<input type="checkbox" name="usuarios" value="1"></label>
                                </div>
                            </div>   
                            <input type="submit" class="btn btn-primary" value="Registrar">
                          </form>
                        </div>
                    </div>                          
                </div>
            </div>                            
            <?php include 'footer.php'; ?>