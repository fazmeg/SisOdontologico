<?php 
	if (!isset($_SESSION)) session_start();
	include('../../start.php');
	fnc_autentificacion();
	$per_id = fnc_varGetPost('per_id');
	$datPac = fnc_datPac($per_id);
	$datPer = fnc_datPer($per_id);
	$cel = fnc_datTelPacXtipo($per_id, 'celular');
	$conv = fnc_datTelPacXtipo($per_id, 'convencional');
	
	if($datPac){
		$accion = 'Actualizar';
		$button = '<input type="submit" class="btn btn-primary" name="btnGuardar" id="btnGuardar" value="ACTUALIZAR">';
	}else{
		$accion = 'Insertar';
		$button='<input type="submit" class="btn btn-primary" name="btnGuardar" id="btnGuardar" value="INSERTAR">';
	}
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8"></meta>
	<title><?php echo $accion; ?> Crear paciente</title>
    <?php include(RUTAp.'jquery/styl-jquery.php'); ?>
    <?php require_once(RUTAs.'styles/styl-bootstrap.php'); ?>
</head>
<body>
	<?php include(RUTAcom.'menu-principal.php'); ?>
    <div class="container">
		<div class="page-header"><h3><?php echo strtoupper($accion); ?> NUEVO PACIENTE</h3></div>
		<div class="row-fluid">
        	<div class="span8">
                <ul class="breadcrumb">
                    <li>
                        <i class="icon-home"></i>
                        <a href="<?php echo $RUTAm; ?>pacientes/pacientes-index.php"> Administración de Pacientes</a>
                        <span class="divider">/</span>
                    </li>
                    <li class="active"><?php echo $accion; ?> Paciente</li>
                </ul>
			</div>
            <div class="span4">
            	<?php if($datPac){ ?>
            	<a href="<?php echo $RUTAm; ?>pacientes/pacientes-form.php" class="btn btn-primary btn-large btn-block"><strong> NUEVO PACIENTE</strong></a>
                <?php } ?>
            </div> 	
		</div>
		<div class="row-fluid">
			<div class="tabbable">
            	<ul class="nav nav-tabs">
                    <li class="active"><a href="#tab1" data-toggle="tab">Datos</a></li>
                </ul>
                <div class="control-group well">

					<form class="form-horizontal" method="post" action="<?php echo $RUTAm; ?>pacientes/funciones/pacientes-fncs.php" enctype="multipart/form-data" onSubmit="return verificarSuc()">
                <div class="tab-content">
                	<div class="control-group">
                    		<label class="control-label">Foto</label>
                        <div class="controls">
                        	<input type="file" name="foto"/>
                        </div>
                    </div>
					<div class="control-group">
						<label class="control-label">Cedula</label>
                        <div class="controls">
							<input type="text" id="inputCed" name="inputCed" placeholder="Cedula" value="<?php echo $datPer['per_documento']; ?>" required>
                        </div>
					</div>
					<div class="control-group">
						<label class="control-label">Nombres</label>
                        <div class="controls">
							<input type="text" id="inputNom" name="inputNom" placeholder="Nombres" value="<?php echo $datPer['per_nombre']; ?>" required>
                        </div>
					</div>
					<div class="control-group">
						<label class="control-label">Calle1</label>
						<div class="controls">
							<input type="text" id="inputDir1" name="inputDir1" placeholder="Dirección Calle 1" value="<?php echo $datPer['per_direccion1']; ?>" required>
						</div> 
					</div>
					<div class="control-group">
						<label class="control-label">Calle2</label>
						<div class="controls">
							<input type="text" id="inputDir2" name="inputDir2" placeholder="Dirección Calle 2" value="<?php echo $datPer['per_direccion2']; ?>" required>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">Numero Casa</label>
						<div class="controls">
							<input type="text" id="inputnumvi" name="inputnumvi" placeholder="Número de vivienda" value="<?php echo $datPer['per_num_viv']; ?>" required>
						</div> 
					</div>
                    <div class="control-group">
						<label class="control-label">Telefono Convencional</label>
                        <div class="controls">
							<input type="text" id="inputtelf" name="inputtelf" placeholder="Teléfono Convencional" value="<?php echo $conv['tel_numero']; ?>">
                        </div>
					</div>
                    <div class="control-group">
						<label class="control-label">Celular</label>
                        <div class="controls">
							<input type="text" id="inputCel" name="inputCel" placeholder="Celular" value="<?php echo $cel['tel_numero']; ?>">
                        </div>
					</div>
                    <div class="control-group">
						<label class="control-label">E-MAIL</label>
                        <div class="controls">
							<input type="text" id="inputemail1" name="inputemail1" placeholder="Email " value="<?php echo $datPer['per_mail']; ?>" required>
                        </div>
					</div>
                    <div class="control-group">
						<label class="control-label">Nacionalidad</label>
                        <div class="controls">
							<input type="text" id="inputnacionalidad" name="inputnacionalidad" placeholder="Nacionalidad" value="<?php echo $datPer['per_nacionalidad']; ?>" required>
                        </div>
					</div>
                    <div class="control-group">
						<label class="control-label">Ciudad Nacimiento</label>
                        <div class="controls">
							<input type="text" id="inputciudadnacimiento" name="inputciudadnacimiento" placeholder="Ciudad de Nacimiento" value="<?php echo $datPer['per_ciudad_nac']; ?>" required>
                        </div>
					</div>
                    <div class="control-group">
						<label class="control-label">Fecha Nacimiento</label>
                        <div class="controls">
							<input type="date" id="imputfechanacimiento" name="imputfechanacimiento" placeholder=" Fecha de Nacimiento" value="<?php echo $datPer['per_fec_nac']; ?>" required>
                        </div>
					</div>
                    <div class="control-group">
                    <label class="control-label">SEXO</label>
                    <div class="controls">
					<select name="sexo" id="sexo">
  						<option value="M">Masculino</option>
 						<option value="F">Femenino</option>
  					</select>
                    </div>
					</div>
                    <div class="control-group">
						<label class="control-label">Observaciones</label>
                        <div class="controls">
						<textarea id="observaciones" name="observaciones" placeholder="Observaciones" ><?php echo $datPac['pac_observaciones']; ?></textarea>
                        </div>
					</div>
                    <div class="control-group">
						<label class="control-label">Alergias</label>
                        <div class="controls">
						<textarea id="alergias" name="alergias" placeholder="Alergias" ><?php echo $datPac['pac_alergias']; ?></textarea>
                        </div>
					</div>
					<div class="form-actions">
						<input type="hidden" name="accion" id="accion" value="<?php echo $accion; ?>">
                        <input type="hidden" name="pac_id" id="pac_id" value="<?php echo $pac_id; ?>">
                        <input type="hidden" name="per_id" id="pac_id" value="<?php echo $per_id; ?>">
						<?php echo $button; ?>
						<a href="<?php echo $RUTAm; ?>pacientes/pacientes-index.php" type="button" class="btn">CANCELAR</a>
					</div>
                   </div>
				</form>
                </div>
			</div>
		</div>
    </div>
</body>
<footer>
</footer>
</html>