<?php
  include('session.php');
  $id = $_GET['id'];
  mysqli_query($db,"SET NAMES 'utf8'");  
  $sql = "SELECT * FROM vendedores WHERE id =".$id;
  $res = mysqli_query($db,$sql);
  $fila = mysqli_fetch_array($res);
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
                                <div class="overview-wrap">
                                    <h2 class="title-1">Proyectos de <?= $fila['name'] ?></h2>
                                </div>
                            </div>
                        </div>                      
                        <div class="row m-t-25">
                            <div class="col-md-12">
                                  <div class="card">
                                    <div class="card-header">
                                        <strong>Proyectos actuales</strong>
                                    </div>
                                    <div class="card-body card-block">
                                      <?php
                                        $sql1 = "SELECT * FROM proyecto_vendedor AS pv JOIN proyectos AS p ON pv.proyecto_id = p.id WHERE vendedor_id =".$id;
                                        $res1 = mysqli_query($db,$sql1);
                                        while ($fila1 = mysqli_fetch_array($res1)) {
                                          ?>
                                            <form action="actualizarproyectov.php?id=<?= $fila1[0] ?>" method="POST">
                                              <div class="row form-group">
                                              <div class="col">
                                              <select name="proyecto" class="form-control form-group">
                                              <?php
                                                $sql2 = "SELECT * FROM proyectos";
                                                $res2 = mysqli_query($db,$sql2);
                                                while ($fila2 = mysqli_fetch_array($res2)) {
                                                ?>
                                                  <option value="<?= $fila2['id']?>" <?= $fila1['proyecto_id'] == $fila2['id'] ? 'selected' : '' ?>><?= $fila2['name']?></option>
                                                <?php
                                                }
                                              ?>
                                              </select>
                                              </div>
                                              <div class="col">
                                                <input type="hidden" value="<?= $id?>" name="vendedor_id">
                                                <input type="hidden" value="<?= $fila1[0] ?>" name="idpv">
                                                <input type="submit" value="Actualizar" class="btn btn-primary form-group" id="form-actualizar">
                                                <input type="submit" value="Eliminar" class="btn btn-danger form-group" id="form-elimiar">
                                              </div>
                                              </div>
                                            </form>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Asignar nuevo proyecto</strong>
                                    </div>
                                    <div class="card-body card-block">
                                      <form action="nuevoproyectov.php" method="POST" name="<?= $nombrecampo ?>" id="<?= $nombrecampo ?>">
                                        <div class="row form-group">
                                          <div class="col">
                                            <select name="proyecto" class="form-control form-group">
                                            <?php
                                            $sql2 = "SELECT * FROM proyectos";
                                            $res2 = mysqli_query($db,$sql2);
                                            while ($fila2 = mysqli_fetch_array($res2)) {
                                            ?>
                                              <option value="<?= $fila2['id']?>" <?= $fila1['proyecto_id'] == $fila2['id'] ? 'selected' : '' ?>><?= $fila2['name']?></option>
                                            <?php
                                            }
                                            ?>
                                            </select>
                                          </div>
                                          <div class="col">
                                            <input type="hidden" value="<?= $id?>" name="vendedor_id">
                                            <input type="hidden" value="<?= $fila1['id']?>" name="idpv">
                                            <input type="submit" value="Asignar" class="btn btn-success form-group">
                                          </div>
                                        </div>
                                      </form>
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
    <script src="js/extra.js"></script>
</body>
</html>