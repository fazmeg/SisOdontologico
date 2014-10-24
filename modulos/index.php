<?php 
	if (!isset($_SESSION)) session_start();
	include('../start.php');
	fnc_autentificacion();

	$id_user = $_SESSION['id_usuario'];
	$id_emp = $_SESSION['id_empleado'];
	$empleado = fnc_datEmp($id_emp);
	$persona = fnc_datPer($empleado['per_id']);
	$sucursal = fnc_datSuc($empleado['suc_id']);
	
	function date_ame2euro($date=NULL){ if(!$date) $datef=date('d-m-Y');
 	else $datef=date("d-m-Y",strtotime($date)); 
 	return $datef;
  }
?>
<!doctype html>
<html>
<head>
<script>
$('a[data-toggle="tab"]').on('shown', function (e) {
  e.target // activated tab
  e.relatedTarget // previous tab
  
})
</script>
	<meta charset="utf-8">
	<title>Inicio</title>
    <?php include(RUTAp.'jquery/styl-jquery.php'); ?>
    <?php include(RUTAs.'styles/styl-bootstrap.php'); ?>
<style type="text/css">
.container .rowfluid .span6 .well.well-large .span3 {
	font-family: Cambria, Hoefler Text, Liberation Serif, Times, Times New Roman, serif;
}
</style>
</head>    
<body>
	<?php include(RUTAcom.'menu-principal.php'); 
	$fechacita= date("Y-m-d");
	$sql = sprintf("SELECT phpc_events.eid, phpc_events.subject, phpc_events.description, phpc_occurrences.start_ts, phpc_occurrences.end_ts FROM phpc_events 
inner join phpc_occurrences on phpc_events.eid = phpc_occurrences.eid where phpc_occurrences.start_ts>='".$fechacita." 01:00:00' and phpc_occurrences.end_ts<='".$fechacita." 24:00:00' ORDER BY phpc_occurrences.start_ts ASC");
	$query = mysql_query($sql, $conexion_mysql) or die(mysql_error());
	$row = mysql_fetch_assoc($query);
	$tot_rows = mysql_num_rows($query);
	?>       
	<div class="container">    
    	<br/>
		<br/>

        <div class="rowfluid">
        	   <div class="span6">
        		      <div class="well well-large">
                        <!-- Contenido de perfil de usuario logueado-->
                            <div class="span3" align="center">
                              <label style="font-size:22px; font-style:italic; text-shadow:#00F" >Perfil de Usuario</label>
                            </div>
                            <div class="span2" align="center">
                             <label style="font-size:22px; color:#06F; font-style:italic; text-shadow:#00F" >Activo</label>
                              
                            </div>
                            <br>
                             <div class="span2">
                                
                            </div>
                            <div class="row-fluid">
                            <div class="span12">
                                <div class="well well-large">
                                    <div>
                                    <i class="icon-user"></i><span  class="label label-info"><?php echo ' Usuario: <span  class="label label-success">'.$persona['per_nombre'].'</span>'; ?></span>
                                    </div>
                                    <br>
                                    <div>
                                    <i class="icon-tag"></i><span  class="label label-info"><?php echo ' Correo: <span  class="label label-success">'.$persona['per_mail'].'</span>'; ?></span>
                                    </div>
                                    <br>
                                    <div>
                                    <i class="icon-tag"></i><span  class="label label-info"><?php echo ' Nacionalidad: <span  class="label label-success">'.$persona['per_nacionalidad'].'</span>'; ?></span>
                                    </div>
                                    <br>
                                    <div>
                                    <i class="icon-tag"></i><span  class="label label-info"><?php echo ' Profesión: <span  class="label label-success">'.$empleado['emp_profesion'].'</span>'; ?></span>             
                                    </div>
                                     <br>
                                     <div>
                                    <i class="icon-tag"></i><span  class="label label-info"><?php echo ' Actividad: <span  class="label label-success">'.$empleado['emp_actividad'].'</span>'; ?></span>             
                                    </div>
                                    <br>
                                     <div>
                                    <i class="icon-tag"></i><span  class="label label-info"><?php echo ' Sucursal : <span  class="label label-success">'.$sucursal['suc_nombre'].'</span>'; ?></span>             
                                    </div>
                                </div>
                            </div>
                    </div>       
                </div>
                </div>
                <div class="span5">
        		      <div class="well well-large">
                        <!-- Contenido Calendario-->
                        <div class="span2">
                            <h3 style="color:#999">Citas del día</h3>
                        </div>
                        <div class="span2">
                            <h4 style="color:#06F" align="right"> <?php echo date("d-m-Y"); ?></h4>
                            <span class="badge badge-info"><?php echo $tot_rows;?></span>
                        </div>
                         <br>         
                        <br>
                         <div class="row-fluid">
                            <div class="span12">
                            <?php if($tot_rows>0){ ?>
                            <table class="table table-bordered table-condensed table-striped" id="tab_usr">
                				<thead>
                					<tr>
                						<th>Paciente</th>
                						<th>Inicia</th>
                                        <th>Termina</th>
            						    <!--<th width="125px"></th>	-->
                    			     </tr>
                    			</thead>
                			<tbody>
                				<?php
                				do{
                					?>
                					  <tr>
                                    	<td><a data-toggle="tooltip" style="color:#000" data-placement="right" title="<?php echo $row['description']; ?>"><i class="icon-comment"></i> <?php echo $row['subject'];?> </a></td>
                                        <td><?php echo substr($row['start_ts'],11,5);?></td>
                                        <td><?php echo substr($row['end_ts'],11,5);?></td>
                        <!--
                        <td> <span class="label label-warning"> NOTIFICAR</span></td>
                        -->
                                        </tr>
					             <?php }
            				while($row = mysql_fetch_assoc($query))
            				?>
                            </tbody>
                            </table>
                            <?php }
            				else {
            					echo '<div class="alert alert-error"><h4>No existen citas programadas</h4></div>';
            				}
            				 ?>
                            </div>
                        </div>
                    </div>

        	       </div>
                </div>
	       </div>
</body>
</html>