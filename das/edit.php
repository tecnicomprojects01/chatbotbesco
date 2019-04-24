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
                                    <h2 class="title-1">Mensajes del BOT</h2>
                                </div>
                            </div>
                      </div>
                        <div class="row m-t-25">
                            <div class="col-md-12">
                                  <div class="card">
                                    <div class="card-header">
                                        <strong>Mensaje de bienvenida</strong>
                                    </div>
                                      <?php 
                                        //Consulta mensaje de bienvenida
                                        
                                        $sql = "SELECT * FROM mensaje_bienvenida";
                                        $res = mysqli_query($db,$sql);

                                        while ($fila = mysqli_fetch_array($res)) {
                                           $msj = $fila['mensaje'];
                                        }
                                      ?>
                                      <div class="card-body card-block">
                                      <form action="" method="POST" name="ignorar">
                                        <div class="form-group">
                                          <div class="col">
                                              <label for="mensaje">Mensaje: </label>
                                          </div>
                                          <div class="col">
                                              <textarea class="form-control" name="mensaje" rows="3"><?= $msj ?></textarea>
                                          </div>
                                          <div class="col">
                                              <input type="submit" value="Actualizar" class="btn btn-primary">
                                          </div>
                                        </div>
                                      </form>
                                      </div>
                                  </div>
                                  <div class="card">
                                    <div class="card-header">
                                      <strong>Proyectos</strong>
                                    </div>
                                    <div class="card-body card-block">
                                      <div class="alert alert-primary" role="alert">
                                        Los precios que se detallan a continuacion son precios referenciales, se deben especificar los precios Desde, Sin descuentos, sin promociones
                                      </div>
                                      <br>
                                  <?php 
                                      //Consulta precios de proyectos
                                      $sql = "SELECT desde_precio FROM proyectos";
                                      $res = mysqli_query($db,$sql);
                                      while ($fila = mysqli_fetch_array($res)) {
                                         $arreglo[] = $fila[0];
                                      }
                                    ?>
                                    <form action="" method="POST" name="ignorar">
                                      <div class="row form-group">
                                      <div class="col">
                                          <label for="altos_rimac">Altos Rimac</label>
                                      </div>
                                      <div class="col">
                                          <input type="text" class="form-control" name="altos_rimac" value="<?= $arreglo[0]?>">
                                        </div>
                                      <div class="col">
                                          <input type="submit" value="Actualizar" class="btn btn-primary">
                                      </div>
                                    </div>
                                    </form>
                                                                 
                                    <form action="" method="POST">
                                      <div class="row form-group">
                                      <div class="col">
                                            <label for="nogales">Nogales</label>
                                          </div>
                                      <div class="col">
                                            <input type="text" class="form-control" name="nogales" value="<?= $arreglo[1]?>">
                                          </div>
                                      <div class="col">
                                            <input type="submit" value="Actualizar" class="btn btn-primary">
                                          </div>
                                      </div>
                                    </form>
                                  
                                  
                                    <form action="" method="POST">
                                      <div class="row form-group">
                                      <div class="col">
                                            <label for="las_palmas">Las Palmas</label>
                                          </div>
                                      <div class="col">
                                            <input type="text" class="form-control" name="las_palmas" value="<?= $arreglo[2]?>">
                                          </div>
                                      <div class="col">
                                            <input type="submit" value="Actualizar" class="btn btn-primary">
                                          </div>
                                      </div>
                                    </form>
                                  
                                  
                                    <form action="" method="POST">
                                      <div class="row form-group">
                                      <div class="col">
                                            <label for="altaluz">Altaluz</label>
                                          </div>
                                      <div class="col">
                                            <input type="text" class="form-control" name="altaluz" value="<?= $arreglo[3]?>">
                                          </div>
                                      <div class="col">
                                            <input type="submit" value="Actualizar" class="btn btn-primary">
                                          </div>
                                      </div>
                                    </form>
                                  
                                  
                                    <form action="" method="POST">
                                      <div class="row form-group">
                                      <div class="col">
                                            <label for="santa_ana">Santa Ana</label>
                                          </div>
                                      <div class="col">
                                            <input type="text" class="form-control" name="santa_ana" value="<?= $arreglo[4]?>">
                                          </div>
                                      <div class="col">
                                            <input type="submit" value="Actualizar" class="btn btn-primary">
                                          </div>
                                      </div>
                                    </form>
                                  
                                  
                                    <form action="" method="POST">
                                      <div class="row form-group">
                                      <div class="col">
                                            <label for="centrika">Centrika</label>
                                          </div>
                                      <div class="col">
                                            <input type="text" class="form-control" name="centrika" value="<?= $arreglo[5]?>">
                                          </div>
                                      <div class="col">
                                            <input type="submit" value="Actualizar" class="btn btn-primary">
                                          </div>
                                      </div>
                                    </form>
                                  
                                  
                                    <form action="" method="POST">
                                      <div class="row form-group">
                                      <div class="col">
                                            <label for="pradera_rimac">Pradera del Rimac</label>
                                          </div>
                                      <div class="col">
                                            <input type="text" class="form-control" name="pradera_rimac" value="<?= $arreglo[6]?>">
                                          </div>
                                      <div class="col">
                                            <input type="submit" value="Actualizar" class="btn btn-primary">
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
                                    <p>Derechos reservados a Tecnicom soluciones & Datos <a href="http://www.tecnicom.pe>Tecnicom soluciones & Datos"></a>.</p>
                                </div>
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

</body>
</html>

<?php
  if (isset($_POST['mensaje'])) {
     $msj = $_POST['mensaje'];
     $sql1 = "UPDATE mensaje_bienvenida SET
          mensaje = '$msj'
          WHERE id_msj = 1";
     
     if (mysqli_query($db,$sql1)) {
        ?>
        <script>
          alert("Mensaje de bienvenida Actualizado");
          window.location = 'edit.php';
        </script>
        <?php

     }
  } 
  if (isset($_POST['altos_rimac'])) {
     $precio = $_POST['altos_rimac'];
     $sql1 = "UPDATE proyectos SET
          desde_precio = '$precio'
          WHERE id = 1";
     
     if (mysqli_query($db,$sql1)) {
        ?>
        <script>
          alert("Altos Rimac Actualizado");
          window.location = 'edit.php';
        </script>
        <?php

     }
  }
  if (isset($_POST['nogales'])) {
     $precio = $_POST['nogales'];
     $sql1 = "UPDATE proyectos SET
          desde_precio = '$precio'
          WHERE id = 2";
     
     if (mysqli_query($db,$sql1)) {
        ?>
        <script>
          alert("Nogales Actualizado");
          window.location = 'edit.php';
        </script>
        <?php

     }
  }
  if (isset($_POST['las_palmas'])) {
     $precio = $_POST['las_palmas'];
     $sql1 = "UPDATE proyectos SET
          desde_precio = '$precio'
          WHERE id = 3";
     
     if (mysqli_query($db,$sql1)) {
        ?>
        <script>
          alert("Las Palmas Actualizado");
          window.location = 'edit.php';
        </script>
        <?php

     }
  }
  if (isset($_POST['altaluz'])) {
     $precio = $_POST['altaluz'];
     $sql1 = "UPDATE proyectos SET
          desde_precio = '$precio'
          WHERE id = 4";
     
     if (mysqli_query($db,$sql1)) {
        ?>
        <script>
          alert("Altaluz Actualizado");
          window.location = 'edit.php';
        </script>
        <?php

     }
  }
  if (isset($_POST['santa_ana'])) {
     $precio = $_POST['santa_ana'];
     $sql1 = "UPDATE proyectos SET
          desde_precio = '$precio'
          WHERE id = 5";
     
     if (mysqli_query($db,$sql1)) {
        ?>
        <script>
          alert("Santa Ana Actualizado");
          window.location = 'edit.php';
        </script>
        <?php

     }
  }
  if (isset($_POST['centrika'])) {
     $precio = $_POST['centrika'];
     $sql1 = "UPDATE proyectos SET
          desde_precio = '$precio'
          WHERE id = 6";
     
     if (mysqli_query($db,$sql1)) {
        ?>
        <script>
          alert("Centrika Actualizado");
          window.location = 'edit.php';
        </script>
        <?php

     }
  }
  if (isset($_POST['pradera_rimac'])) {
     $precio = $_POST['pradera_rimac'];
     $sql1 = "UPDATE proyectos SET
          desde_precio = '$precio'
          WHERE id = 7";
     
     if (mysqli_query($db,$sql1)) {
        ?>
        <script>
          alert("Pradera del Rimac Actualizado");
          window.location = 'edit.php';
        </script>
        <?php

     }
  }
?>