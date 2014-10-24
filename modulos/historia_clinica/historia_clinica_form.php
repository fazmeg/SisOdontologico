<?php 
	if (!isset($_SESSION)) session_start();
	include('../../start.php');
	fnc_autentificacion();
	$per_id = fnc_varGetPost('per_id');
	$datpac = fnc_datPer($per_id);
	$dattelpac=fnc_datTelPac($per_id);
	$empleado = fnc_datEmp($id_emp);
	$sucursal = fnc_datSuc($empleado['suc_id']);
	if($datpac){
		$accion = 'Ver';
		$button = '<input type="submit" class="btn btn-primary" name="btnGuardar" id="btnGuardar" value="Ver">';
	}else{
		$accion = 'Tratamiento';
		$button='<input type="submit" class="btn btn-primary" name="btnGuardar" id="btnGuardar" value="Tratamiento">';
	}
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8"></meta>
	<title>Historia Clínicas</title>
    <?php include(RUTAp.'jquery/styl-jquery.php'); ?>
    <?php require_once(RUTAs.'styles/styl-bootstrap.php'); ?>
  </head>
<body>
	<script>
$('.textarea').wysihtml5();
</script>
<script type="text/javascript" charset="utf-8">
	$(prettyPrint);
</script>
	<?php include(RUTAcom.'menu-principal.php'); 
	fnc_msgGritter();
	?>
 <div class="container">
		<div class="page-header"><h3><?php echo strtoupper($accion); ?> HISTORÍA CLÍNICA</h3></div>
		<div class="row-fluid">
        	<div class="span8">
                <ul class="breadcrumb">
                    <li>
                        <i class="icon-home"></i>
                        <a href="<?php echo $RUTAm; ?>historia_clinica/historia-clinica-index.php"> Historia Clínica</a>
                        <span class="divider">/</span>
                    </li>
                    <li class="active"><?php echo $accion; ?> Historia Clínica</li>
                </ul>
			</div>
            <div class="span4">
            	<strong><label  style="font-size:22px; font-style:oblique"><?php
$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
echo $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;
?></strong>
            </div> 

		</div>
        <?php 
					
		if($datpac['per_sexo']=='M')
		{$Sexo='Masculino';}
		else
		{$Sexo='Femenino';}
		// Consuta 1 para buscar los telefonos del paciente.
		$sql = sprintf("SELECT * FROM telefono WHERE telefono.per_id = '".$per_id."' AND tel_eliminado='N'");
		$query = mysql_query($sql, $conexion_mysql) or die(mysql_error());
		$row = mysql_fetch_assoc($query);
		$tot_rows = mysql_num_rows($query);
		// Consuta 2 para buscar Categorias-Tratamientos-Precios.
		$sql2 = sprintf("Select * from tra_categorias inner join  tratamientos on tratamientos.tra_cat_id = tra_categorias.tra_cat_id inner join precios on tratamientos.tra_id = precios.tra_id");
		$query2 = mysql_query($sql2, $conexion_mysql) or die(mysql_error());
		$row2 = mysql_fetch_assoc($query2);
		$tot_rows2 = mysql_num_rows($query);
		?>
		<div class="row-fluid">
       		<div class="span5">
                <div class="control-group well">
                	<h3 style="color:#009">Paciente: <?php echo $datpac['per_nombre']; ?></h3>
                    <h4>Cédula: <?php echo $datpac['per_documento']; ?></h4>
                    <h4>Correo: <?php echo $datpac['per_mail']; ?></h4>
                    <h4>Sexo: <?php echo $Sexo;?></h4>
                    <h4>Nacido: <?php echo $datpac['per_fec_nac'];?>
                    </h4>
                </div>
            </div>
        <div class="span4">
        	<div class="control-group well">
				<?php if($tot_rows > 0)	{ ?>
                <div class="row-fluid">
                <table class="table table-bordered table-condensed table-striped" id="tab_usr">
                    <thead>
                        <tr>
                            <th>Tipo</th>
                            <th>Número</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php do { ?>
                        <tr>
                            <td><?php echo $row['tel_tipo']; ?></td>
                            <td><?php echo $row['tel_numero']; ?></td>
                        </tr>
                        <?php 
                        } while ($row = mysql_fetch_assoc($query)); 
                        ?>
                    </tbody>
                </table>
                </div>        			
                <?php mysql_free_result($query);
                }else{ echo '<div class="alert "><h4>No tiene teléfonos</h4></div>'; } ?>
            </div>     	     
        </div>
        <div class="span3">
       			<div class="control-group well" style="height:200px">
                <?php 
						$src_img=$RUTAidb.'personas/'.$datpac['per_foto'];
							$src_imgS=RUTAidb.'personas/'.$datpac['per_foto'];
							if ((file_exists($src_imgS))&&($datpac['per_foto'])) {
									$per_img='<img src="'.$src_img.'" class="img-mm">';
							}else{
								$per_img='<img src="'.$RUTAidb.'no.jpg" class="img-mm">';
							}
				?>
                <table cellspacing="2">
                  <tr>
                    <td><?php echo $per_img; ?></td>
                  </tr>
                </table>
                </div>
            </div> 
    	</div>
    </div>
    <div>
    <?php include "hc_contenido.php";     ?>
    </div>

<body>
</body>
</html>