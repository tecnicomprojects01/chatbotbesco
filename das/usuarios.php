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
                        <h3 class="title-5 m-b-35">Usuarios</h3>
                        <div class="table-data__tool">
                            <div class="table-data__tool-right">
                                <a href="nuevousuario.php"><button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>Nuevo Usuario</button></a>
                            </div>
                        </div>
                        <div style="overflow-x:auto;" class="table-responsive table-responsive-data2">
                            <table class="table table-data2 col-md-12">
                              <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Usuario</th>
                                        <th scope="col">Password</th>
                                        <th scope="col">Conversiones</th>
                                        <th scope="col">Modificaciones</th>
                                        <th scope="col">Usuarios</th>
                                        <th scope="col">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                      mysqli_query($db,"SET NAMES 'utf8'");  
                                      $sql = "SELECT * FROM usuarios";
                                      $res = mysqli_query($db,$sql);

                                      while ($fila = mysqli_fetch_array($res)) {
                                        ?>
                                          <tr class="tr-shadow">
                                            <td scope="row"><?= $fila['id']?></td>
                                            <td><?= $fila['nombre']?></td>
                                            <td><?= $fila['usuario']?></td>
                                             <td><?= $fila['password']?></td>
                                            <td align="center"><?= $fila['conversiones'] == 1 ? "<i class='zmdi zmdi-check' style='color:green'></i>" : "<i class='zmdi zmdi-close' style='color:grey'></i>" ?></td>
                                            <td align="center"><?= $fila['modificaciones'] == 1 ? "<i class='zmdi zmdi-check' style='color:green'></i>" : "<i class='zmdi zmdi-close' style='color:grey'></i>" ?></td>
                                            <td align="center"><?= $fila['usuarios'] == 1 ? "<i class='zmdi zmdi-check' style='color:green'></i>" : "<i class='zmdi zmdi-close' style='color:grey'></i>" ?></td>
                                            <td>
                                              <div class="table-data-feature">
                                              
                                              <a href="editarusuario.php?id=<?=$fila['id']?>" ><button class="item" data-toggle="tooltip" data-placement="top" title="Editar">
                                                    <i class="zmdi zmdi-edit"></i>
                                              </button></a>
                                               <a href="#" onClick="if(confirm('Esta seguro de Eliminar el usuario?')) eliminarusuario(<?=$fila['id']?>,0);"><button class="item" data-toggle="tooltip" data-placement="top" title="Eliminar">
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
                        <script type="text/javascript">
                            function eliminarusuario(id) {
                                window.location.href = "eliminarusuario.php?id="+id;
                            }
                        </script>
                    </div>
                </div>                            
<?php include('footer.php') ?>
