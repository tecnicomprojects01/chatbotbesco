<?php
   include('session.php');
   include('header.php');
?>
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <h3 class="title-5 m-b-35">Mensajes de Bienvenida</h3>
                    <div class="table-data__tool">
                        
                    </div>
                    <div style="overflow-x:auto;" class="table-responsive table-responsive-data2">
                        <table class="table table-data2 col-md-12">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Mensaje</th>
                                    <th scope="col">Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                  mysqli_query($db,"SET NAMES 'utf8'");  
                                  $sql = "SELECT * FROM mensaje_bienvenida";
                                  $res = mysqli_query($db,$sql);
                                  while ($fila = mysqli_fetch_array($res)) {                                               
                                    ?>
                                      <tr class="tr-shadow">
                                        <td scope="row"><?= $fila['id_msj']?></td>
                                        <td><?= $fila['mensaje']?></td>
                                        <td><?= $fila['fecha']?></td>
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
            <?php include 'footer.php'; ?>