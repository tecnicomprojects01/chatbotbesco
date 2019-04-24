<?php
session_start();
echo '<title>TU SOPORTE</title>';
echo '<form action="make_call_palmas.php" method="post">
<table width="35%">
<tr><td>Esto es una prueba de Besco</td></tr>
<tr><td> <input type="text" name="number" /></td></tr>
<tr><td colspan="1" align="left"><input type="submit" value="Agendar Llamada" /></td></tr>
</table>
</form>
<img alt="FPP Logo" src="">';
$_SESSION['calling'] = 'yes' ;
?>
