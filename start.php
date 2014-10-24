<?php 
	if (!isset($_SESSION)) session_start();
	include('system/config/config.php');
	include(RUTAcon.'conexion-mysql.php');
	include(RUTAs.'funciones/fncs-system.php');
	include (RUTAp."/fpdf/fpdf.php");
	
	//include(RUTAs.'styles/styl-bootstrap.php');
?>
