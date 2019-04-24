<?php

$n2c = $_POST['number'] ;

// credenciales para la conexi�n
// ip del servidor
$host = "35.236.241.218";
// puerto de conexi�n
$puerto = "5038";
// usuario y contrase�a que se encuentran en /etc/asterisk/manager.conf
#$usuario = "admin";
#################################$contrasena = "21299038";
// canal o extensi�n que har� la llamada inicial, en mi caso SIP/201
$canal = $canal = "Local/3333@ext-queues"; //"SIP/01";
// contexto del dialplan donde se encuentran la extensi�n o canal
$contexto = "from-internal";
// tiempo de espera antes de finalizar la llamada si no se contesta
$espera = "30";
// prioridad con que se va a realizar la llamada
$prioridad = "1";
// cantidad de intentos antes de finalizar
$intentos = "2";
// prefijo en caso de que sea necesario para llamadas al exterior
//$prefijo = "9";
// n�mero que va a marcarse, sin espec�ficas protocolo
$numero = $n2c;
$pos = strpos($numero, "local");
if ($numero == null){
        exit() ;
}
if ($pos === false){
        $errno = 0 ;
        $errstr = 0 ;
        $caller_id = "Llamada AMI desde $canal";
        // aperturar una conexi�n mediante un socket
        $socket = fsockopen($host, $puerto, $errno, $errstr, 20);
        // si la conexi�n falla se imprime el error
        if (!$socket) {
                echo "$errstr ($errno)";
        }
        // si la conexi�n es satisfactoria se establece la llamada
        else {
                fputs($socket, "Action: login\r\n");
                fputs($socket, "Events: off\r\n");
                fputs($socket, "Username: $usuario\r\n");
                fputs($socket, "Secret: $contrasena\r\n\r\n");
                fputs($socket, "Action: originate\r\n");
                fputs($socket, "Channel: $canal\r\n");
                fputs($socket, "WaitTime: $espera\r\n");
                fputs($socket, "CallerId: $caller_id\r\n");
                fputs($socket, "Exten: $prefijo$numero\r\n");
                fputs($socket, "Context: $contexto\r\n");
                fputs($socket, "Priority: $prioridad\r\n\r\n");
                fputs($socket, "Action: Logoff\r\n\r\n");
                sleep(2);
                fclose($socket);
        }
        // imprimir mensaje sobre los n�meros que est�n interactuando
        //echo "$canal llamando $numero..." ;
          echo "Su llamada ha sido asignada a un operador, por favor espere.";
}
else {
        exit() ;
}
?>
