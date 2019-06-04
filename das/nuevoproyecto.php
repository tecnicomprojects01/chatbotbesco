<?php
    include('session.php');   
    $name = $_POST['name'];
 
    if ($name!=null) {
        $name = $_POST['name'];
        $slug = strtolower($name);
        $slug = str_replace(' ','-',$slug);
        $telefono = $_POST['telefono'];
        $cargos = $_POST['cargos'];
        $departamento = $_POST['departamento'];
        $inicio = $_POST['ini'];
    
        $dormitorio = $_POST['dormitorios'];
        $dormitorios="".$dormitorio. "Dormitorios";
        $precio = $_POST['precio'];
        $pcuali="Desde: ".$precio.", sujeto a diponibilidad";
        $llamada = $_POST['llamada'];
        $whap = $_POST['whap'];
        
        if($llamada!=1){
            $llamada=0;
        }
        if($whap!=1){
            $whap=0;
        }
        $sql1="INSERT INTO proyectos(name,departamento_id,descripcion,ubicacion,aceptar_llamadas,aceptar_whap,desde_precio,seo,status) VALUES('$name','$departamento','$telefono','$cargos','$llamada','$whap','$precio','$slug','1')";
    
        if (mysqli_query($db,$sql1)) {
            $sql = "SELECT * FROM proyectos ORDER by id DESC LIMIT 1";
            $res = mysqli_query($db,$sql);
            while ($fila = mysqli_fetch_array($res)) {
                $lastid=$fila['id'];
            }
            $sql2="INSERT INTO respuestas_cualidades(proyecto_id,cualidad_id,respuesta,status) VALUES('$lastid','1','$dormitorios','1')";
            $sql3="INSERT INTO respuestas_cualidades(proyecto_id,cualidad_id,respuesta,status) VALUES('$lastid','6','$inicio','1')";
            $sql4="INSERT INTO respuestas_cualidades(proyecto_id,cualidad_id,respuesta,status) VALUES('$lastid','9','$pcuali','1')";
         	if (mysqli_query($db,$sql2)) {
         		if (mysqli_query($db,$sql3)) {
         			if (mysqli_query($db,$sql4)) {
                    ?>
                    <script>
                      alert("Proyecto ingresado");
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
                            <strong>Nuevo  proyecto</strong>
                        </div>
                        
                        
                        <div class="card-body card-block">
                          <form action="" method="POST">
                            <div class="form-group">
                                <label for="name" class=" form-control-label">Nombre</label>
                                <input type="text" name="name" placeholder="Ingrese Nombre del proyecto" class="form-control"  required>
                            </div>
                            <div class="form-group">
                                <label for="telefono" class=" form-control-label">Descripcion</label>
                                <textarea type="text" name="telefono" placeholder="descripcion del proyecto" class="form-control"> </textarea> 
                            </div>
                            <div class="form-group">
                                <label for="cargos" class=" form-control-label">Departamento</label>
                                <select name="departamento">
                                    <?php
                          mysqli_query($db,"SET NAMES 'utf8'");  
                          $sql = "SELECT * FROM ubdepartamento";
                          $res = mysqli_query($db,$sql);
                          while ($fila = mysqli_fetch_array($res)) {
                        ?>
                                    <option value="<?= $fila['id']?>"><?= $fila['departamento']?></option>
                                <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="cargos" class=" form-control-label">Ubicacion</label>
                                <input type="text" name="cargos" placeholder="Ingrese ubicacion" class="form-control"  required>
                            </div>
                              <div class="form-group">
                                <label for="cargos" class=" form-control-label">Precio</label>
                                <input type="text" name="precio" class="form-control" value="S./" required>
                            </div>
                            <div class="form-group">
                                <label for="cargos" class=" form-control-label">Horario de antecion</label>
                                <input placeholder="El Horario de Atención es de Lunes a Domingo de 10:00 Am a 5:00 Pm" type="text" name="ini" class="form-control" value="" required>
                            </div>
                          
                            <div class="form-group">
                                <label for="cargos" class=" form-control-label"> Numero de   dormitorios</label>
                                <input type="number" name="dormitorios" class="form-control" value="" required>
                            </div> 
                            <label  class="checkbox-inline"><input name="llamada" value="1" type="checkbox"  >Llamadas</label>
                             <div class="form-group">
                           <label   class="checkbox-inline"><input name="whap" value="1" type="checkbox"  >Whatsapp</label>
                            </div>
                            <input type="submit" class="btn btn-primary" value="Actualizar">
                          </form>
                        </div>
                    </div>                          
                </div>
            </div>                            
            <?php include 'footer.php'; ?>