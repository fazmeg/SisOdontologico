<?php 
	if (!isset($_SESSION)) session_start();
	include('../../../start.php');
	fnc_autentificacion();	
	$id_emp = $_SESSION['id_empleado'];
	$empleado = fnc_datEmp($id_emp);
	$sucursal = fnc_datSuc($empleado['suc_id']);
?>

<?php
$per_doc = $_GET['per_doc'];
$sectip = $_GET['sectip'];
$boton="";
if($sectip==1){
	$sql = sprintf("SELECT * FROM persona inner join paciente on paciente.per_id=persona.per_id where per_documento=".$per_doc);
	$query = mysql_query($sql, $conexion_mysql) or die(mysql_error());
	$row = mysql_fetch_assoc($query);
	$tot_rows = mysql_num_rows($query);
}else
{
	$sql = sprintf("SELECT * FROM persona inner join paciente on paciente.per_id=persona.per_id");
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
						<th style="width:5px"></th>
						<th>CI/RUC</th>
						<th>Nombre</th>
						<th>Email</th>
                        <th>Teléfono</th>										
					</tr>
				</thead>
				<tbody>
					<?php do { 
					// Consuta 1 para buscar los telefonos del paciente.
					$sqlt = sprintf("SELECT * FROM telefono WHERE telefono.per_id = '".$row["per_id"]."' AND tel_eliminado='N'");
					$queryT = mysql_query($sqlt, $conexion_mysql) or die(mysql_error());
					$rowT = mysql_fetch_assoc($queryT);
					$tot_rowsT = mysql_num_rows($queryT);
					
					
					?>
                    
					<tr>
						<td><i class="icon-user"></i></td>
						<td><?php echo $row['per_documento']; ?></td>
						<td><?php echo $row['per_nombre']; ?></td>
						<td><?php echo $row['per_mail']; ?></td>
                        <td>
                        <?php if($tot_rowsT > 0)	{ ?>
                            <div class="row-fluid">
                            <table class="table table-bordered table-condensed table-striped" id="tab_usr">
                                <thead>
                                    <tr>
                                        <th style="width:90px">Tipo</th>
                                        <th style="text-align:center">Número</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php do { ?>
                                    <tr>
                                        <td><?php echo $rowT['tel_tipo']; ?></td>
                                        <td style="text-align:center"><?php echo $rowT['tel_numero']; ?></td>
                                    </tr>
                                    <?php 
                                    } while ($rowT = mysql_fetch_assoc($queryT)); 
                                    ?>
                                </tbody>
                            </table>
                            </div>        			
                            <?php mysql_free_result($queryT);
                            }else{ echo '<div class="alert "><h4>No tiene teléfonos</h4></div>'; } ?>
                        </td>
						
					</tr>
					<?php } while ($row = mysql_fetch_assoc($query)); ?>
				</tbody>
			</table>
            </div>        			
			<?php mysql_free_result($query);
			}else{ echo '<div class="alert alert-error"><h4>No existen pacientes registrados en el sistema.</h4></div>'; } ?>


<script>
function imp()
{ 
			window.open( "PDF.php" , "Reporte de Pacientes" , "width=800 , height = 600");
}
</script>
