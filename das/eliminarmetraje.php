<?php 
  	include('config.php');  
  	$id = $_GET['id'];
  	$pid = $_GET['pid'];
  
  	$sql = "DELETE FROM metrajes where id=$id";
	if (mysqli_query($db,$sql)) {
		?>
		<script>
		    alert("Metraje Eliminado");
		    window.location = 'metraje.php?id=<?= $pid ?>';			
		</script>
		<?php
	} 


     