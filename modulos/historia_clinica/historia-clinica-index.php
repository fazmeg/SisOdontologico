<?php 
	if (!isset($_SESSION)) session_start();
	include('../../start.php');
	fnc_autentificacion();	
	$id_emp = $_SESSION['id_empleado'];
	$paci= $_POST['pac'];

?>
<!doctype html>
<html>
<head>

	<meta charset="utf-8"></meta>
	<title>Historia Clínicas</title>
    <?php include(RUTAp.'jquery/styl-jquery.php'); ?>
    <?php require_once(RUTAs.'styles/styl-bootstrap.php'); ?>
    <script type="text/javascript">
		$(document).on('ready', function(){
			$("#pac").autocomplete({
				source: 'funciones/bus-paciente.php',
				minLength: 1,
				autoFocus: true
			});
			$("#pac").chosen({});
		});
	</script> 
</head>
<body>
	<?php include(RUTAcom.'menu-principal.php'); 
	fnc_msgGritter();
	?>
	<div class="container">
		<div class="page-header">
        <table>
        	<tr>
                <td style="width:550px">
                    <h3>   Gestor de Historias Clínicas</h3>
                </td>
                <td>
                <form class="navbar-search pull-left" method="post" name="fbuscar" id="fbuscar" action="historia-clinica-index.php">
                   <table cellspacing="2">
                      <tr>
                        <td>
                            <!--- Chosen  de busqueda de Paciente -->
                            <div class="control-group">
                                <div class="controls" id="chosen_pac" style="height:15px">
                                    <?php fnc_listPac($id_user,'input-block-level', 'pac', 'autofocus required'); ?>
                                </div>  
                            </div>
                        </td>
                        <td>
                        	<button class="btn btn-primary" type="submit" style="height:30px"> <i class="icon-search"> </i></button>
                        </td>
                      </tr>
                    </table>
               	 </form> 
               	 </td>
                <td>
              </td>
            </tr>
        </table>
        </div>
         <?php /* Consulta uno */
		 				$sql = sprintf("SELECT * FROM persona INNER JOIN paciente ON persona.per_id = paciente.per_id INNER JOIN telefono  ON persona.per_id = telefono.per_id WHERE paciente.pac_eliminado = 'N' AND paciente.pac_id = '".$paci."' group by persona.per_id");
							$query = mysql_query($sql, $conexion_mysql) or die(mysql_error());
							$row = mysql_fetch_assoc($query);
							$tot_rows = mysql_num_rows($query);
						
						?>
        <div class="row-fluid">
        	<div class="span12">
                <ul class="breadcrumb">
                    <li class="active"><i class="icon-home"></i> Historia Clínica</li>
                </ul>
			</div>
            
		</div>
		<div class="portlet-body">
			<div class="row-fluid">
				<div class="alert alert-info">
					<h4><i class="icon-list"></i> Paciente<span class="badge"></span></h4>
				</div>
			</div>
            <?php if($tot_rows > 0)	{ ?>
            <div class="row-fluid">
			<table class="table table-bordered table-condensed table-striped" id="tab_usr" style="text-align:center">
				<thead>
					<tr>
						<th width="125px"></th>
						<th>Id</th>
						<th>Nombre</th>
                        <th>Cédula o RUC</th>
						<th>E-Mail</th>
                        <th>Foto</th>
					</tr>
				</thead>
				<tbody >
					<?php do {
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
                            <div class="btn-group">
                        		<a href="<?php echo $RUTAm; ?>historia_clinica/historia_clinica_form.php?per_id=<?php echo $row['per_id']; ?>&accion=Ver" class="btn btn-primary btn-mini"><i class="icon-folder-open"></i> Ver Historial</a>
                        	</div>
						</td>
						<td><?php echo $row['per_id']; ?></td>
						<td><?php echo $row['per_nombre']; ?></td>
                        <td><?php echo $row['per_documento']; ?></td>
						<td><?php echo $row['per_mail']; ?></td>
                        <td><?php echo $per_img; ?></td>
                        </tr>
					<?php 
					} while ($row = mysql_fetch_assoc($query)); 
					?>
				</tbody>
			</table>
            </div>        			
			<?php mysql_free_result($query);
			}else{ echo '<div class="alert "><h4>Buscar Historial de Paciente a Atender</h4></div>'; } ?>
		</div>     	     
	</div>
</body>
<footer>	
</footer>
</html>