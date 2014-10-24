<?php
	if (!isset($_SESSION)) session_start();
	include('../../../start.php');
	fnc_autentificacion();
	$tra_id=$_POST['tra_id'];
	$per_id=$_POST['per_id'];
	
	$sql = sprintf("SELECT * FROM detalle_tratamientosxrealizar where tra_id=".$tra_id." and per_id=".$per_id);
	$query = mysql_query($sql, $conexion_mysql) or die(mysql_error());
		
	while($rows = mysql_fetch_array($query)){
		$datos_tra[] = array('det_tra_rea_id' => $rows['det_tra_rea_id'], 'tra_rea_fec' => $rows['tra_rea_fec']);
	}	
	
	echo json_encode($datos_tra);
	return($datos_tra);
  
?>
