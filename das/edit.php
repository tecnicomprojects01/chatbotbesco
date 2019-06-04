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
                            $sql = "SELECT * FROM mensaje_bienvenida ORDER by id_msj DESC LIMIT 1";
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
                                    <textarea class="form-control" name="mensaje" ><?= $msj ?></textarea>
                                </div>
                                <div  class="col mt-5">
                                    <input type="submit" value="Actualizar" class="btn btn-primary">
                                    <input type="button" value="Ver Todos"  class="btn btn-success" onclick="location.href='mensajes.php'" >
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>                                          
                </div>                        
            </div>                        
        </div>                        
    </div>
</div>                            
<?php include 'footer.php'; ?>

<?php 
if (isset($_POST['mensaje'])) {
    $mensaje=$_POST['mensaje'];
    $fecha=date("Y-m-d , g:i a");
    $sql2="UPDATE  mensaje_bienvenida 
            SET status = '0' ";
    if (mysqli_query($db,$sql2)) { }
        $sql1="INSERT INTO mensaje_bienvenida(mensaje,fecha,status) VALUES('$mensaje','$fecha','1')";   
        if (mysqli_query($db,$sql1)) {
        ?>
        <script>
            alert("Mensaje nuevo creado con exito");
            window.location = 'edit.php';
        </script>
        <?php
    }
}
?>