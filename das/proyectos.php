<?php
   include('session.php');
   include 'header.php';
?>
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
                                    $class = $fila['status'] == 0 ? 'table-danger' : '';
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
                                    <tr class="tr-shadow <?= $class ?>">
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
                                          <a href="metraje.php?id=<?=$fila['id']?>" ><button class="item" data-toggle="tooltip" data-placement="top" title="Metraje">
                                                <i class="zmdi zmdi-plus"></i>
                                          </button></a>
                                          <a href="areasc.php?id=<?=$fila['id']?>" ><button class="item" data-toggle="tooltip" data-placement="top" title="Areas comunes">
                                                <i class="zmdi zmdi-hotel"></i>
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
            <script src="js/extra.js"></script>                            
            <?php include 'footer.php'; ?>
