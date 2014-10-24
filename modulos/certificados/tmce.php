<?php 
	if (!isset($_SESSION)) session_start();
	include('../../start.php');
	fnc_autentificacion();
	
	$idp=$_GET['idp'];
    $idc=$_GET['idc'];
	
	if($idc==1){
		$cerSel=RUTAm.'certificados/PlantillasCertificados/certificado1.php';
	}else if($idc==2){
		$cerSel=RUTAm.'certificados/PlantillasCertificados/certificado2.php';
	}
	
	$id_emp = $_SESSION['id_empleado'];
	$empleado = fnc_datEmp($id_emp);
	$persona = fnc_datPer($empleado['per_id']);
	$sucursal = fnc_datSuc($empleado['suc_id']);
	$paci= $_POST['pac'];
	
	//$certificado = fnc_datGeneral(1,'cer_id','certificados');
	
						?>
						<?php /* Consulta uno */
												$sql = sprintf("SELECT * FROM persona INNER JOIN paciente ON persona.per_id = paciente.per_id INNER JOIN telefono  ON persona.per_id = telefono.per_id WHERE paciente.pac_eliminado = 'N' AND paciente.pac_id = '".$idp."' group by persona.per_id");
							$query = mysql_query($sql, $conexion_mysql) or die(mysql_error());
							$row = mysql_fetch_assoc($query);
							$tot_rows = mysql_num_rows($query);
							
												
						?>
						<form action="<?php echo $RUTAm; ?>correo/enviar_correo_cer.php" method="post">
						<div class="row-fluid">
                        <div class="span4" align="left">
                        <strong>
                        <?php echo "PACIENTE: ".$row['per_nombre']; ?>
                        </strong>
                        </div>
            			<div class="span4" align="center">
                        <strong>
                        <?php echo "ID: ".$idp; ?>
                        </strong>
                        </div>
            			<div class="span4"align="right">
                        <strong>
						<?php echo "CORREO: ".$row['per_mail']; ?>
                        </strong>
                        </div>
            			
                        </div>
            			
                        <textarea class="ckeditor" cols="80"  name="contenido" id="contenido" rows="200" style="height:1600px;">
						
						<?php 
						include($cerSel);?>
						</textarea>
				        <script type=”text/javascript”>
           				CKEDITOR.replace ("contenido");
          				</script></p>
                        <p>
                        <input type="hidden" id="destinatario" name="destinatario" value="<?php echo $row['per_mail']; ?>"/>
                        <input type="hidden" id="asunto" name="asunto" value="<?php echo 'Certificado medico del paciente: '.$row['per_nombre'].' el '.date("d-m-Y");?> "/>
                        
                            <input class="btn btn-primary" type="submit" value="Enviar a correo Electrónico" />
                        </p>
                    </form>