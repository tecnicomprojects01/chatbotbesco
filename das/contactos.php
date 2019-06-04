<!DOCTYPE html>

<?php
   include('session.php');

  $sql = "SELECT * FROM usuarios WHERE usuario = '$login_session'";
  $result = mysqli_query($db,$sql);
  $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
  $nombre = $row['nombre'];
  $count = mysqli_num_rows($result);
  $hoy=date("d-m-Y");
  $hoy1=date("Y-m-d");
  $proyecto=$_POST['proyecto'];
  $texfe=$_POST['textfe'];
  $texfe1=$_POST['textfe1'];
  include 'header.php';
?>
        <!-- MAIN CONTENT-->
        <script type="text/javascript">
            <?php if($texfe1!=""){
            ?>
            window.onload =function busqueda(){
              mostrar(); 
            }
            <?php } ?>
          
            function mostrar(){
              document.getElementById("cc-pament1").style.display = 'block';
              var elemento = document.getElementById("colum");
              elemento.className = "col-lg-3";
            }
            function clicc(){
              $(".button-default").click(); 
                document.getElementsByClassName("button-default").click();
            }
        </script>
        <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="row">
                      <div  class="col-lg-2">
                        <button  id="fech1" type="button" class="btn btn-primary " onclick="mostrar()">Filtrar por rango de fechas</button>  
                      </div>
                    <form style="margin-top:50px;" action="" method="post" novalidate="novalidate">
                      <div  class="form-group col-lg-11">
                        <label for="cc-payment" class="control-label mb-1">Consultar por fecha</label>
                        <div class="row">
                        <div id="colum" class="col-lg-6">
                          <input id="cc-pament" name="textfe" type="date" class="form-control" aria-required="true" aria-invalid="false" placeholder="<?php echo $hoy; ?> " value="<?= isset($_POST['textfe']) ? $_POST['textfe'] : '' ?>">                                 
                        </div>
                        <div id="cc-pament1" class="col-lg-3">
                          <input  name="textfe1" type="date" class="form-control" aria-required="true" aria-invalid="false" value="<?= isset($_POST['textfe1']) ? $_POST['textfe1'] : '' ?>">                               
                        </div>
                        <div class="col-6 col-md-5">
                          <select name="proyecto" id="select" class="form-control">
                            <option value="todos">Todos</option>
                            <?php                               
                              $sqlx="SELECT * FROM proyectos";
                              $resultx = mysqli_query($db,$sqlx);
                              while($rowx = mysqli_fetch_array($resultx,MYSQLI_ASSOC)){
                                if (isset($_POST['proyecto'])) {
                                    $s = $_POST['proyecto'] ==  $rowx['id'] ? 'selected' : '';?>
                                    <option value="<?= $rowx['id']; ?>" <?= $s ?>><?php echo utf8_encode($rowx['name']);  ?></option>
                                <?php  }else{ ?> ?>
                                    <option value="<?= $rowx['id']; ?>"><?php echo utf8_encode($rowx['name']);  ?></option>
                                <?php 
                                } }
                                ?>                                     
                          </select>
                        </div>
                        <div  class="col-lg-1">
                          <button   type="submit" class="btn btn-primary " >Buscar</button>
                        </div>
                        </div>
                    </div>
                  </form>
                  </div>
                  <div class="col-lg-12">
                    <div class="table-responsive table--no-card m-b-30">
                      <table style="margin-top:20px; " class="table table-borderless table-striped table-earning">
                        <button style="margin-bottom: 8px;" class="btn btn-primary" onclick="clicc()">Exportar xlsx</button>
                        <thead>
                          <tr>
                            <th>Nombre</th>
                            <th>Apellido</th>                                      
                            <th >Email</th>
                            <th>Dni</th>
                            <th >Telefono</th>      
                            <th >Fecha</th>
                            <th >Hora</th>
                            <th>Proyecto</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $contador=0;
                        if(isset($_POST['textfe'])){
                          $confecha= $_POST['textfe'] == "" ? "" : date("Y-m-d", strtotime($_POST['textfe']));
                          $proyecto = $_POST['proyecto'];    
                          if($_POST['textfe1']!= ""){
                            $confecha1=$_POST['textfe1'];
                            if ($proyecto=="todos"){
                              $sql="SELECT * FROM datos_contacto where date  between '$confecha ' and  '$confecha1'";
                            }else{                                              
                              $sql="SELECT * FROM datos_contacto where date  between '$confecha ' and  '$confecha1'and id_proyecto='$proyecto'";
                            }
                          }else{
                            if ($proyecto=="todos") {
                              $sql="SELECT * FROM datos_contacto where date  like '$confecha%'";
                            }else{
                              $sql="SELECT * FROM datos_contacto where date  like '$confecha%' and id_proyecto='$proyecto'";
                            }            
                          }     
                          $result = mysqli_query($db,$sql);
                          while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                            $idproyecto=$row['id_proyecto'];
                            $sql1="SELECT * FROM proyectos where  id='$idproyecto'";
                            $result1 = mysqli_query($db,$sql1);
                            $row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC);
                            $fecha=date("d-m-Y", strtotime($row['date']));
                            $hora=date("h:i:s A", strtotime($row['date']));
                            $contador=$contador+1;
                            ?>
                            <tr>      
                              <th><?php echo utf8_encode($row['nombre']);  ?></th>
                              <th><?php echo utf8_encode($row['apellido']);  ?></th>
                              <td><?php echo utf8_encode($row['email']);  ?></td>
                              <td><?php echo utf8_encode($row['dni']);?></td>
                              <td><?php echo utf8_encode($row['telefono']);  ?></td>
                              <td><?php echo utf8_encode($fecha);  ?></td>
                              <td><?php echo utf8_encode($hora);  ?></td>
                              <td><?php echo utf8_encode($row1['name']);  ?></td>
                            </tr>
                          <?php 
                          } 
                        }else{ 
                          $sql="SELECT * FROM datos_contacto where date   like '$hoy1%' ";
                          $result = mysqli_query($db,$sql);
                          while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                            $idproyecto=$row['id_proyecto'];
                            $sql1="SELECT * FROM proyectos where  id='$idproyecto'";          
                            $result1 = mysqli_query($db,$sql1);
                            $row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC);
                            $fecha=date("d-m-Y", strtotime($row['date']));
                            $hora=date("h:i:s A", strtotime($row['date']));
                            $contador=$contador+1;
                          ?>
                            <tr>
                              <th><?php echo utf8_encode($row['nombre']);  ?></th>
                              <th><?php echo utf8_encode($row['apellido']);  ?></th>
                              <td><?php echo utf8_encode($row['email']);  ?></td>
                              <td><?php echo utf8_encode($row['dni']);?></td>
                              <td><?php echo utf8_encode($row['telefono']);  ?></td>
                              <td><?php echo utf8_encode($fecha);  ?></td>
                              <td><?php echo utf8_encode($hora);  ?></td>
                              <th ><?php echo utf8_encode($row1['name']); ?> </th>
                            </tr>
                          <?php 
                          }
                        }?>                                            
                        </tbody>
                        <h5 style="color:#f28b0e;">Total de contactos formulario:<?php
                          echo "<span style='margin-left:4px'>$contador</span>"; ?></h5>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="copyright">
                    <p>Derechos reservados a Tecnicom soluciones & Datos <a href="http://www.tecnicom.pe">Tecnicom soluciones & Datos</a>.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- END MAIN CONTENT-->
        <!-- END PAGE CONTAINER-->
    </div>
</div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>
    <script src="FileSaver.min.js"></script>
    <script src="Blob.min.js"></script>
    <script src="xls.core.min.js"></script>
    <script src="dist/js/tableexport.js"></script>
    <script>
      $("table").tableExport({
        formats: ["xlsx"], //Tipo de archivos a exportar ("xlsx","txt", "csv", "xls")
        position: 'button',  // Posicion que se muestran los botones puedes ser: (top, bottom)
        bootstrap: false,//Usar lo estilos de css de bootstrap para los botones (true, false)
        fileName: "reporte_contacto",    //Nombre del archivo 
      });
    </script>
    <!-- Main JS-->
    <script src="js/main.js"></script>
</body>
</html>