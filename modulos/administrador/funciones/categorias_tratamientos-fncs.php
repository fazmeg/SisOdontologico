<?php 
	include('../../../start.php');
	fnc_autentificacion();
	
	$tra_cat_id = fnc_varGetPost('tra_cat_id');
	$tra_cat_nom = $_POST['tra_cat_nom'];
	$accion = fnc_varGetPost('accion');

	if($accion=='Actualizar'){
		mysql_query("SET AUTOCOMMIT=0;", $conexion_mysql); //Desabilita el autocommit
		mysql_query("BEGIN;", $conexion_mysql); //Inicia la transaccion
		
		//Query
		$sql = sprintf('UPDATE tra_categorias SET tra_cat_nom=%s WHERE tra_cat_id=%s',
		GetSQLValueString($tra_cat_nom, 'text'),
		GetSQLValueString($tra_cat_id, 'int'));
		$query = mysql_query($sql, $conexion_mysql);
		$error = mysql_error();
		
		//Si no hubo errores COMMIT caso contrario ROLLBACK
		if($query){
			mysql_query("COMMIT;", $conexion_mysql);
			$MSG = 'Actualizado exitosamente.';
			$MSGdes = '[ID: '.$tra_cat_id.'] '.$tra_cat_nom;
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
		$sql = sprintf('INSERT INTO tra_categorias(tra_cat_nom,tra_cat_elim) VALUES (%s,%s)',
		GetSQLValueString($tra_cat_nom, 'text'),
		GetSQLValueString('N', 'text'));
		$query = mysql_query($sql, $conexion_mysql); 
		$error = mysql_error();
		$id = mysql_insert_id();
		
		//Si no hubo errores COMMIT caso contrario ROLLBACK
		if($query){
			mysql_query("COMMIT;", $conexion_mysql);
			$MSG = 'Insertado exitosamente.';
			$MSGdes = '[ID: '.$id.'] '.$tra_cat_nom;
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

		$sql = sprintf('UPDATE tra_categorias SET tra_cat_elim=%s WHERE tra_cat_id=%s',
		GetSQLValueString('S', 'text'),
		GetSQLValueString($tra_cat_id, 'int'));
		$query = mysql_query($sql, $conexion_mysql);
		$error = mysql_error();

		//Si no hubo errores COMMIT caso contrario ROLLBACK
		if($query){
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
	header("Location: ".$RUTAm."administrador/categorias_tratamientos-index.php");
?>