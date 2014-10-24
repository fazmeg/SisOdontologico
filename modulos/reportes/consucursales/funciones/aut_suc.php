<?php
require_once('../../../../start.php');
$query_RSjson='SELECT * FROM sucursal WHERE (suc_id LIKE"%'.$_REQUEST['term'].'%" OR suc_nombre LIKE"%'.$_REQUEST['term'].'%") AND  suc_eliminado = "N"';
$RSjson = mysql_query($query_RSjson) or die(mysql_error());

while($row = mysql_fetch_array($RSjson)){
    $datos[] = array(
        'code' => $row['suc_id'],
        'value' => $row['suc_nombre'],
        'label' => $row['suc_nombre'] //Esto Muestra
    );
}
echo json_encode($datos);
?>