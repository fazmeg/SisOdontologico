<!-- Inicio Modal -->   
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3>NUEVO USUARIO</h3>    						    						
	</div>
	<div class="modal-body">                
		<div class="tabbable">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tab1" data-toggle="tab">Datos</a></li>
				<li><a href="#tab2" data-toggle="tab">Permisos</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tab1">
					<form class="form-horizontal">
						<div class="control-group well">
							<div class="control-group">
                            	<label class="control-label">Empleado</label>
                                <div class="controls">
                                    <input type="text" class="input-block-level" id="emp" name="emp" onchange="buscarEmpleado()" placeholder="Empleado" required>
                                </div>                                            	                      	
							</div>                    
							<div class="control-group">
                            	<label class="control-label">Usuario</label>
                                <div class="controls">
									<input type="text" class="input-block-level" id="usu" name="usu" placeholder="Usuario" required>
								</div>
							</div>
							<div class="control-group">
                            	<label class="control-label">Contraseña</label>
                                <div class="controls">
									<input type="password" class="input-block-level" id="pass" name="pass" placeholder="Contraseña" required>
								</div>
							</div>
							<div class="control-group">
                            	<label class="control-label">Verificar contraseña</label>
                                <div class="controls">
									<input type="password" class="input-block-level" id="vpass" name="vpass" placeholder="Verificar contraseña" required>
								</div> 
							</div>                          
						</div>  				               
                    </form>	
				</div>
				<div class="tab-pane" id="tab2">
                    <div class="control-group">
                        <div class="controls">
                        
                         <?php
					//Consulta para Menus
					$sql_menus = sprintf("SELECT * FROM menus WHERE men_padre=%s AND men_eliminado=%s ORDER BY men_orden ASC",
					GetSQLValueString('0','int'),
					GetSQLValueString('N','text'));
					$query_menus = mysql_query($sql_menus, $conexion_mysql) or die(mysql_error());
					$rows_menus = mysql_fetch_assoc($query_menus);
					$tot_rows_menus = mysql_num_rows($query_menus);
					
					if($tot_rows_menus > 0){
					do{ 
					//Consulta para Submenus
					$sql_submenus = sprintf("SELECT * FROM menus WHERE men_padre=%s AND men_eliminado=%s",
					GetSQLValueString($rows_menus['men_id'],'int'),
					GetSQLValueString('N','text'));
					$query_submenus = mysql_query($sql_submenus, $conexion_mysql) or die(mysql_error());
					$rows_submenus = mysql_fetch_assoc($query_submenus);
					$tot_rows_submenus = mysql_num_rows($query_submenus); ?>
                    
					<label class="checkbox"> 						
						<input type="checkbox" id="" value="option1"> <?php echo $rows_menus['men_nombre']; ?>
						<?php if($tot_rows_submenus > 0){ ?>
						
						<?php 
							do{ ?>
                            <label class="checkbox">
								<input type="checkbox" id="" value="option1"> <?php echo $rows_submenus['men_nombre']; ?>
							</label> 
							<?php 
							}while($rows_submenus = mysql_fetch_assoc($query_submenus)); mysql_free_result($query_submenus); ?>     
						
						<?php } ?>  
					</label>                           	                    
					<?php 
					}while($rows_menus = mysql_fetch_assoc($query_menus)); mysql_free_result($query_menus); 
					}else echo '<span style="color:red; ">No existen menus en la base de datos.</span>'; ?>
                        	    
                        	
							<?php $dat_men = fnc_listMen(); 							
							echo $dat_men['men_nombre']; ?>
                        </div>
                    </div>
				</div>
			</div>
		</div>                       
	</div>
	<div class="modal-footer">
		<button type="button" class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
		<button class="btn btn-primary" type="button" onClick="funciones.php">Aceptar</button>                        
	</div>
</div>
<!-- Fin Modal -->