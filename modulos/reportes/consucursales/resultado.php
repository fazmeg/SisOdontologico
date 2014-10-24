<?php 
	if (!isset($_SESSION)) session_start();
	include('../../../start.php');
	fnc_autentificacion();	
	$id_emp = $_SESSION['id_empleado'];
	$empleado = fnc_datEmp($id_emp);
	$sucursal = fnc_datSuc($empleado['suc_id']);
?>

<?php
$suc_id = $_GET['suc_id'];
$sectip = $_GET['sectip'];
$boton="";
if($sectip==1){
	$sql = sprintf("SELECT * FROM sucursal where suc_id=".$suc_id);
	$query = mysql_query($sql, $conexion_mysql) or die(mysql_error());
	$row = mysql_fetch_assoc($query);
	$tot_rows = mysql_num_rows($query);
}else
{
	$sql = sprintf("SELECT * FROM sucursal");
	$query = mysql_query($sql, $conexion_mysql) or die(mysql_error());
	$row = mysql_fetch_assoc($query);
	$tot_rows = mysql_num_rows($query);
    $boton="<div class='well' align='center'><button class='btn btn-info' id='imprimir' name='imprimir' onClick='imp()'> <i class='icon-print'></i> <strong>  Imprimir  </strong></button></div><br>";
}
echo $boton;
?>


            <?php if($tot_rows > 0)	{ ?>
            <div class="row-fluid">
			<table class="table table-bordered table-condensed table-striped" id="tab_usr">
				<thead>
					<tr>
						<th>Nombre</th>
                        <th>Ciudad</th>
						<th>Dirección</th>
						<th>Cod. Postal</th>
                        <th>Teléfono</th>										
					</tr>
				</thead>
				<tbody>
					<?php do {?>
                    
					<tr>
						<td><?php echo $row['suc_nombre']; ?></td>
						<td><?php echo $row['suc_ciudad']; ?></td>
                        <td><?php echo $row['suc_direccion']; ?></td>
						<td><?php echo $row['suc_postal']; ?></td>
                        <td><?php echo $row['suc_telefono']; ?></td>
                      	</tr>
                        <?php } while ($row = mysql_fetch_assoc($query)); ?>
				</tbody>
			</table>
            </div>        			
			<?php mysql_free_result($query);
			}else{ echo '<div class="alert alert-error"><h4>No existen sucursales registradas en el sistema.</h4></div>'; } ?>


<script>
function imp()
{ 
			window.open( "PDF.php" , "Reporte de Pacientes" , "width=800 , height = 600");
}
</script>
