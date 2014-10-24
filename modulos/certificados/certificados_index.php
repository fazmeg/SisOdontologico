<?php 
	if (!isset($_SESSION)) session_start();
	include('../../start.php');
	fnc_autentificacion();	
	$cer_val= fnc_varGetPost('cer_val');
	$paci2= fnc_varGetPost('pac');
	$id_user = $_SESSION['id_usuario'];
	$id_emp = $_SESSION['id_empleado'];
	$empleado = fnc_datEmp($id_emp);
	$persona = fnc_datPer($empleado['per_id']);
	$sucursal = fnc_datSuc($empleado['suc_id']);
	$paci= $_POST['pac'];
	//$certificado = fnc_datGeneral(1,'cer_id','certificados');
	
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8"></meta>
	<title>Certificado OdontoClinic</title>
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
                    <h3>   Gestor de Certificados   </h3>
                </td>
                <td>
               <form class="navbar-search pull-left" method="post" name="fbuscar" id="fbuscar" action="certificados_index.php">
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
                 <?php /* Consulta uno */
		 				$sql = sprintf("SELECT * FROM persona INNER JOIN paciente ON persona.per_id = paciente.per_id INNER JOIN telefono  ON persona.per_id = telefono.per_id WHERE paciente.pac_eliminado = 'N' AND paciente.pac_id = '".$paci."' group by persona.per_id");
							$query = mysql_query($sql, $conexion_mysql) or die(mysql_error());
							$row = mysql_fetch_assoc($query);
							$tot_rows = mysql_num_rows($query);
							
												
						?>
               	 </td>
                <td>
              </td>
            </tr>
        </table>
        </div>
        <script  type="text/javascript">
        function certificado(idp,idc){
			$("#contFormat").load("tmce.php?idp="+idp+"&idc="+idc);
		}
        </script>
		
        <a id="cer"></a>
        <div class="row-fluid">
        	<div class="span8">
                <ul class="breadcrumb">
                    <li class="active"><i class="icon-home"></i> Certificado Medico</li>
                </ul>
			</div>
            <div class="span4">
            	<a href="<?php echo $RUTAm; ?>historia_clinica/historia-clinica-form.php" class="btn btn-primary btn-large btn-block"><strong> NUEVO CERTIFICADO MEDICO</strong></a>
            </div>
		</div>
		<div class="portlet-body">
			<div class="row-fluid">
				<div class="alert alert-info">
                <div class="row-fluid">
					<div class="span4">
                    	<h4><i class="icon-list"></i> REPORTE MEDICO <span class="badge"></span></h4>
                    </div>
                    <div class="span4">
                    	<h4>De: 
						<?php
						echo $row['per_nombre'];
						?>
                        </h4>
                    </div>
                    <div class="span4" align="right">
                    <div class="btn-group">
                      <a class="btn btn-inverse dropdown-toggle" data-toggle="dropdown" href="#">
                        Formato de Certificado
                        <span class="caret"></span>
                      </a>
                      <ul class="dropdown-menu" style="">
                        <!-- dropdown menu links -->
                       
                         <li ><a id="btn_cer1" class="btn" onClick="certificado('<?php echo $paci ?>',1)"> Certificado Normal</a></li>
                         <li><a id="btn_cer2" class="btn" onClick="certificado('<?php echo $paci ?>',2)"> Certificado Reposo</a></li>
                      </ul>
                    </div>
                    </div>
				</div>
                </div>
                 <br>
                 <div class="control-group well" id="contFormat">
                     <h5 style="color:#036"> <i class="icon-file"></i> SELECIONE UN CERTIFICADO PARA SU PACIENTE</h5>
                 </div>
			</div>
        </div>        			
	</div>     	     
</div>

<div>

<?php  // echo $certificado['cer_des']; ?>
</div>
</body>
<footer>	
</footer>
</html>