<?php 
	include('../../../start.php');
	fnc_autentificacion();
	
	$tra_id = fnc_varGetPost('tra_id');
	$tra_nom = $_POST['tra_nom'];
	$tra_cat_id = $_POST['categoria'];
	$accion = fnc_varGetPost('accion');

	if($accion=='Actualizar'){
		mysql_query("SET AUTOCOMMIT=0;", $conexion_mysql); //Desabilita el autocommit
		mysql_query("BEGIN;", $conexion_mysql); //Inicia la transaccion
		
		//Query
		$sql = sprintf('UPDATE tratamientos SET tra_nom=%s,tra_cat_id=%s WHERE tra_id=%s',
		GetSQLValueString($tra_nom, 'text'),
		GetSQLValueString($tra_cat_id, 'int'),
		GetSQLValueString($tra_id, 'int'));
		$query = mysql_query($sql, $conexion_mysql);
		$error = mysql_error();
		
		//Si no hubo errores COMMIT caso contrario ROLLBACK
		if($query){
			mysql_query("COMMIT;", $conexion_mysql);
			$MSG = 'Actualizado exitosamente.';
			$MSGdes = '[ID: '.$tra_id.'] '.$tra_nom;
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
		mysql_query("SET AUTOCOMMIT=0;", $conexion_mysql); //Desabilita el autocommit
		mysql_query("BEGIN;", $conexion_mysql); //Inicia la transaccion
		//Query
		$sql = sprintf('INSERT INTO tratamientos (tra_cat_id,tra_nom,tra_elim) VALUES (%s,%s,%s)',
		GetSQLValueString($tra_cat_id, 'int'),
		GetSQLValueString($tra_nom, 'text'),
		GetSQLValueString('N', 'text'));
		$query = mysql_query($sql, $conexion_mysql); 
		$error = mysql_error();
		$id = mysql_insert_id();
		//Si no hubo errores COMMIT caso contrario ROLLBACK
		if($query){
			mysql_query("COMMIT;", $conexion_mysql);
			$MSG = 'Insertado exitosamente.';
			$MSGdes = '[ID: '.$id.'] '.$tra_nom;
			$MSGimg = $RUTAi.'ok.png';
		}else{
			mysql_query("ROLLBACK;", $conexion_mysql);
			$MSG = 'Error al insertar.';
			$MSGdes = $error;
			$MSGimg = $RUTAi.'delete.png';
		}
		mysql_query("SET AUTOCOMMIT=1;", $conexion_mysql); //Habilita el autocommit
	}
	
	if($accion=='Eliminar'){
		mysql_query("SET AUTOCOMMIT=0;", $conexion_mysql); //Desabilita el autocommit
		mysql_query("BEGIN;", $conexion_mysql); //Inicia la transaccion
		
		/*
		echo 'tratamiento a borrar: '.$tra_id;
		echo '   Accion: '.$accion;
		*/
		
		//Query 1
		$sql = sprintf('DELETE FROM tratamientos WHERE tra_id=%s', GetSQLValueString($tra_id, 'int'));
		$query_1 = mysql_query($sql, $conexion_mysql);
		
		//Query 2
		$sql2 = sprintf('DELETE FROM precios WHERE tra_id=%s', GetSQLValueString($tra_id, 'int'));
		$query_2 = mysql_query($sql2, $conexion_mysql);
		

		//Si no hubo errores COMMIT caso contrario ROLLBACK
		if($query_1 || $query_2){
			mysql_query("COMMIT;", $conexion_mysql);
			$MSG = 'Eliminado exitosamente.';
			$MSGdes = 'Registro eliminado';
			$MSGimg = $RUTAi.'ok.png';
		}else{
			mysql_query("ROLLBACK;", $conexion_mysql);
			$MSG = 'Error al eliminar.';
			$MSGdes = $error;
			$MSGimg = $RUTAi.'delete.png';
		}
		mysql_query("SET AUTOCOMMIT=1;", $conexion_mysql); //Habilita el autocommit
}	
	$_SESSION['MSG'] = $MSG;
	$_SESSION['MSGdes'] = $MSGdes;
	$_SESSION['MSGimg'] = $MSGimg;
	header("Location: ".$RUTAm."administrador/tratamientos-index.php");
?>