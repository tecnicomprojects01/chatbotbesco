<form action="" method="POST" enctype="multipart/form-data" name="nuevo">
<div class="col text-center">
  <input type="text" name="ok">
<span>Imagen</span>
<input type="file" class="form-control" name="imagenew" >
<div class="col">
<input type="submit" value="Guardar" class="btn btn-primary">
</div>
</div>
</form>

<?php 
error_reporting(E_ALL); // or E_STRICT
ini_set("display_errors",1);
ini_set("memory_limit","1024M");
  if (isset($_POST['ok'])) {
    $target_path = __DIR__."/das/areas/";
    echo $target_path;
    $target_path = $target_path . basename( $_FILES['imagenew']['name']); 
    echo "<br>";
    echo $target_path;
    echo "<br>";
    echo $_FILES['imagenew']['tmp_name'];
    echo "<br>";
    echo exec('whoami');
    echo "<br>";
    echo exec('namei -l /var/www/html/das/areas/');
    print_r($_FILES['imagenew']);
    if(move_uploaded_file($_FILES['imagenew']['tmp_name'], $target_path)) {
        echo "El archivo ".  basename( $_FILES['imagenew']['name']). 
        " ha sido subido";
    } else{
          echo "Error: ".$_FILES["imagenew"]["error"];
    }
  }
?>