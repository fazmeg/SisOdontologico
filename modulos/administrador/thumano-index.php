<?php 
	if (!isset($_SESSION)) session_start();
	include('../../start.php');
	fnc_autentificacion();	
	$id_emp = $_SESSION['id_empleado'];
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8"></meta>
	<title>Gestión de talento humano</title>
    <?php include(RUTAp.'jquery/styl-jquery.php'); ?>
    <?php require_once(RUTAs.'styles/styl-bootstrap.php'); ?>
</head>
<body>
	<?php include(RUTAcom.'menu-principal.php'); 
	$sql = sprintf("SELECT * FROM empleado WHERE emp_eliminado = 'N' ORDER BY emp_id DESC");
	$query = mysql_query($sql, $conexion_mysql) or die(mysql_error());
	$row = mysql_fetch_assoc($query);
	$tot_rows = mysql_num_rows($query); 
	
	fnc_msgGritter();?>
    
	<div class="container">
		<div class="page-header"><h3>ADMINISTRACIÓN DE TALENTO HUMANO</h3></div>
        <div class="row-fluid">
        	<div class="span8">
                <ul class="breadcrumb">
                    <li class="active"><i class="icon-home"></i> Administración de talento humano</li>
                </ul>
			</div>
            <div class="span4">
            	<a href="<?php echo $RUTAm; ?>administrador/thumano-form.php" class="btn btn-primary btn-large btn-block"><strong> NUEVO TALENTO HUMANO</strong></a>
            </div>
		</div>
		<div class="portlet-body">
			<div class="row-fluid">
				<div class="alert alert-info">
					<h4><i class="icon-list"></i> Lista de talento humano <span class="badge"><?php echo $tot_rows; ?></span></h4>
				</div>
			</div>
            <div class="row-fluid">
            <?php if($tot_rows > 0)	{ ?>
			<table class="table table-bordered table-condensed table-striped" id="tab_emp">
				<thead>
					<tr>
						<th width="125px"></th>
						<th>Id</th>
						<th>Nombres</th>
                        <th>Profesión</th>
                        <th>Actividad</th>
                        <th>Sucursal</th>
                        <th>Nacionalidad</th>
                        <th>Fecha de ingreso</th>
                        <th>Sueldo</th>
						<th>Edad</th>
					</tr>
				</thead>
				<tbody>
					<?php do {
					$persona = fnc_datPer($row['per_id']);					
					$edad = fnc_calEdad($persona['per_fec_nac']);
					$sucursal = fnc_datSuc($row['suc_id']); 
					$telefono = fnc_datTel($row['per_id']); ?>
					<tr>
						<td>
                            <div class="btn-group">
                        		<a href="<?php echo $RUTAm; ?>administrador/thumano-form.php?idEmp=<?php echo $row['emp_id']; ?>" class="btn btn-primary btn-mini"><i class="icon-edit"></i> Editar</a>
                        		<?php if($row['emp_id']!=$id_emp){ //Un empleado logeado no se puede eliminar ?>
								<a href="<?php echo $RUTAm; ?>administrador/funciones/thumano-fncs.php?idEmp=<?php echo $row['emp_id']; ?>&accion=Eliminar" class="btn btn-danger btn-mini" onClick="javascript:return confirm('¿Esta seguro que desea eliminar a <?php echo $persona['per_nombre']; ?>?');"><i class="icon-trash"></i> Eliminar</a>
                                <?php } ?>
                    		</div>
						</td>
						<td><?php echo $row['emp_id']; ?></td>
						<td><?php echo $persona['per_nombre']; ?></td>
                        <td><?php echo $row['emp_profesion']; ?></td>
                        <td><?php echo $row['emp_actividad']; ?></td>
                        <td><?php echo $sucursal['suc_nombre']; ?></td>
                        <td><?php echo $persona['per_nacionalidad']; ?></td>
                        <td><?php echo $row['emp_fecha_ingreso']; ?></td>
                        <td><?php echo $row['emp_sueldo']; ?></td>
						<td><?php echo $edad; ?></td>
					</tr>
					<?php } while ($row = mysql_fetch_assoc($query)); ?>
				</tbody>
			</table>
			<?php mysql_free_result($query);
			}else{ echo '<div class="alert alert-error"><h4>No existen empleados registrados.</h4></div>'; } ?>
            </div>
		</div>
	</div>
</body>
<footer>	
</footer>
</html>