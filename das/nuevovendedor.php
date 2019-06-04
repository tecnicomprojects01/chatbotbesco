<?php
   include('session.php');
   mysqli_query($db,"SET NAMES 'utf8'");  
   if (isset($_POST['name']) && isset($_POST['telefono']) && isset($_POST['cargos'])) {
     $name = $_POST['name'];
     $telefono = $_POST['telefono'];
     $cargos = $_POST['cargos'];

     if ($name == '' || $telefono == '' || $cargos == '') {
       ?>
        <script>
          alert("Algun campo está vacio");
        </script>
        <?php
     }

     $sql1 = "INSERT INTO vendedores (name,telefono,cargos, habilitado) VALUES ('$name','$telefono','$cargos', 1)";
     
     if (mysqli_query($db,$sql1)) {
        ?>
        <script>
          alert("Vendedor Registrado correctamente");
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
                            <strong>Nuevo Vendedor</strong>
                        </div>
                        <div class="card-body card-block">
                          <form action="" method="POST">
                            <div class="form-group">
                                <label for="name" class=" form-control-label">Nombres y Apellidos</label>
                                <input type="text" name="name" placeholder="Ingrese Nombre y Apellido" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="telefono" class=" form-control-label">Telefono</label>
                                <input type="text" name="telefono" placeholder="123456789" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="cargos" class=" form-control-label">Cargo</label>
                                <input type="text" name="cargos" placeholder="Ingrese el cargo" class="form-control" required>
                            </div>
                            <input type="submit" class="btn btn-success" value="Registrar">
                          </form>
                        </div>
                    </div>                          
                </div>
            </div>                            
            <?php include 'footer.php'; ?>