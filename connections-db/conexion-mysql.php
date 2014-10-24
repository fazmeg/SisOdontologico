<?php

//LOCAL
$hostname = "localhost";
$database = "sistema_odontologico";
$username = "root";
$password = "root";
$conexion_mysql = mysql_pconnect($hostname, $username, $password) or trigger_error(mysql_error(),E_USER_ERROR);
mysql_select_db($database, $conexion_mysql);
mysql_query("SET NAMES 'utf8'");


/*
//REMOTO
$hostname = "localhost";
$database = "fabianzavala_sio";
$username = "fabianzavala_sio";
$password = "sisteo@edison-a";
$conexion_mysql = mysql_pconnect($hostname, $username, $password) or trigger_error(mysql_error(),E_USER_ERROR);
mysql_select_db($database, $conexion_mysql);
mysql_query("SET NAMES 'utf8'");
*/

?>