<?php 
   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', 'Q5UHaK3uxEkX5Eae');
   define('DB_DATABASE', 'chatbot_besco');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
   mysqli_query($db,"SET NAMES 'utf8'");
?>