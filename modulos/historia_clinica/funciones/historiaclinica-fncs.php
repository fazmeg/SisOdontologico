<?php 
	include('../../../start.php');
	fnc_autentificacion();
	$per_id = fnc_varGetPost('per_id');
	$odo_id = $_POST['odo_id'];
	$odo_bloque = $_POST['odo_bloque'];
	$odo_posicion = $_POST['odo_posicion'];
	$odo_ubicacion = $_POST['odo_ubicacion'];
	$odo_url = $_POST['odo_url'];
	$paciente = $_POST['per_nombre'];
	$accion = fnc_varGetPost('accion');
	$menus = $_POST['menus'];
	$contMenus = count($menus);

/*
echo $per_id;
echo $odo_url;
echo $campo1;
echo $campo2;
*/
	if($accion=='Actualizar'){
		mysql_query("SET AUTOCOMMIT=0;", $conexion_mysql); //Desabilita el autocommit
		mysql_query("BEGIN;", $conexion_mysql); //Inicia la transaccion
		//Query 1
		$sql = sprintf('UPDATE odontograma SET odo_bloque=%s, odo_posicion=%s, odo_ubicacion=%s, odo_url=%s WHERE odo_id=%s and per_id=%s',//***********
		GetSQLValueString($odo_bloque, 'int'),
		GetSQLValueString($odo_posicion, 'int'),
		GetSQLValueString($odo_ubicacion, 'int'),
		GetSQLValueString($odo_url, 'text'),
		GetSQLValueString($odo_id, 'int'),
		GetSQLValueString($per_id, 'int'));
		$query_1 = mysql_query($sql, $conexion_mysql) or die(mysql_error());
			
		//Si no hubo errores COMMIT caso contrario ROLLBACK
		if($query_1){
			mysql_query("COMMIT;", $conexion_mysql);
			$MSG = 'Actualizado exitosamente.';
			$MSGdes = '[ID: '.$per_id.'] '.$paciente;
			$MSGimg = $RUTAi.'ok.png';
		}else{
			mysql_query("ROLLBACK;", $conexion_mysql);
			$MSG = 'Error al actualizar.';
			$MSGdes = $error;
			$MSGimg = $RUTAi.'delete.png';
		}
		mysql_query("SET AUTOCOMMIT=1;", $conexion_mysql); //Habilita el autocommit
	
	}
if($accion=='Insertar'){
		//Query 2
		$sql = sprintf('insert odontograma SET odo_bloque=%s, odo_posicion=%s, odo_ubicacion=%s, odo_url=%s,per_id=%s',
		GetSQLValueString($odo_bloque, 'int'),
		GetSQLValueString($odo_posicion, 'int'),
		GetSQLValueString($odo_ubicacion, 'int'),
		GetSQLValueString($odo_url, 'text'),
		GetSQLValueString($odo_id, 'int'),
		GetSQLValueString($per_id, 'int'));
		$query_1 = mysql_query($sql, $conexion_mysql) or die(mysql_error());
		//Si no hubo errores COMMIT caso contrario ROLLBACK
		if($query_1){
			mysql_query("COMMIT;", $conexion_mysql);
			$MSG = 'Actualizado exitosamente.';
			$MSGdes = '[ID: '.$per_id.'] '.$paciente;
			$MSGimg = $RUTAi.'ok.png';
		}else{
			mysql_query("ROLLBACK;", $conexion_mysql);
			$MSG = 'Error al actualizar.';
			$MSGdes = $error;
			$MSGimg = $RUTAi.'delete.png';
		}
		mysql_query("SET AUTOCOMMIT=1;", $conexion_mysql); //Habilita el autocommit
	}
	$_SESSION['MSG'] = $MSG;
	$_SESSION['MSGdes'] = $MSGdes;
	$_SESSION['MSGimg'] = $MSGimg;
	header("Location: ".$RUTAm."historia_clinica/historia_clinica.php?per_id=".$per_id."");
?>