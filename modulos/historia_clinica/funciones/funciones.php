<?php 
	include('../../../start.php');
	fnc_autentificacion();
	$per_id = fnc_varGetPost('per_id');
	$ModelodePago = $_POST['ModelodePago'];
	$AplicaDescuento = $_POST['Descuento'];
	$id_fac = $_POST['id_fac'];
	$per_id = $_POST['per_id'];
	$tdescuento = $_POST['tdescuento'];
	$total = $_POST['total'];
	$tot_fac=$total-$tdescuento;
	if($AplicaDescuento=='N')
	{$tdescuento=0;
		}

	$sql = sprintf('insert cabecera_factura SET cab_fac_val_pag=%s, cab_fac_des=%s, cab_fac_subt=%s, cab_fac_iva=%s,cab_fac_tot=%s,cab_fac_num=%s,per_id=%s,cab_fac_eliminado=%s',
		GetSQLValueString($total, 'text'),
		GetSQLValueString($tdescuento, 'text'),
		GetSQLValueString($total, 'text'),
		GetSQLValueString('0', 'int'),
		GetSQLValueString($tot_fac, 'text'),
		GetSQLValueString($id_fac, 'text'),
		GetSQLValueString($per_id, 'int'),
		GetSQLValueString('N', 'text'));
		$query_1 = mysql_query($sql, $conexion_mysql) or die(mysql_error());
		$id=mysql_insert_id();
		mysql_query("COMMIT;", $conexion_mysql);
	
	echo $id;
	$sqltratamientosxrealizar = sprintf("SELECT * FROM detalle_tratamientosxrealizar where per_id=".$per_id);
	$querytratamientosxrealizar = mysql_query($sqltratamientosxrealizar, $conexion_mysql) or die(mysql_error());
	$rowtratamientosxrealizar = mysql_fetch_assoc($querytratamientosxrealizar);
	
	
	do {
			$totalTra=($rowCotiza['det_tra_rea_cantidad']*$rowCotiza['pre_val']);
			$totalTra2=$totalTra2+$totalTra; 
		
		} while ($rowCotiza = mysql_fetch_assoc($queryCotiza)); 
	
	
	
		
	$sqltratamientosprecios = sprintf("SELECT * FROM detalle_die_per inner join persona on persona.per_id=detalle_die_per.per_id where die_id=".$die_id." and detalle_die_per.per_id=".$per_id);
	$querytratamientosprecios = mysql_query($sqltratamientosprecios, $conexion_mysql) or die(mysql_error());
	$rowquerytratamientosprecios = mysql_fetch_assoc($querytratamientosprecios);



/*
echo $per_id;
echo $odo_url;
echo $campo1;
echo $campo2;

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
	header("Location: ".$RUTAm."historia_clinica/historia_clinica.php?per_id=".$per_id."");*/
?>