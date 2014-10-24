<?php 
	if (!isset($_SESSION)) session_start();
	include('../../../start.php');
	fnc_autentificacion();
$qryJson="SELECT * FROM calendario";
$RSjson = mysql_query($qryJson) or die(mysql_error());
while($row = mysql_fetch_array($RSjson)){
	$datos[] = array(
		'id' => $row['id'],
		'title' => $row['nombre'],
		'start' => $row['fechai'].'T'.$row['horai'].$row['zona'],
		'end' => $row['fechaf'].'T'.$row['horaf'].$row['zona'],
		'color' => '#f00',
		'url' => $row['url']
	);
}
echo json_encode($datos);