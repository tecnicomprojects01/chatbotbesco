<?php
   include('session.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Dashboard</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link rel="SHORTCUT ICON" href="https://www.tecnicom.pe/icon-tecnicom.ico">
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
                        <li class="has-sub">
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
                        
                        
                        <li class="active has-sub">
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
                            <button onClick="window.location.href = 'logout.php'" type="button" class="btn btn btn-warning">Salir</button>
                            
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
                            <div class="col-md-12">
                                <!-- DATA TABLE -->
                                <h3 class="title-5 m-b-35">Proyectos</h3>
                                <div class="table-data__tool">
                                    <div class="table-data__tool-right">
                                        <a href="nuevoproyecto.php"><button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                            <i class="zmdi zmdi-plus"></i>Nuevo Proyecto</button></a>
                                    </div>
                                </div>
                                <div style="overflow-x:auto;" class="table-responsive table-responsive-data2">
                                    <table class="table table-data2 col-md-12">
                                      <thead>
                                                                                            <tr>
                                                  <th scope="col">#</th>
                                                  <th scope="col">Nombre</th>
                                                  <th scope="col">Descripcion</th>
                                                
                                                  <th scope="col">Ubicacion</th>
                                                  <th scope="col">Banco</th>
                                                 
                                                   <th scope="col">Precio</th>
                                                    <th scope="col">Llamadas</th>
                                                     <th scope="col">Whatsapp</th>
                                                  <th scope="col">Opciones</th>
                                                  
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                              mysqli_query($db,"SET NAMES 'utf8'");  
                                              $sql = "SELECT * FROM proyectos";
                                              $res = mysqli_query($db,$sql);

                                              while ($fila = mysqli_fetch_array($res)) {
                                                $class = $fila['habilitado'] == 0 ? 'table-danger' : '';
                                                if($fila['aceptar_llamadas']==1){
                                                    $llamadas="Si";
                                                }else{
                                                    $llamadas="No";
                                                }
                                                  if($fila['aceptar_whap']==1){
                                                    $whapp="Si";
                                                }else{
                                                    $whapp="No";
                                                }
                                                ?>
                                                  <tr class="tr-shadow">
                                                    <td scope="row"><?= $fila['id']?></td>
                                                    <td><?= $fila['name']?></td>
                                                    <td><?= $fila['descripcion']?></td>


                                                    <td><?= $fila['ubicacion']?></td>
                                                    <td><?= $fila['banco']?></td>


    <td><?= $fila['desde_precio']?></td>
                                                         <td><?= $llamadas?></td>
                                                         <td><?= $whapp?></td>
                                                
                                                    <td>
                                                      <div class="table-data-feature">
                                                      
                                                      <a href="editarproyecto.php?id=<?=$fila['id']?>" ><button class="item" data-toggle="tooltip" data-placement="top" title="Editar">
                                                            <i class="zmdi zmdi-edit"></i>
                                                      </button></a>
                                                      <?php if($fila['status'] == 0 ): ?>
                                                      <a href="#" onClick="if(confirm('Esta seguro de habilitar el proyecto?')) eliminarproyecto(<?=$fila['id']?>,1);"><button class="item" data-toggle="tooltip" data-placement="top" title="Habilitar">
                                                            <i class="zmdi zmdi-check"></i>
                                                        </button></a>
                                                      <?php else :?>
                                                       <a href="#" onClick="if(confirm('Esta seguro de Deshabilitar el proyecto?')) eliminarproyecto(<?=$fila['id']?>,0);"><button class="item" data-toggle="tooltip" data-placement="top" title="Deshabilitar">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button></a>
                                                      <?php endif;?>
                                                      </div>
                                                    </td>
                                                  </tr>         
                                                <?php
                                              }
                                            ?>                                            
                                        </tbody>
                                    </table>
                                </div>
                                <!-- END DATA TABLE -->
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
        </div>

    </div>
    <script type="text/javascript">
        function eliminarproyecto(vid,opc){
    $.ajax({
        type: 'POST',
        url: 'eleminarproyecto.php',
        data: {id: vid, op: opc},

        success: function (data) {
          var json = JSON.parse(data);
          alert(json.mensaje);

        },
        error: function () {
          console.log('Ocurrio un error por favor intente nuevamente');
        }
    })
  return false;
   location.reload();
}
    </script>

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
    <script src="js/extra.js"></script>
</body>
</html>
