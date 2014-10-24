<?php 
	if (!isset($_SESSION)) session_start();
	include('../../start.php');
	fnc_autentificacion();
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8"></meta>
	<title>Crear paciente</title>
    <?php include(RUTAp.'jquery/styl-jquery.php'); ?>
    <?php require_once(RUTAs.'styles/styl-bootstrap.php'); ?>    
    
</head>
<body>
	<?php include(RUTAcom.'menu-principal.php');
	$sql = sprintf("SELECT * FROM persona inner join paciente on persona.per_id = paciente.per_id WHERE paciente.pac_eliminado = 'N'");
	$query = mysql_query($sql, $conexion_mysql) or die(mysql_error());
	$row = mysql_fetch_assoc($query);
	$tot_rows = mysql_num_rows($query); 
	fnc_msgGritter();?>
    
	<div class="container">
		<div class="page-header"><h3>ADMINISTRACIÓN DE PACIENTES</h3></div>
        <div class="row-fluid">
        	<div class="span8">
                <ul class="breadcrumb">
                    <li class="active"><i class="icon-home"></i> Administración de Pacientes</li>
                </ul>
			</div>
            <div class="span4">
            	<a href="<?php echo $RUTAm; ?>pacientes/pacientes-form.php" class="btn btn-primary btn-large btn-block"><strong> NUEVO PACIENTE</strong></a>	
            </div>
        </div>
		<div class="portlet-body">			
			<div class="row-fluid">
            	<div class="span5">
                	<div class="alert alert-info">
                        <h4><i class="icon-list"></i> Lista de pacientes registrados <span class="badge"><?php echo $tot_rows; ?></span></h4>
					</div>
				</div>			
			</div>
            <?php if($tot_rows > 0)	{ ?> 
            <div class="row-fluid">           	          		
			<table class="table table-bordered table-condensed table-striped" id="tab_usr">
				<thead>
					<tr>
						<th></th>
						<th>Paciente</th>
						<th>Cédula</th>
						<th>Nacionalidad</th>
						<th>Direccion</th>
						<th>Foto</th>
					</tr>
				</thead>
				<tbody>
					   <?php do { 
					$dat_per = fnc_datPer($row['per_id']); 
					$dat_pac = fnc_datPac($row['per_id']);
					
					$src_img=$RUTAidb.'personas/'.$row['per_foto'];
					$src_imgS=RUTAidb.'personas/'.$row['per_foto'];
					
					if ((file_exists($src_imgS))&&($row['per_foto'])) {
						$per_img='<img src="'.$src_img.'" class="img-sm">';
					}else{
						$per_img='<img src="'.$RUTAidb.'no.jpg" class="img-sm">';
					}					
					 ?>                             
					<tr>
						<td>
							<div class="btn-group list">
                            
								<a href="<?php echo $RUTAm; ?>pacientes/pacientes-form.php?per_id=<?php echo $row['per_id']; ?>" class="btn btn-primary btn-mini"><i class="icon-edit"></i> Editar</a>
                                
								<a href="<?php echo $RUTAm; ?>pacientes/funciones/pacientes-fncs.php?per_id=<?php echo $row['per_id']; ?>&accion=Eliminar" class="btn btn-danger btn-mini" onClick="javascript:return confirm('¿Esta seguro que desea eliminar a <?php echo $dat_per['per_nombre ']; ?>?');"><i class="icon-trash"></i> Eliminar</a>
                                
                                
							</div>
						</td>
						<td><?php echo $row['per_nombre']; ?></td>
						<td><?php echo $row['per_documento']; ?></td>
						<td><?php echo $row['per_nacionalidad']; ?></td>
						<td><?php echo $row['per_direccion1']; ?></td>
						<td align="center"><?php echo $per_img; ?></tr>
					<?php } while ($row = mysql_fetch_assoc($query)); ?>
				</tbody>
			</table>
            </div>        			
			<?php mysql_free_result($query);
			}else{ echo '<div class="alert alert-error"><h4>No existen pacientes registrados.</h4></div>'; } ?>
		</div>     	     
	</div>
</body>
<footer>	
</footer>
</html>