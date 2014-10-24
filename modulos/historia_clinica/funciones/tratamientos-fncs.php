<?php 
	include('../../../start.php');
	fnc_autentificacion();
	$tra_rea_fec = $_POST['fecha'];
	$det_tra_rea_cantidad = $_POST['det_tra_rea_cantidad'];
	$det_tra_rea_estado = $_POST['det_tra_rea_estado'];
	$per_id = $_POST['per_id'];
	$tra_id = $_POST['tra_id'];
//    $accion = $_POST['accion'];
/* Consulta de Existencia de tratamientos */
	$sqltra = sprintf("SELECT * FROM detalle_tratamientosxrealizar WHERE tra_id = '".$tra_id."' and per_id = '".$per_id."' and tra_rea_fec= '".$tra_rea_fec."'");
			$querytra = mysql_query($sqltra, $conexion_mysql) or die(mysql_error());
			$rowtra = mysql_fetch_assoc($querytra);
			$tot_rowstra = mysql_num_rows($querytra);
	if($det_tra_rea_cantidad==0)
			{ $accion='Eliminar';}

if(is_null($rowtra['det_tra_rea_id']))
{$accion='Insertar';

	}
else
{$accion='Actualizar';
			$det_tra_rea_id=$rowtra['det_tra_rea_id'];
            $det_tra_rea_estado ='C';
	if($det_tra_rea_cantidad == 0)
			{ $accion='Eliminar';}
			
	}
	if($accion=='Actualizar'){
		mysql_query("SET AUTOCOMMIT=0;", $conexion_mysql); //Desabilita el autocommit
		mysql_query("BEGIN;", $conexion_mysql); //Inicia la transaccion
		//Query 1
		$sql = sprintf('UPDATE detalle_tratamientosxrealizar SET det_tra_rea_cantidad=%s WHERE det_tra_rea_id=%s',
		//Cadenas de datos
		GetSQLValueString($det_tra_rea_cantidad, 'int'),
		GetSQLValueString($det_tra_rea_id, 'int'));
		$query_1 = mysql_query($sql, $conexion_mysql) or die(mysql_error());
			
		//Si no hubo errores COMMIT caso contrario ROLLBACK
		if($query_1){
			mysql_query("COMMIT;", $conexion_mysql);
			$MSG = 'Actualizado exitosamente.';
			$MSGdes = '[ID: '.$tra_id.'] '.$per_id;
			$MSGimg = $RUTAi.'ok.png';
            $resultado='Actualizado Correctamente';
		}else{
			mysql_query("ROLLBACK;", $conexion_mysql);
			$MSG = 'Error al actualizar.';
			$MSGdes = $error;
			$MSGimg = $RUTAi.'delete.png';
			$resultado='Nose pudo Actualizar';
		}
		mysql_query("SET AUTOCOMMIT=1;", $conexion_mysql); //Habilita el autocommit
	
	}
if($accion=='Insertar'){
		//Query 2
		$sql = sprintf('INSERT detalle_tratamientosxrealizar SET tra_id=%s, per_id=%s, tra_rea_fec=%s, det_tra_rea_cantidad=%s, det_tra_rea_estado=%s, tra_rea_eliminado=%s',
		GetSQLValueString($tra_id, 'int'),
		GetSQLValueString($per_id, 'int'),
		GetSQLValueString($tra_rea_fec, 'date'),
		GetSQLValueString($det_tra_rea_cantidad, 'int'),
		GetSQLValueString('C', 'text'),
		GetSQLValueString('N', 'text'));
		$query_1 = mysql_query($sql, $conexion_mysql) or die(mysql_error());
		//Si no hubo errores COMMIT caso contrario ROLLBACK
		if($query_1){
			mysql_query("COMMIT;", $conexion_mysql);
			$MSG = 'Insertado exitosamente.';
			$MSGdes = '[ID: '.$tra_id.'] '.$per_id;
			$MSGimg = $RUTAi.'ok.png';
			$resultado='Insertado Correctamente';
		}else{
			mysql_query("ROLLBACK;", $conexion_mysql);
			$MSG = 'Error al Registrar.';
			$MSGdes = $error;
			$MSGimg = $RUTAi.'delete.png';
			$resultado='Nose pudo Insertar';
		}
		mysql_query("SET AUTOCOMMIT=1;", $conexion_mysql); //Habilita el autocommit
	}

	
		if($accion=='Eliminar'){
		mysql_query("SET AUTOCOMMIT=0;", $conexion_mysql); //Desabilita el autocommit
		mysql_query("BEGIN;", $conexion_mysql); //Inicia la transaccion
		$sql = sprintf('DELETE FROM detalle_tratamientosxrealizar WHERE det_tra_rea_id=%s',
		GetSQLValueString($det_tra_rea_id, 'int'));
		$query = mysql_query($sql, $conexion_mysql);
		$error = mysql_error();
				//Si no hubo errores COMMIT caso contrario ROLLBACK
		if($query){	
			mysql_query("COMMIT;", $conexion_mysql);
			$MSG = 'Eliminado exitosamente.';
			$MSGdes = 'Tratamiento '.$det_tra_rea_id.' eliminado';
			$MSGimg = $RUTAi.'ok.png';
			$resultado='Registro Eliminado';
		}else{
			mysql_query("ROLLBACK;", $conexion_mysql);
			$MSG = 'Error al eliminar.';
			$MSGdes = $error;
			$MSGimg = $RUTAi.'delete.png';
			$resultado='No se pudo eliminar registro';
		}
	}
	
	////////////////////////////////////////////////////////////////////////////////////
	if($accion=='Facturar'){
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
	echo($det_tra_rea_cantidad.$accion);
	?>