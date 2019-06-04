<?php
   include('session.php');
   $id = $_GET['id'];
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
                            <a href="nuevometraje.php?proyecto_id=<?=$id ?>"><button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>Nuevo Metraje</button></a>
                        </div>
                    </div>
                    <div style="overflow-x:auto;" class="table-responsive table-responsive-data2">
                        <table class="table table-data2 col-md-12">
                          <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Descripcion</th>
                                    <th scope="col">Url image</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Url Web</th>
                                    <th scope="col">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                  mysqli_query($db,"SET NAMES 'utf8'");  
                                  $sql = "SELECT * FROM metrajes WHERE proyecto_id =".$id;
                                  $res = mysqli_query($db,$sql);

                                  while ($fila = mysqli_fetch_array($res)) {
                                    ?>
                                      <tr class="tr-shadow">
                                        <td scope="row"><?= $fila['id']?></td>
                                        <td><?= $fila['name']?></td>
                                        <td><?= $fila['descripcion']?></td>
                                        <td><?= $fila['url_imagen']?></td>
                                        <td><?= $fila['created_at']?></td>
                                        <td><?= $fila['url_web']?></td>
                                        <td>
                                          <div class="table-data-feature">
                                          
                                          <a href="editarmetraje.php?id=<?=$fila['id']?>" ><button class="item" data-toggle="tooltip" data-placement="top" title="Editar">
                                                <i class="zmdi zmdi-edit"></i>
                                          </button></a>
                                          <a href="#" onClick="if(confirm('Esta seguro de Elimiar el metraje?')) eliminarmetraje(<?=$fila['id']?>);"><button class="item" data-toggle="tooltip" data-placement="top" title="Elimiar">
                                                <i class="zmdi zmdi-delete"></i>
                                            </button></a>
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
            <script>
                function eliminarmetraje(id) {
                    window.location.href = "eliminarmetraje.php?id="+id+"&pid=<?= $id ?>";
                }
            </script>
            <?php include 'footer.php'; ?>