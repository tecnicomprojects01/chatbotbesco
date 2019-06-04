<?php 
  	include('config.php');  
  	$id = $_GET['id'];
  
  
  	$sql = "DELETE FROM usuarios WHERE id=$id";
	if (mysqli_query($db,$sql)) {
		?>
		<script>
		    alert("Usuario Eliminado");
		    window.location = 'usuarios.php';			
		</script>
		<?php
	} 


     