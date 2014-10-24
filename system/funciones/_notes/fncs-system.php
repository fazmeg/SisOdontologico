<?php
if (!function_exists("GetSQLValueString")){
	function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = ""){
		if (PHP_VERSION < 6){ $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue; }
		$theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

		switch ($theType) {
			case "text":
				$theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL"; break;    
			case "long":
			case "int":
				$theValue = ($theValue != "") ? intval($theValue) : "NULL"; break;
			case "double":
				$theValue = ($theValue != "") ? doubleval($theValue) : "NULL"; break;
			case "date":
				$theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL"; break;
			case "defined":
				$theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue; break;
		}return $theValue;
	}
}	
//SI EL USUARIO NO SE HA LOGEADO REDIRECCIONA A wrong-access.php
function fnc_autentificacion(){
	if(!$_SESSION['autentificacion'])
		header('Location: '.$GLOBALS['RUTA'].'wrong-access.php');		 
}
//FUNCION PARA IDENTIFICAR SI UNA VARIABLE INGRESAR POR POST O GET
function fnc_varGetPost($var){
	if(isset($_POST[$var])){
		$tipVar = $_POST[$var];
	}
	if(isset($_GET[$var])){
		$tipVar = $_GET[$var];
	}
	return $tipVar;
}
//FUNCION PARA MOSTRAR UN MENSAJE
function fnc_msgGritter(){
	if(isset($_SESSION['MSG'])){
		echo '<script type="text/javascript">msgGritter("'.$_SESSION['MSG'].'","'.$_SESSION['MSGdes'].'","'.$_SESSION['MSGimg'].'");</script>';
		unset($_SESSION['MSG']);
		unset($_SESSION['MSGdes']);
		unset($_SESSION['MSGimg']);
	}
}
//LISTA LOS EMPLEADOS AGRUPADOS POR SUCURSAL
function fnc_listEmp($id_user=NULL, $clase=NULL, $id=NULL, $opt=NULL){
	include(RUTAcon.'conexion-mysql.php');
	
	if(!isset($id_user)){
		$sql_1 = "SELECT * FROM sucursal WHERE suc_eliminado = 'N' ORDER BY suc_id";
		$query_1 = mysql_query($sql_1, $conexion_mysql) or die(mysql_error());
		
		$sql_2 = "SELECT * FROM persona INNER JOIN empleado ON persona.per_id = empleado.per_id WHERE empleado.emp_id NOT IN (SELECT emp_id FROM usuarios) AND empleado.emp_eliminado = 'N'";
		$query_2 = mysql_query($sql_2, $conexion_mysql) or die(mysql_error());
		$tot_rows = mysql_num_rows($query_2);
		if($tot_rows>0) $txt = 'Seleccione un empleado';
		else $txt = 'No existen empleados';
		
		echo '<select class="'.$clase.'" id="'.$id.'" name="'.$id.'" '.$opt.'>';
		echo '<option disabled selected>'.$txt.'</option>';
		while($rows_1 = mysql_fetch_array($query_1)){
			echo '<optgroup label="'.$rows_1['suc_nombre'].'">';
			$sql_2 = "SELECT * FROM persona INNER JOIN empleado ON persona.per_id = empleado.per_id WHERE empleado.emp_id NOT IN (SELECT emp_id FROM usuarios) AND empleado.suc_id ='".$rows_1['suc_id']."' AND empleado.emp_eliminado = 'N'";
			$query_2 = mysql_query($sql_2, $conexion_mysql) or die(mysql_error());	
			while($rows_2 = mysql_fetch_array($query_2)){
				echo '<option value="'.$rows_2['emp_id'].'">'.$rows_2['per_nombre'].'</option>';
			}
			echo '<optgroup>';
		}
		echo '</select>';
		mysql_free_result($query_1);
		mysql_free_result($query_2);
	}else{
		$sql = "SELECT * FROM persona INNER JOIN empleado ON persona.per_id = empleado.per_id INNER JOIN usuarios ON empleado.emp_id = usuarios.emp_id WHERE usuarios.usr_id = '".$id_user."'";
		$query = mysql_query($sql, $conexion_mysql) or die(mysql_error());
		$row = mysql_fetch_assoc($query);		
		echo '<select class="'.$clase.'" id="'.$id.'" name="'.$id.'">';
		echo '<option value="'.$row['emp_id'].'" selected>'.$row['per_nombre'].'</option>';
		echo '</select>';
		mysql_free_result($query);
	}
}
//DATOS PERSONALES
function fnc_datPer($id){
	include(RUTAcon.'conexion-mysql.php');
	$sql = sprintf("SELECT * FROM persona WHERE per_id = %s", GetSQLValueString($id, "int"));
	$query = mysql_query($sql, $conexion_mysql) or die(mysql_error());
	$row = mysql_fetch_assoc($query);
	return $row; 
	mysql_free_result($query);
}
//DATOS EMPLEADO
function fnc_datEmp($id){
	include(RUTAcon.'conexion-mysql.php');
	$sql = sprintf("SELECT * FROM empleado WHERE emp_id = %s AND emp_eliminado='N'", GetSQLValueString($id, "int"));
	$query = mysql_query($sql, $conexion_mysql) or die(mysql_error());
	$row = mysql_fetch_assoc($query);
	return $row; 
	mysql_free_result($query); 
}
//DATOS USUARIO
function fnc_datUsu($id){ 
	include(RUTAcon.'conexion-mysql.php');
	$sql = sprintf("SELECT * FROM usuarios WHERE usr_id = %s AND usr_eliminado='N'", GetSQLValueString($id, "int"));
	$query = mysql_query($sql, $conexion_mysql) or die(mysql_error());
	$row = mysql_fetch_assoc($query);
	return $row;
	mysql_free_result($query);
}
//DATOS PACIENTE
function fnc_datPac($id){
	include(RUTAcon.'conexion-mysql.php');
	$sql = sprintf("SELECT * FROM paciente WHERE per_id = %s AND pac_eliminado='N'", GetSQLValueString($id, "int"));
	$query = mysql_query($sql, $conexion_mysql) or die(mysql_error());
	$row = mysql_fetch_assoc($query);
	return $row; 
	mysql_free_result($query); 
}
//DATOS SUCURSAL
function fnc_datSuc($id){
	include(RUTAcon.'conexion-mysql.php');
	$sql = sprintf("SELECT * FROM sucursal WHERE suc_id = %s AND suc_eliminado='N'", GetSQLValueString($id, "int"));
	$query = mysql_query($sql, $conexion_mysql) or die(mysql_error());
	$row = mysql_fetch_assoc($query);
	return $row;
	mysql_free_result($query);
}
//DATOS SUCURSAL CON EMPLEADO
function fnc_datSucEmp($id){
	include(RUTAcon.'conexion-mysql.php');
	$sql = sprintf("SELECT sucursal.suc_id FROM sucursal inner join  empleado  on empleado.suc_id=sucursal.suc_id WHERE empleado.emp_id=%s", 
	GetSQLValueString($id, "int"));
	$idsuc = mysql_query($sql, $conexion_mysql) or die(mysql_error());
	return $idsuc;
	
}
//DATOS TRATAMIENTO
function fnc_datTra($id){
	include(RUTAcon.'conexion-mysql.php');
	$sql = sprintf("SELECT * FROM tratamientos WHERE tra_id = %s AND tra_eliminado='N'", GetSQLValueString($id, "int"));
	$query = mysql_query($sql, $conexion_mysql) or die(mysql_error());
	$row = mysql_fetch_assoc($query);
	return $row;
	mysql_free_result($query);
}
//CALCULA LA EDAD
function fnc_calEdad($fec_nac){
    list($ano,$mes,$dia) = explode("-",$fec_nac);
    $ano_diferencia  = date("Y") - $ano;
    $mes_diferencia = date("m") - $mes;
    $dia_diferencia   = date("d") - $dia;
    if ($dia_diferencia < 0 || $mes_diferencia < 0)
        $ano_diferencia--;
    return $ano_diferencia;
}
?>