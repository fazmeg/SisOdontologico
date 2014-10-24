<?php 
	if (!isset($_SESSION)) session_start();
	include('../../start.php');
	fnc_autentificacion();
	$idEmp = fnc_varGetPost('idEmp');
	$datEmpleado = fnc_datEmp($idEmp);
	$datPersona = fnc_datPer($datEmpleado['per_id']);
	$conv = fnc_datTelPacXtipo($datPersona['per_id'], 'convencional');
	echo $datPersona['per_id'];
	if($datEmpleado){
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
	<title><?php echo $accion; ?> talento humano</title>
    <?php include(RUTAp.'jquery/styl-jquery.php'); ?>
    <?php require_once(RUTAs.'styles/styl-bootstrap.php'); ?>
</head>
<body>
	<?php include(RUTAcom.'menu-principal.php'); ?>
    <div class="container">
		<div class="page-header"><h3><?php echo strtoupper($accion); ?> TALENTO HUMANO</h3></div>
		<div class="row-fluid">
        	<div class="span8">
                <ul class="breadcrumb">
                    <li>
                        <i class="icon-home"></i>
                        <a href="<?php echo $RUTAm; ?>administrador/thumano-index.php"> Administración de talento humano</a>
                        <span class="divider">/</span>
                    </li>
                    <li class="active"><?php echo $accion; ?> talento humano</li>
                </ul>
			</div>
            <div class="span4">
            	<?php if($datEmpleado){ ?>
            	<a href="<?php echo $RUTAm; ?>administrador/thumano-form.php" class="btn btn-primary btn-large btn-block"><strong> NUEVO TALENTO HUMANO</strong></a>
                <?php } ?>
            </div>
		</div>
		<div class="row-fluid">
			<div class="control-group well">
            	<form class="form-horizontal" method="post" action="<?php echo $RUTAm; ?>administrador/funciones/thumano-fncs.php" onSubmit="return verificarEmp()">
                	<div class="row-fluid">
                    	<div class="span8 well well-small">
                        	<div class="row-fluid">
                                    <div class="control-group">
                                        <label class="control-label">Documento</label>
                                        <div class="controls">
                                            <input type="text" class="span8" id="doc" name="doc" value="<?php echo $datPersona['per_documento']; ?>" placeholder="Documento" required>
                                            <span class="add-on" id="resultEmp"></span>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Nombres</label>
                                        <div class="controls">
                                            <input type="text" class="input-block-level" id="nom" name="nom" value="<?php echo $datPersona['per_nombre']; ?>" placeholder="Nombres" required>
                                        </div>
                                    </div>
                            </div>
                            <div class="row-fluid">
                            	<div class="span6">
                                    <div class="control-group">
                                        <label class="control-label">Fecha de nacimiento</label>
                                        <div class="controls">
                                            <input type="date" class="input-block-level" id="fec_nac" name="fec_nac" value="<?php echo $datPersona['per_fec_nac']; ?>" placeholder="Fecha de nacimiento" required>
                                        </div>
                                    </div>
								</div>
                            	<div class="span6">
                                    <div class="control-group">
                                        <label class="control-label">Sexo</label>
                                        <div class="controls">
                                            <select class="input-block-level" id="sexo" name="sexo">
                                                <option value="M">Masculino</option>
                                                <option value="F">Femenino</option>
											</select>
                                        </div>
                                    </div>
								</div>
							</div>
                        </div>
                        <div class="span4 well well-small">
                        	ESPACIO FOTO
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span8 well well-small">
                        	<div class="row-fluid">
                            	<div class="span6">
                                    <div class="control-group">
                                        <label class="control-label">Teléfono</label>
                                        <div class="controls">
                                            <input type="text" class="input-block-level" id="tel" name="tel" value="<?php echo $conv['tel_numero']; ?>" placeholder="Teléfono" required>
                                        </div>
                                    </div>
								</div>
                                <div class="span6">
                                    <div class="control-group">
                                        <label class="control-label">E-mail</label>
                                        <div class="controls">
                                            <input type="email" class="input-block-level" id="mail" name="mail" value="<?php echo $datPersona['per_mail']; ?>" placeholder="E-mail">
                                        </div>
                                    </div>
								</div>
							</div>
                        	<div class="row-fluid">
                            	<div class="span6">
                                    <div class="control-group">
                                        <label class="control-label">Nacionalidad</label>
                                        <div class="controls">
                                            <input type="text" class="input-block-level" id="nac" name="nac" value="<?php echo $datPersona['per_nacionalidad']; ?>" placeholder="Nacionalidad" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="span6">
                                    <div class="control-group">
                                        <label class="control-label">Ciudad</label>
                                        <div class="controls">
                                            <input type="text" class="input-block-level" id="ciu" name="ciu" value="<?php echo $datPersona['per_ciudad_nac']; ?>" placeholder="Ciudad" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Dirección 1</label>
                                <div class="controls">
                                    <input type="text" class="input-block-level" id="dir1" name="dir1" value="<?php echo $datPersona['per_direccion1']; ?>" placeholder="Dirección 1" required>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Dirección 2</label>
                                <div class="controls">
                                    <input type="text" class="input-block-level" id="dir2" name="dir2" value="<?php echo $datPersona['per_direccion2']; ?>" placeholder="Dirección 2">
                                </div>
                            </div>
                            <div class="row-fluid">
                            	<div class="span6">
                                    <div class="control-group">
                                        <label class="control-label">Num. de casa</label>
                                        <div class="controls">
                                            <input type="text" class="input-block-level" id="num_casa" name="num_casa" value="<?php echo $datPersona['per_num_viv']; ?>" placeholder="Num. de casa">
                                        </div>
                                    </div>
								</div>
                                <div class="span6">
                                    <div class="control-group">
                                        <label class="control-label">Código postal</label>
                                        <div class="controls">
                                            <input type="text" class="input-block-level" id="cod_post" name="cod_post" value="<?php echo $datPersona['per_postal']; ?>" placeholder="Código postal">
                                        </div>
                                    </div>
								</div>
							</div>
                        </div>
                        <div class="span4 well well-small">
                            <div class="control-group">
                                <label class="control-label">Sucursal</label>
                                <div class="controls">
                                    <?php fnc_genSelect(fnc_datosSuc(),'input-block-level','suc','required'); ?>
                                </div>
                          </div>
                            <div class="control-group">
                                <label class="control-label">Profesión</label>
                                <div class="controls">
                                    <input type="text" class="input-block-level" id="prof" name="prof" value="<?php echo $datEmpleado['emp_profesion']; ?>" placeholder="Profesión" required>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Actividad</label>
                                <div class="controls">
                                    <input type="text" class="input-block-level" id="act" name="act" value="<?php echo $datEmpleado['emp_actividad']; ?>" placeholder="Actividad" required>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Salario</label>
                                <div class="controls">
                                    <input type="number" class="input-block-level" id="sal" name="sal" value="<?php echo $datEmpleado['emp_sueldo']; ?>" placeholder="Salario" required>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Fecha de ingreso</label>
                                <div class="controls">
                                    <input type="date" class="input-block-level" id="fec_ing" name="fec_ing" value="<?php echo $datEmpleado['emp_fecha_ingreso']; ?>" placeholder="Fecha de ingreso" required>
                                </div>
                            </div>
                        </div>
					</div>
					<div class="form-actions">
                        <input type="hidden" name="accion" id="accion" value="<?php echo $accion; ?>">
                        <input type="hidden" name="idEmp" id="idEmp" value="<?php echo $idEmp; ?>">
                        <?php echo $button; ?>
                        <a href="<?php echo $RUTAm; ?>administrador/thumano-index.php" type="button" class="btn">CANCELAR</a>
					</div>
				</form>
            </div>
		</div>
    </div>
</body>
<footer>
</footer>
</html>