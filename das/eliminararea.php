<?php 
  	include('config.php');  
  	$id = $_GET['id'];
  
  	$sql = "DELETE FROM areas where id=$id";
	if (mysqli_query($db,$sql)) {
		?>
		<script>
		    alert("Area Eliminada");
		    window.location = 'areac.php';			
		</script>
		<?php
	} 


     