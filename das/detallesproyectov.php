<?php
  include('session.php');
  $id = $_GET['id'];
  mysqli_query($db,"SET NAMES 'utf8'");  
  $sql = "SELECT * FROM vendedores WHERE id =".$id;
  $res = mysqli_query($db,$sql);
  $fila = mysqli_fetch_array($res);
  include 'header.php';
?>
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
            <script src="js/extra.js"></script>                            
            <?php include 'footer.php'; ?>