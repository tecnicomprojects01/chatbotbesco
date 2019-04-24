<!DOCTYPE html>

<?php
   include('session.php');
   $hoy = date('d-m-Y');
   $ho1 = date('Y-m-d');
?>
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
    .fech{
        display:none;
    }
</style>
</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="index.html">
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
                            <a class="js-arrow" href="#">
                                <i class="fas fa-chart-bar"></i>Conversiones</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                               <li>
                                    <a href="llamadas.php">Llamadas</a>
                                </li>
                                <li>
                                    <a href="contactos.php">Contacto</a>
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
                        <li class="active has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-tachometer-alt"></i>Conversiones</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="llamadas.php">Llamadas</a>
                                </li>
                                <li>
                                    <a href="contactos.php">Contacto</a>
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
                                <h3 class="title-5 m-b-35">Consultas via llamada</h3>
                            </div>
                        </div>
                        <div class="row">
                        <form action="" method="post" novalidate="novalidate">
                            <div style="display: none;" id="fech" class="fech form-group">
                                <label for="cc-payment" class="control-label mb-1">Consultar por fecha</label>
                                <div class="row">
                                <div class="col-lg-6">
                                <input id="cc-pament" name="textfe" type="text" class="form-control" aria-required="true" aria-invalid="false" value="<?php echo $hoy; ?> ">
                                
                                </div>
                                <div class="col-lg-6">
                                    <button type="submit" class="btn btn-primary ">Buscar</button>
                                </div>
                                </div>
                            </div>      
                        </form>
                            <div class="col-lg-12">
                                <div class="table-responsive table--no-card m-b-30">
                                    <table style="margin-top:20px; " class="table table-borderless table-striped table-earning">
                                        <thead>
                                            <tr>
                                                <th>ID Cliente</th>
                                                <th>Vendedor</th>
                                                <th>Telefono</th>
                                                <th>Fecha</th>
                                                <th>Hora</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            if( isset($_POST['textfe']) ){
                                                $confecha=date("Y-m-d", strtotime($_POST['textfe']));
                                                             
                                                $sql="SELECT * FROM llamado_vendedor where created_at  like '$confecha%' and tipo_llamado_id = 1";
                                                $result = mysqli_query($db,$sql);
                                                while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                                                    $id_vendedor = $row['vendedor_id'];
                                                    $id_cliente = $row['cliente_id'];
                                                    $fecha=date("d-m-Y", strtotime($row['created_at']));
                                                    $hora=date("h:i:s A", strtotime($row['created_at']));

                                                    $sql1="SELECT * FROM vendedores where  id=$id_vendedor";
                                                    $result1 = mysqli_query($db,$sql1);
                                                    $row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC);

                                                    ?>
                                                    <tr>      
                                                        <th><?php echo $id_cliente;  ?></th>
                                                        <td><?php echo utf8_encode($row1['name']);  ?></td>
                                                        <td><?php echo utf8_encode($row['telefono']);  ?></td>  <td>
                                                        <td><?php echo utf8_encode($row['telefono']);  ?></td>                                                
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

                                                    ?>
                                                    <tr>      
                                                        <th><?php echo $id_cliente;  ?></th>
                                                        <td><?php echo utf8_encode($row1['name']);  ?></td>
                                                        <td><?php echo utf8_encode($row1['telefono']);  ?></td>                                                 
                                                        <td><?php echo utf8_encode($fecha);  ?></td>
                                                        <td><?php echo utf8_encode($hora);  ?></td>
                                                    </tr>
                                            <?php }} ?>                                            
                                        </tbody>
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

</body>

</html>
