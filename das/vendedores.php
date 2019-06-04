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
                    <h3 class="title-5 m-b-35">Vendedores</h3>
                    <div class="table-data__tool">
                        <div class="table-data__tool-right">
                            <a href="nuevovendedor.php"><button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>Nuevo Vendedor</button></a>
                        </div>
                    </div>
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <tr>
                                      <th scope="col">#</th>
                                      <th scope="col">Nombre y Apellidos</th>
                                      <th scope="col">Teléfono</th>
                                      <th scope="col">Cargo</th>
                                      <th scope="col">Opciones</th>
                                    </tr>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                  mysqli_query($db,"SET NAMES 'utf8'");  
                                  $sql = "SELECT * FROM vendedores";
                                  $res = mysqli_query($db,$sql);

                                  while ($fila = mysqli_fetch_array($res)) {
                                    $class = $fila['habilitado'] == 0 ? 'table-danger' : '';
                                    ?>
                                      <tr class="tr-shadow <?= $class ?>">
                                        <td scope="row"><?= $fila['id']?></td>
                                        <td><?= $fila['name']?></td>
                                        <td><?= $fila['telefono']?></td>
                                        <td><?= $fila['cargos']?></td>
                                        <td>
                                          <div class="table-data-feature">
                                          <a href="detallesproyectov.php?id=<?=$fila['id']?>" ><button class="item" data-toggle="tooltip" data-placement="top" title="Proyetos">
                                                <i class="zmdi zmdi-more"></i>
                                            </button></a>
                                          <a href="editarvendedor.php?id=<?=$fila['id']?>" ><button class="item" data-toggle="tooltip" data-placement="top" title="Editar">
                                                <i class="zmdi zmdi-edit"></i>
                                          </button></a>
                                          <?php if($fila['habilitado'] == 0 ): ?>
                                          <a href="#" onClick="if(confirm('Esta seguro de habilitar el vendedor?')) eliminarvendedor(<?=$fila['id']?>,1);"><button class="item" data-toggle="tooltip" data-placement="top" title="Habilitar">
                                                <i class="zmdi zmdi-check"></i>
                                            </button></a>
                                          <?php else :?>
                                           <a href="#" onClick="if(confirm('Esta seguro de Deshabilitar el vendedor?')) eliminarvendedor(<?=$fila['id']?>,0);"><button class="item" data-toggle="tooltip" data-placement="top" title="Deshabilitar">
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
