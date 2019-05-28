<?php
   include('session.php');
   
     $name = $_POST['name'];
 
   if ($name!=null) {

     $name = $_POST['name'];
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
        echo "$departamento";
        
        if($llamada!=1){
            $llamada=0;


        }
          if($whap!=1){
            $whap=0;


        }
        $sql1="INSERT INTO proyectos(name,departamento_id,descripcion,ubicacion,aceptar_llamadas,aceptar_whap,desde_precio,status) VALUES('$name','$departamento','$telefono','$cargos','$llamada','$whap','$precio','1')";

     
     if (mysqli_query($db,$sql1)) {
     	   $sql = "SELECT *
FROM proyectos
ORDER by id DESC
LIMIT 1";
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
          alert("Proyecto Actualizado");
          window.location = 'proyectos.php';
        </script>
        <?php

     }
 }
}
}
  }

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
                                  <div class="card">
                                    <div class="card-header">
                                        <strong>Editar proyecto</strong>
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