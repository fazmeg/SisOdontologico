<?php
	include ('../../../start.php');
	fnc_autentificacion();
	$pac_id = fnc_varGetPost('pac_id');
	$per_id = fnc_varGetPost('per_id');
	
	$nombre = $_POST["inputNom"];
    $cedula = $_POST["inputCed"];
	$nacionalidad = $_POST["inputnacionalidad"];
    $ciudad = $_POST["inputciudadnacimiento"];
	$direccion1 = $_POST["inputDir1"];
    $direccion2 = $_POST["inputDir2"];
	$num_vivienda = $_POST["inputnumvi"];
    $telefono = $_POST["inputtelf"];
	$celular = $_POST["inputCel"];
    $email = $_POST["inputemail1"];
    $sexo = $_POST["sexo"];
	$fecha_nacimiento = $_POST["imputfechanacimiento"];
	$observaciones = $_POST["observaciones"];
    $alergia = $_POST["alergias"];
	
	$accion = fnc_varGetPost('accion');
		
		if($accion == "Insertar")
		{
			mysql_query("SET AUTOCOMMIT=0;", $conexion_mysql); //Desabilita el autocommit
			mysql_query("BEGIN;", $conexion_mysql); //Inicia la transaccion
			
			$carpeta = RUTAi."personas/";
			opendir($carpeta);
			$desino = $carpeta.$_FILES['foto']['name'];
			copy($_FILES['foto']['tmp_name'],$desino);
			$nom_foto = $_FILES['foto']['name'];
			$ruta = $carpeta.$nom_foto.$extension;
			
			$queryper=sprintf("SELECT per_id FROM persona WHERE per_documento = %s",
			GetSQLValueString($cedula, "text"));    
			$RSper = mysql_query($queryper, $conexion_mysql) or die(mysql_error());
			$row_RS_datos_per = mysql_fetch_assoc($RSper);		
			//$PerIdRS = $row_RS_datos_per["per_id"];
			
			if(!isset($row_RS_datos_per["per_id"]))
			{
				$query_insert_user = sprintf("INSERT INTO persona (per_nombre, per_documento, per_nacionalidad, per_ciudad_nac, per_direccion1, per_direccion2, per_num_viv, per_mail, per_sexo, per_fec_nac, per_foto) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
						   GetSQLValueString($nombre, "text"),
						   GetSQLValueString($cedula, "text"),
						   GetSQLValueString($nacionalidad, "text"),
						   GetSQLValueString($ciudad, "text"),
						   GetSQLValueString($direccion1, "text"),
						   GetSQLValueString($direccion2, "text"),
						   GetSQLValueString($num_vivienda, "text"),
						   GetSQLValueString($email, "text"),
						   GetSQLValueString($sexo, "text"),
						   GetSQLValueString($fecha_nacimiento, "text"),
						   GetSQLValueString($ruta, "text"));
			
			$query_1 = mysql_query($query_insert_user, $conexion_mysql); $error=mysql_error();
			
			/*$LoginRS_query=sprintf("SELECT per_id FROM persona WHERE per_documento = %s",
			GetSQLValueString($cedula, "text"));    
			$LoginRS = mysql_query($LoginRS_query, $conexion_mysql) or die(mysql_error());
			$row_RS_datos = mysql_fetch_assoc($LoginRS);		
			$per_id = $row_RS_datos["per_id"];*/
			$per_id = mysql_insert_id();
		}
		else
		{
			$per_id = $row_RS_datos_per["per_id"];
		}
		
		$querycel=sprintf("SELECT tel_id FROM telefono WHERE per_id = %s AND tel_tipo = %s",
		GetSQLValueString($per_id, "int"),
		GetSQLValueString('celular', "text"));    
		$RScel = mysql_query($querycel, $conexion_mysql) or die(mysql_error());
		$row_RS_datos_cel = mysql_fetch_assoc($RScel);		
		if(!isset($row_RS_datos_cel["tel_id"]))
		{
			$query_insert_user = sprintf("INSERT INTO telefono (per_id, tel_tipo, tel_numero, tel_eliminado) VALUES (%s, %s, %s, %s)",
						   GetSQLValueString($per_id, "text"),
						   GetSQLValueString("celular", "text"),
						   GetSQLValueString($celular, "text"),
						   GetSQLValueString("N", "text"));
						   
			$query_2 = mysql_query($query_insert_user, $conexion_mysql); $error=mysql_error();
		}
		$querycel=sprintf("SELECT tel_id FROM telefono WHERE per_id = %s AND tel_tipo = %s",
		GetSQLValueString($per_id, "int"),
		GetSQLValueString('convencional', "text"));    
		$RScel = mysql_query($querycel, $conexion_mysql) or die(mysql_error());
		$row_RS_datos_cel = mysql_fetch_assoc($RScel);		
		if(!isset($row_RS_datos_cel["tel_id"]))
		{
			$query_insert_user = sprintf("INSERT INTO telefono (per_id, tel_tipo, tel_numero, tel_eliminado) VALUES (%s, %s, %s, %s)",
						   GetSQLValueString($per_id, "text"),
						   GetSQLValueString("convencional", "text"),
						   GetSQLValueString($telefono, "text"),
						   GetSQLValueString("N", "text"));
			
			$query_3 = mysql_query($query_insert_user, $conexion_mysql); $error=mysql_error();
		}
		$querypac=sprintf("SELECT pac_id FROM paciente WHERE per_id = %s AND pac_eliminado = %s",
		GetSQLValueString($per_id, "int"),
		GetSQLValueString('N', "text"));    
		$RSpac = mysql_query($querypac, $conexion_mysql) or die(mysql_error());
		$row_RS_datos_pac = mysql_fetch_assoc($RSpac);		
		if(!isset($row_RS_datos_pac["pac_id"]))
		{
			$query_insert_user = sprintf("INSERT INTO paciente (per_id, pac_observaciones, pac_alergias, pac_eliminado) VALUES (%s, %s, %s, %s)",
						   GetSQLValueString($per_id, "text"),
						   GetSQLValueString($observaciones, "text"),
						   GetSQLValueString($alergia, "text"),
						   GetSQLValueString("N", "text"));
			
			$query_4 = mysql_query($query_insert_user, $conexion_mysql); $error=mysql_error();
		}
		//Si no hubo errores COMMIT caso contrario ROLLBACK
		if($query_1 || $query_2 || $query_3 || $query_4){
			mysql_query("COMMIT;", $conexion_mysql);
			$MSG = 'Insertado exitosamente.';
			$MSGdes = '[ID: '.$pac_id.'] '.$nombre;
			$MSGimg = $RUTAi.'ok.png';
		}else{
			mysql_query("ROLLBACK;", $conexion_mysql);
			$MSG = 'Error al insertar.';
			$MSGdes = $error;
			$MSGimg = $RUTAi.'delete.png';
		}
		mysql_query("SET AUTOCOMMIT=1;", $conexion_mysql); //Habilita el autocommit
		}
		
		if($accion == "Actualizar")
		{
			mysql_query("SET AUTOCOMMIT=0;", $conexion_mysql); //Desabilita el autocommit
			mysql_query("BEGIN;", $conexion_mysql); //Inicia la transaccion
			$query_update_user = sprintf("UPDATE paciente set pac_observaciones = %s, pac_alergias = %s WHERE per_id = %s",
                       GetSQLValueString($observaciones, "text"),
					   GetSQLValueString($alergia, "text"),
					   GetSQLValueString($per_id, "text"));
			$query_4 = mysql_query($query_update_user, $conexion_mysql) or die(mysql_error());
			//Query
			
			$sql = sprintf('UPDATE persona SET per_nombre=%s, per_nacionalidad = %s, per_ciudad_nac = %s, per_direccion1 = %s, per_direccion2 = %s, per_num_viv = %s, per_mail = %s, per_sexo = %s, per_fec_nac = %s WHERE per_id=%s',
					   GetSQLValueString($nombre, "text"),
					   GetSQLValueString($nacionalidad, "text"),
					   GetSQLValueString($ciudad, "text"),
					   GetSQLValueString($direccion1, "text"),
					   GetSQLValueString($direccion2, "text"),
					   GetSQLValueString($num_vivienda, "text"),
					   GetSQLValueString($email, "text"),
					   GetSQLValueString($sexo, "text"),
					   GetSQLValueString($fecha_nacimiento, "text"),
					   GetSQLValueString($per_id, "int"));
			$query = mysql_query($sql, $conexion_mysql);
			$error = mysql_error();
			
			$query_update_user = sprintf("UPDATE telefono set tel_numero = %s WHERE per_id = %s AND tel_tipo = %s",
                       GetSQLValueString($telefono, "text"),
					   GetSQLValueString($per_id, "text"),
					   GetSQLValueString("convencional", "text"));
		$query_2 = mysql_query($query_update_user, $conexion_mysql) or die(mysql_error());
		
		$query_update_user = sprintf("UPDATE telefono set tel_numero = %s WHERE per_id = %s AND tel_tipo = %s",
                       GetSQLValueString($celular, "text"),
					   GetSQLValueString($per_id, "text"),
					   GetSQLValueString("celular", "text"));
		$query_3 = mysql_query($query_update_user, $conexion_mysql) or die(mysql_error());
		
		//Si no hubo errores COMMIT caso contrario ROLLBACK
		if($query_4){
			mysql_query("COMMIT;", $conexion_mysql);
			$MSG = 'Actualizado exitosamente.';
			$MSGdes = '[ID: '.$pac_id.'] '.$nombre;
			$MSGimg = $RUTAi.'ok.png';
		}else{
			mysql_query("ROLLBACK;", $conexion_mysql);
			$MSG = 'Error al actualizar.';
			$MSGdes = $error;
			$MSGimg = $RUTAi.'delete.png';
		}
		mysql_query("SET AUTOCOMMIT=1;", $conexion_mysql); //Habilita el autocommit
		}
		
		if($accion == "Eliminar")
		{
		mysql_query("SET AUTOCOMMIT=0;", $conexion_mysql); //Desabilita el autocommit
		mysql_query("BEGIN;", $conexion_mysql); //Inicia la transaccion
		$query_delete_user = sprintf("UPDATE paciente set pac_eliminado = %s WHERE per_id = %s",
		//$query_delete_user = sprintf("DELETE from paciente WHERE per_id = %s",
					   GetSQLValueString('S', "text"),
					   GetSQLValueString($per_id, "text"));
		$query_1 = mysql_query($query_delete_user, $conexion_mysql);
		
		//Si no hubo errores COMMIT caso contrario ROLLBACK
		if($query_1){
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
		header("Location: ".$RUTAm."pacientes/pacientes-index.php");
?>