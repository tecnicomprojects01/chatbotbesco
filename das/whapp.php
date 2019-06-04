<?php
   include('session.php');
   $hoy = date('d-m-Y');
   $hoy1 = date('Y-m-d');
   $proyecto=$_POST['proyecto'];
   $texfe=$_POST['textfe'];
   $texfe1=$_POST['textfe1'];
   include 'header.php';
?>
<script type="text/javascript">
    <?php if($texfe1!=""){?>
    window.onload =function busqueda(){
        mostrar(); 
    }<?php } ?>
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
            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">
                                <h3 class="title-5 m-b-35">Consultas Via Whatsapp</h3>
                            </div>
                        </div>
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
                                        $s = $_POST['proyecto'] ==  $rowx['id'] ? 'selected' : '';
                                    ?>

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
                            <div class="col-lg-12">
                                <div class="table-responsive table--no-card m-b-30">
                                    <table style="margin-top:20px; " class="table table-borderless table-striped table-earning">
                                        <button style="margin-bottom: 8px;" class="btn btn-primary" onclick="clicc()">Exportar xlsx</button>
                                        <thead>
                                            <tr>
                                                <th>ID Cliente</th>
                                                <th>Vendedor</th>
                                                
                                                <th>Proyecto</th>
                                                <th>Fecha</th>
                                                <th>Hora</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            
                                            $contador=0;
                                            if( isset($_POST['textfe']) || isset($_POST['proyecto'])){
                                                $confecha= $_POST['textfe'] == "" ? "" : date("Y-m-d", strtotime($_POST['textfe']));
                                                $id_proyecto = $_POST['proyecto'];
                                                
                                                if($_POST['textfe1']!= ""){
                                                    
                                                    $confecha1=$_POST['textfe1'];
                                                  
                                                   if($id_proyecto=="todos"){
                                                    $sql="SELECT * FROM llamado_vendedor where created_at between '$confecha' and   '$confecha1'   and tipo_llamado_id = 2";

                                                   }else{





                                                    $sql="SELECT * FROM llamado_vendedor where created_at between '$confecha' and   '$confecha1' and proyecto_id = $id_proyecto  and tipo_llamado_id = 2";
                                                }

                                                }else{
                                                    if($id_proyecto=="todos"){
                                                    $sql="SELECT * FROM llamado_vendedor where created_at like '$confecha%'   and tipo_llamado_id = 2";

                                                   }else{

                                                $sql="SELECT * FROM llamado_vendedor where created_at like '$confecha%' and  proyecto_id = $id_proyecto  and tipo_llamado_id = 2";
                                            }
                                            }

                                                $result = mysqli_query($db,$sql);
                                                while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                                                    $id_vendedor = $row['vendedor_id'];
                                                    $id_cliente = $row['cliente_id'];
                                                    $fecha=date("d-m-Y", strtotime($row['created_at']));
                                                    $hora=date("h:i:s A", strtotime($row['created_at']));

                                                    $sql1="SELECT * FROM vendedores where  id=$id_vendedor";
                                                    $result1 = mysqli_query($db,$sql1);
                                                    $row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC);

                                                    $id_proyecto = $row['proyecto_id'];

                                                    $sql2="SELECT name FROM proyectos where  id=$id_proyecto";
                                                    $result2 = mysqli_query($db,$sql2);
                                                    $row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);

                                                    $sql3="SELECT numcliente FROM llamadas where  cliente_id=$id_cliente";
                                                    $result3 = mysqli_query($db,$sql3);
                                                    $row3 = mysqli_fetch_array($result3,MYSQLI_ASSOC);
                                                    $contador=$contador+1;

                                                    ?>
                                                    <tr>      
                                                        <th><?php echo $id_cliente;  ?></th>
                                                        <td><?php echo utf8_encode($row1['name']);  ?></td>
                                                        
                                                        <td><?php echo utf8_encode($row2['name']);  ?></td>                                                  
                                                        <td><?php echo utf8_encode($fecha);  ?></td>
                                                        <td><?php echo utf8_encode($hora);  ?></td>
                                                    </tr>
                                            <?php } 
                                            }else{

                                            $sql="SELECT * FROM llamado_vendedor where created_at  like '$hoy1%' and tipo_llamado_id = 2";
                                            $result = mysqli_query($db,$sql);      
                                            while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                                                $id_vendedor = $row['vendedor_id'];
                                                    $id_cliente = $row['cliente_id'];
                                                    $fecha=date("d-m-Y", strtotime($row['created_at']));
                                                    $hora=date("h:i:s A", strtotime($row['created_at']));

                                                    $sql1="SELECT * FROM vendedores where  id=$id_vendedor";
                                                    $result1 = mysqli_query($db,$sql1);
                                                    $row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC);

                                                    $id_proyecto = $row['proyecto_id'];

                                                    $sql2="SELECT name FROM proyectos where  id=$id_proyecto";
                                                    $result2 = mysqli_query($db,$sql2);
                                                    $row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);

                                                    $sql3="SELECT numcliente FROM llamadas where  cliente_id=$id_cliente";
                                                    $result3 = mysqli_query($db,$sql3);
                                                    $row3 = mysqli_fetch_array($result3,MYSQLI_ASSOC);
                                                    $contador=$contador+1;

                                                    ?>
                                                    <tr>      
                                                        <th><?php echo $id_cliente;  ?></th>
                                                        <td><?php echo utf8_encode($row1['name']);  ?></td>
                                                        
                                                        <td><?php echo utf8_encode($row2['name']);  ?></td>                                                 
                                                        <td><?php echo utf8_encode($fecha);  ?></td>
                                                        <td><?php echo utf8_encode($hora);  ?></td>
                                                    </tr>
                                            <?php }} ?>                                            
                                        </tbody>
                                        <h5 style="color:#f28b0e;">Total de contactos via whatsapp:<?php
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

    <!-- Main JS-->
    <script src="js/main.js"></script>
    <script src="FileSaver.min.js"></script>
<script src="Blob.min.js"></script>
<script src="xls.core.min.js"></script>
<script src="dist/js/tableexport.js"></script>
<script>
$("table").tableExport({
    formats: ["xlsx"], //Tipo de archivos a exportar ("xlsx","txt", "csv", "xls")
    position: 'button',  // Posicion que se muestran los botones puedes ser: (top, bottom)
    bootstrap: false,//Usar lo estilos de css de bootstrap para los botones (true, false)
    fileName: "reporte_whatsapp",    //Nombre del archivo 
});
</script>

</body>

</html>