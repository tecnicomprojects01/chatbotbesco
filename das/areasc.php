<?php
   include('session.php');
   include('header.php');
   $id = $_GET['id'];
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
                                <a href="nuevaarea.php?proyecto_id=<?=$id ?>"><button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>Nueva Area comun</button></a>
                            </div>
                        </div>
                        <div style="overflow-x:auto;" class="table-responsive table-responsive-data2">
                            <table class="table table-data2 col-md-12">
                              <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Descripcion</th>
                                       
                                        <th scope="col">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                      mysqli_query($db,"SET NAMES 'utf8'");  
                                      $sql = "SELECT * FROM areas WHERE proyecto_id =".$id;
                                      $res = mysqli_query($db,$sql);

                                      while ($fila = mysqli_fetch_array($res)) {
                                        ?>
                                          <tr class="tr-shadow">
                                            <td scope="row"><?= $fila['id']?></td>
                                            <td><?= $fila['name']?></td>
                                            <td><?= $fila['descripcion']?></td>                                       
                                           
                                            
                                            <td>
                                              <div class="table-data-feature">
                                              
                                              <a href="editararea.php?id=<?=$fila['id']?>" ><button class="item" data-toggle="tooltip" data-placement="top" title="Editar">
                                                    <i class="zmdi zmdi-edit"></i>
                                              </button></a>
                                              <?php if($fila['status'] == 0 ): ?>
                                              <a href="#" onClick="if(confirm('Esta seguro de habilitar el metraje?')) eliminararea(<?=$fila['id']?>,1);"><button class="item" data-toggle="tooltip" data-placement="top" title="Habilitar">
                                                    <i class="zmdi zmdi-check"></i>
                                                </button></a>
                                              <?php else :?>
                                               <a href="#" onClick="if(confirm('Esta seguro de eliminar area?')) eliminararea(<?=$fila['id']?>);"><button class="item" data-toggle="tooltip" data-placement="top" title="Deshabilitar">
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
                        <script type="text/javascript">
                            function eliminararea(id) {
                                window.location.href = "eliminararea.php?id="+id;
                            }
                        </script>
                    </div>
                </div>                            
                <?php include('footer.php'); ?>