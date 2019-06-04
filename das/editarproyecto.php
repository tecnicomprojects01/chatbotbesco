<?php
   include('session.php');
   $id = $_GET['id'];

   if (isset($_POST['name']) && isset($_POST['telefono']) && isset($_POST['cargos'])) {
     $name = $_POST['name'];
     $departamento = $_POST['departamento'];
     $telefono = $_POST['telefono'];
     $cargos = $_POST['cargos'];
      $precio = $_POST['precio'];

       $llamada = $_POST['llamada'];
        $whap = $_POST['whap'];
        if($llamada!=1){
            $llamada=0;


        }
          if($whap!=1){
            $whap=0;


        }

     $sql1 = "UPDATE proyectos SET
          name = '$name',
          departamento_id = '$departamento',
          descripcion = '$telefono',
          ubicacion = '$cargos',
           aceptar_llamadas='$llamada',
          aceptar_whap='$whap',
          desde_precio='$precio'

          WHERE id = ".$id;
          
          if (isset($_POST['dormi'])){

            $dormitorios=$_POST['dormi'];
 
     $sql2 = "UPDATE respuestas_cualidades SET
          respuesta = '$dormitorios'
        

          WHERE proyecto_id ='$id' AND cualidad_id='1'";

          }
          if (isset($_POST['ate1'])){

            $atenea=$_POST['ate1'];


     $sql3 = "UPDATE respuestas_cualidades SET
          respuesta = '$atenea'          
          WHERE proyecto_id = '$id' AND cualidad_id='6'";

          }
     $precio = "Desde: ".$precio.", sujeto a diponibilidad";
     $sql4 = "UPDATE respuestas_cualidades SET
          respuesta = '$precio'
          WHERE proyecto_id = '$id' AND cualidad_id='9'";

     
     if (mysqli_query($db,$sql1)) {
        if (mysqli_query($db,$sql2)) {
          if (mysqli_query($db,$sql3)) {
            if(mysqli_query($db,$sql4)) {
              ?>
              <script>
                alert("Proyecto Actualizado");
                window.location = 'proyectos.php';
              </script>
              <?php
            }
          }
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
                                        <strong>Editar proyecto</strong>
                                    </div>
                                    <?php
                                      mysqli_query($db,"SET NAMES 'utf8'");  
                                      $sql = "SELECT * FROM proyectos WHERE id=".$id;
                                      $res = mysqli_query($db,$sql);
                                      $fila = mysqli_fetch_array($res);
                                    ?>
                                    <div class="card-body card-block">
                                      <form action="" method="POST">
                                        <div class="form-group">
                                            <label for="name" class=" form-control-label">Nombre</label>
                                            <input type="text" name="name" placeholder="Ingrese Nombre y Apellido" class="form-control" value="<?= $fila['name']?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="telefono" class=" form-control-label">Descripcion</label>
                                            <textarea type="text" name="telefono" placeholder="123456789" class="form-control" value="" required><?=  $fila['descripcion']?></textarea> 
                                        </div>
                                          <div class="form-group">
                                            <label for="cargos" class=" form-control-label">Departamento</label>
                                            <select name="departamento">
                                                <?php
                                                $idpp=$fila['departamento_id'];
                                                   $sqlx = "SELECT * FROM ubdepartamento WHERE id=".$idpp;
                                      $resx = mysqli_query($db,$sqlx);
                                      $filax = mysqli_fetch_array($resx);

                                                  ?>
                                                <option value="<?= $fila['departamento_id']?>"><?= $filax['departamento']?></option>
                                                <?php
                                      mysqli_query($db,"SET NAMES 'utf8'");  
                                      $sqlc = "SELECT * FROM ubdepartamento";
                                      $resc = mysqli_query($db,$sqlc);
                                      while ($filac = mysqli_fetch_array($resc)) {
                                        $dept=$filac['departamento'];

                                    ?>
                                                <option value="<?= $filac['id']?>"><?= $filac['departamento']?></option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="cargos" class=" form-control-label">Ubicacion</label>
                                            <input type="text" name="cargos" placeholder="Ingrese el cargo" class="form-control" value="<?= $fila['ubicacion']?>" required>
                                        </div>
                                          <div class="form-group">
                                            <label for="cargos" class=" form-control-label">Precio</label>
                                            <input type="text" name="precio" placeholder="" class="form-control" value="<?= $fila['desde_precio']?>" required>
                                        </div>
                                         <div class="form-group">
                                            <label for="cargos" class=" form-control-label">N dormitorios</label>
                                            <?php
                                           
                                            $sqlo = "SELECT * FROM respuestas_cualidades WHERE proyecto_id='$id' AND cualidad_id ='1' ";
                                      $reso = mysqli_query($db,$sqlo);
                                      $filao = mysqli_fetch_array($reso);


                                              ?>
                                            <input type="text" name="dormi" placeholder="Ingrese el cargo" class="form-control" value="<?= $filao['respuesta']?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="cargos" class=" form-control-label">Horario de atencion</label>
                                            <?php
                                           
                                            $sqla = "SELECT * FROM respuestas_cualidades WHERE proyecto_id='$id' AND cualidad_id ='6' ";
                                      $resa = mysqli_query($db,$sqla);
                                      $filaa = mysqli_fetch_array($resa);


                                              ?>
                                            <input type="text" name="ate1" placeholder="Ingrese el cargo" class="form-control" value="<?= $filaa['respuesta']?>" required>
                                        </div>
                                        <label  class="checkbox-inline"><input name="llamada" value="1" type="checkbox"  <?php if($fila['aceptar_llamadas']==1){ echo " checked";} ?>>Llamadas</label>
                                         <div class="form-group">
                                       <label   class="checkbox-inline"><input name="whap" value="1" type="checkbox"  <?php if($fila['aceptar_whap']==1){ echo " checked";} ?>>Whatsapp</label>
</div>
                                        <input type="submit" class="btn btn-primary" value="Actualizar">
                                      </form>
                                    </div>
                                </div>                          
                            </div>
                        </div>                            
                        <?php include 'footer.php'; ?>