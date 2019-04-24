


<?php
$mysqli = new mysqli("localhost", "root", "", "bdpan");
if ($mysqli->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}


$mysqli = new mysqli("127.0.0.1", "root", "", "bdpan", 3306);
if ($mysqli->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}


?>

