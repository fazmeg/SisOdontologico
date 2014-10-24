<?php 
	include('../../../start.php');
	fnc_autentificacion();
	$det_die_per_fec_act = $_POST['det_die_per_fec_act'];
	$det_die_per_fec_reg1 = $_POST['det_die_per_fec_reg1'];
	$det_die_per_des_ini = $_POST['det_die_per_fec_ini'];
	$det_die_per_des_pen = $_POST['det_die_per_fec_pen'];
	$det_die_per_des_rea = $_POST['det_die_per_des_rea'];
    $det_die_per_id = $_POST['id'];
	$per_id = $_POST['per_id'];
	$die_id = $_POST['die_id'];
    $accion = $_POST['accion'];

	if($accion=='Actualizar'){
		mysql_query("SET AUTOCOMMIT=0;", $conexion_mysql); //Desabilita el autocommit
		mysql_query("BEGIN;", $conexion_mysql); //Inicia la transaccion
		//Query 1
		$sql = sprintf('UPDATE detalle_die_per SET det_die_per_fec_act=%s, per_id=%s, det_die_per_des_ini=%s, det_die_per_des_pen=%s, det_die_per_des_rea=%s, die_id=%s WHERE det_die_per_id=%s',
		//Cadenas de datos
		GetSQLValueString($det_die_per_fec_act, 'date'),
		GetSQLValueString($per_id, 'int'),
		GetSQLValueString($det_die_per_des_ini, 'text'),
		GetSQLValueString($det_die_per_des_pen, 'text'),
		GetSQLValueString($det_die_per_des_rea, 'text'),
		GetSQLValueString($die_id, 'int'),
		GetSQLValueString($det_die_per_id, 'int'));
		$query_1 = mysql_query($sql, $conexion_mysql) or die(mysql_error());
			
		//Si no hubo errores COMMIT caso contrario ROLLBACK
		if($query_1){
			mysql_query("COMMIT;", $conexion_mysql);
			$MSG = 'Actualizado exitosamente.';
			$MSGdes = '[ID: '.$die_id.'] '.$per_id;
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
		$sql = sprintf('insert detalle_die_per SET det_die_per_fec_reg1=%s, per_id=%s, det_die_per_des_ini=%s, det_die_per_des_pen=%s, det_die_per_des_rea=%s, die_id=%s',
		GetSQLValueString($det_die_per_fec_reg1, 'date'),
		GetSQLValueString($per_id, 'int'),
		GetSQLValueString($det_die_per_des_ini, 'text'),
		GetSQLValueString($det_die_per_des_pen, 'text'),
		GetSQLValueString($det_die_per_des_rea, 'text'),
		GetSQLValueString($die_id, 'int'));
		$query_1 = mysql_query($sql, $conexion_mysql) or die(mysql_error());
		//Si no hubo errores COMMIT caso contrario ROLLBACK
		if($query_1){
			mysql_query("COMMIT;", $conexion_mysql);
			$MSG = 'Insertado exitosamente.';
			$MSGdes = '[ID: '.$die_id.'] '.$per_id;
			$MSGimg = $RUTAi.'ok.png';
		}else{
			mysql_query("ROLLBACK;", $conexion_mysql);
			$MSG = 'Error al actualizar.';
			$MSGdes = $error;
			$MSGimg = $RUTAi.'delete.png';
		}
		mysql_query("SET AUTOCOMMIT=1;", $conexion_mysql); //Habilita el autocommit
	}
	
	////////////////////////////////////////////////////////////////////////////////////
	if($accion=='Evolucionar'){
		mysql_query("SET AUTOCOMMIT=0;", $conexion_mysql); //Desabilita el autocommit
		mysql_query("BEGIN;", $conexion_mysql); //Inicia la transaccion
		//Query 1
		$sql = sprintf('UPDATE detalle_die_per SET det_die_per_fec_act=%s, det_die_per_des_pen=%s, det_die_per_des_rea=%s WHERE det_die_per_id=%s',
		//Cadenas de datos
		GetSQLValueString($det_die_per_fec_act, 'date'),
		GetSQLValueString($det_die_per_des_pen, 'text'),
		GetSQLValueString($det_die_per_des_rea, 'text'),
		GetSQLValueString($det_die_per_id, 'int'));
		$query_1 = mysql_query($sql, $conexion_mysql) or die(mysql_error());
			
		//Si no hubo errores COMMIT caso contrario ROLLBACK
		if($query_1){
			mysql_query("COMMIT;", $conexion_mysql);
			$MSG = 'Evolucionado exitosamente.';
			$MSGdes = '[ID: '.$die_id.'] '.$per_id;
			$MSGimg = $RUTAi.'ok.png';
		}else{
			mysql_query("ROLLBACK;", $conexion_mysql);
			$MSG = 'Error al Evolucionar.';
			$MSGdes = $error;
			$MSGimg = $RUTAi.'delete.png';
		}
		mysql_query("SET AUTOCOMMIT=1;", $conexion_mysql); //Habilita el autocommit
	
	}
	
	$_SESSION['MSG'] = $MSG;
	$_SESSION['MSGdes'] = $MSGdes;
	$_SESSION['MSGimg'] = $MSGimg;
	header("Location: ".$RUTAm."historia_clinica/historia_clinica_form.php?per_id=".$per_id."");

?>