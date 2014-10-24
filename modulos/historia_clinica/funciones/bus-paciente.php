<?php
	if (!isset($_SESSION)) session_start();
	include('../../../start.php');
	fnc_autentificacion();
	$die_id=$_POST['die_id'];
	$per_id=$_POST['per_id'];
	
	$sql = sprintf("SELECT * FROM detalle_die_per inner join persona on persona.per_id=detalle_die_per.per_id where die_id=".$die_id." and detalle_die_per.per_id=".$per_id);
	$query = mysql_query($sql, $conexion_mysql) or die(mysql_error());
		while($rows = mysql_fetch_array($query)){
		$datos[] = array('det_die_per_id' => $rows['det_die_per_id'], 'det_die_per_des_ini' => $rows['det_die_per_des_ini']);
	}	
	
	echo json_encode($datos);
	return($datos);
?>
