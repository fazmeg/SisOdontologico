<?php
	if (!isset($_SESSION)) session_start();
	include('../../../start.php');
	fnc_autentificacion();
		
	$inputCed = $_POST["inputCed"];
	$inputNom = $_POST["inputNom"];
   	$inputDir1= $_POST["inputDir1"];
	$inputDir2 = $_POST["inputDir2"];
	$inputnumvi = $_POST["inputnumvi"];
	$inputtelf = $_POST["inputtelf"];
	$inputCel = $_POST["inputCel"];
	$inputnacionalidad = $_POST["inputnacionalidad"];
	$inputciudadnacimiento = $_POST["inputciudadnacimiento"];
	$imputfechanacimiento = $_POST["imputfechanacimiento"];
	$optionsRadios1 = $_POST["optionsRadios1"];
	$optionsRadios2 = $_POST["optionsRadios2"];
	$observaciones = $_POST["observaciones"];
	$alergias = $_POST["alergiass"];
    	$query_insert_user = sprintf("INSERT INTO persona (usr_nick, usr_contrasena) VALUES (%s, %s, %s)",
    	GetSQLValueString($id, "int"), 
		GetSQLValueString($nombre, "text"), 
		GetSQLValueString($pass, "text"));
        
    	mysql_query($query_insert_user);
    	echo mysql_error();
	header("Location: ".$RUTAmo."administrador/crear-usuario.php?msg=ok");
?>
