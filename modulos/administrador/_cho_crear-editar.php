<?php 
	if (!isset($_SESSION)) session_start();
	include('../../start.php');
	fnc_autentificacion();
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8"></meta>
	<title>Crear usuario</title>
    <?php include(RUTAp.'jquery/styl-jquery.php'); ?>
    <?php require_once(RUTAs.'styles/styl-bootstrap.php'); ?>
    
	<script type="text/javascript">
		$(document).on('ready', function(){
			$("#emp").autocomplete({
				source: 'funciones/bus-emp.php',
				minLength: 1,
				autoFocus: true
			});
			$("#rol").chosen({});
		});
	</script> 
</head>
<body>
	<?php include(RUTAcom.'menu-principal.php'); ?>
    <div class="container">
		<div class="page-header"><h3>NUEVO USUARIO</h3></div>
		<div class="row-fluid">
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="<?php echo $RUTAm; ?>administrador/"> Administración de usuarios</a>
					<span class="divider">/</span>
				</li>
				<li class="active">Crear - editar usuario</li>
			</ul>
		</div>
		<div class="row-fluid">
			<form class="form-horizontal">
				<div class="control-group well">
					<div class="control-group">
						<label class="control-label">Empleado</label>
						<div class="controls">
							<input type="text" class="input-block-level" id="emp" name="emp" placeholder="Empleado" autofocus required>
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
					<div class="control-group">
						<label class="control-label">Acceso</label>
						<div class="controls">
							<?php fnc_listMod('input-block-level','rol','rol'); ?>
						</div> 
					</div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">GUARDAR</button>
                        <a href="<?php echo $RUTAm; ?>administrador/"><button type="button" class="btn">CANCELAR</button></a>
                    </div> 
				</div>
			</form>            
		</div>
    </div>  	
</body>
<footer>	
</footer>	
</html>