<!DOCTYPE html>

<?php
   include('session.php');
   $hoy = date('d-m-Y');
   $hoy1 = date('Y-m-d');
   $proyecto=$_POST['proyecto'];
   $texfe=$_POST['textfe'];
   $texfe1=$_POST['textfe1'];
?>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">
    <link href="dist/css/tableexport.css" rel="stylesheet" type="text/css">
    <link rel="SHORTCUT ICON" href="https://www.tecnicom.pe/icon-tecnicom.ico">

    <!-- Title Page-->
    <title>Dashboard</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">
    

    <style type="text/css">
        #cc-pament1{
            display: none;
        }
       
    </style>

    <script type="text/javascript">
        

<?php if($texfe1!=""){

    ?>
window.onload =function busqueda(){
mostrar(); }<?php } ?>

       
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

</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="index.php">
                            Panel 
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li class="has-sub">
                            <a href="inicio.php"><i class="fas fa-home"></i>Inicio</a>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-chart-bar"></i>Conversiones</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                               <li>
                                    <a href="llamadas.php">Llamadas</a>
                                </li>
                                <li>
                                    <a href="contactos.php">Formulario</a>
                                </li>
                                <li>
                                    <a href="whapp.php">Whatsapp</a>
                                </li>
                                
                            </ul>
                        </li>
                        
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-desktop"></i>Modificaciones</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                 <li>
                                    <a href="edit.php">Mensajeria</a>
                                </li>
                                <li>
                                    <a href="vendedores.php">Vendedores</a>
                                </li>
                                <li>
                                    <a href="proyectos.php">Proyectos</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <img src="images/icon/logo.png" alt="Cool Admin" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li class="has-sub">
                            <a href="inicio.php"><i class="fas fa-home"></i>Inicio</a>
                        </li>
                        <li class="active has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-tachometer-alt"></i>Conversiones</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="llamadas.php">Llamadas</a>
                                </li>
                                <li>
                                    <a href="contactos.php">Formulario</a>
                                </li>
                                <li>
                                    <a href="whapp.php">Whatsapp</a>
                                </li>
                                
                            </ul>
                        </li>
                        
                        
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-desktop"></i>Modificaciones</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="edit.php">Mensajeria</a>
                                </li>
                                <li>
                                    <a href="vendedores.php">Vendedores</a>
                                </li>
                                <li>
                                    <a href="proyectos.php">Proyectos</a>
                                </li>
                                
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            
                            
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">
                                <h3 class="title-5 m-b-35">Consultas via Llamada</h3>
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
                               <input id="cc-pament" name="textfe" type="date" class="form-control" aria-required="true" aria-invalid="false" placeholder="<?php echo $hoy; ?> " value="<?= isset($_POST['textfe']) ? $_POST['textfe'] : '' ?>" min="09-04-2019" max="<?php echo $hoy; ?> " requerid> 
                                                              
                                </div>
                                
                                <div id="cc-pament1" class="col-lg-3">
                                    
                                <input  name="textfe1" type="date" class="form-control" aria-required="true" aria-invalid="false" value="<?= isset($_POST['textfe1']) ? $_POST['textfe1'] : '' ?>" max="<?php echo $hoy; ?> " requerid>                               
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
                                                <th>Numero del cliente</th>
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
                                                  
                                                   if($proyecto=="todos"){
                                                  
                                                   	$sql="SELECT * FROM llamado_vendedor where created_at between '$confecha' and   '$confecha1'   and tipo_llamado_id = 1";

                                                   }else{





                                                    $sql="SELECT * FROM llamado_vendedor where created_at between '$confecha' and   '$confecha1' and proyecto_id = $id_proyecto  and tipo_llamado_id = 1";
                                                }

                                                }else{
                                                	if($proyecto=="todos"){

                                                   	$sql="SELECT * FROM llamado_vendedor where created_at like '$confecha%' and  tipo_llamado_id = 1";

                                                   }else{

                                                $sql="SELECT * FROM llamado_vendedor where created_at like '$confecha%' and  proyecto_id = $id_proyecto  and tipo_llamado_id = 1";
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
                                                        <td><?php echo utf8_encode($row3['numcliente']);  ?></td>
                                                        <td><?php echo utf8_encode($row2['name']);  ?></td>                                                  
                                                        <td><?php echo utf8_encode($fecha);  ?></td>
                                                        <td><?php echo utf8_encode($hora);  ?></td>
                                                    </tr>
                                            <?php } 
                                            }else{

                                            $sql="SELECT * FROM llamado_vendedor where created_at  like '$hoy1%' and tipo_llamado_id = 1";
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

                                                    $count = mysqli_num_rows($result);
                                          

                                                    ?>
                                                    <tr>      
                                                        <th><?php echo $id_cliente;  ?></th>
                                                        <td><?php echo utf8_encode($row1['name']);  ?></td>
                                                        <td><?php echo utf8_encode($row3['numcliente']);  ?></td> 
                                                        <td><?php echo utf8_encode($row2['name']);  ?></td>                                                 
                                                        <td><?php echo utf8_encode($fecha);  ?></td>
                                                        <td><?php echo utf8_encode($hora);  ?></td>
                                                    </tr>

                                            <?php
                                            $contador=$contador+1;
                                            }} ?>                                            
                                        </tbody>
                                        <h5 style="color:#f28b0e;">Total de contactos via  llamadas:<?php
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
                                    <p>Derechos reservados a Tecnicom soluciones & Datos <a href="http://www.tecnicom.pe>Tecnicom soluciones & Datos"</a>.</p>
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
    fileName: "reporte_llamadas",    //Nombre del archivo 
});
</script>

</body>

</html>
