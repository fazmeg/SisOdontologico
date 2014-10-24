<?php 
	if (!isset($_SESSION)) session_start();
	include('../../start.php');
	fnc_autentificacion();
	$pre_id = fnc_varGetPost('pre_id');
	$registro = fnc_datCatPreTra($pre_id);

	if($registro){
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
	<title><?php echo $accion; ?> Precios </title>
    <?php include(RUTAp.'jquery/styl-jquery.php'); ?>
    <?php require_once(RUTAs.'styles/styl-bootstrap.php'); ?>
    <script type="text/javascript">
		$(document).on('ready', function(){
			$("#suc").autocomplete({
				source: 'funciones/bus-sucursal.php',
				minLength: 1,
				autoFocus: true
			});
			$("#suc").chosen({});
		});
		$(document).on('ready', function(){
			$("#tratamiento").autocomplete({
				source: 'funciones/bus-tratamientos.php',
				minLength: 1,
				autoFocus: true
			});
			$("#tratamiento").chosen({});
		});
	</script> 
</head>
<body>
	<?php include(RUTAcom.'menu-principal.php'); ?>
    <div class="container">
		<div class="page-header"><h3><?php echo strtoupper($accion); ?> PRECIOS</h3></div>
		<div class="row-fluid">
        	<div class="span8">
                <ul class="breadcrumb">
                    <li>
                        <i class="icon-home"></i>
                        <a href="<?php echo $RUTAm; ?>administrador/precios-index.php"> Administración de Precios</a>
                        <span class="divider">/</span>
                    </li>
                    <li class="active"><?php echo $accion; ?> precios</li>
                </ul>
			</div>
            <div class="span4">
            	<?php if($registro){ ?>
            	<a href="<?php echo $RUTAm; ?>administrador/precios-form.php" class="btn btn-primary btn-large btn-block"><strong> NUEVO PRECIO</strong></a>
                <?php } ?>
            </div> 
			
		</div>
		<div class="row-fluid">
			<div class="control-group well">
				<form class="form-horizontal" method="post" action="<?php echo $RUTAm; ?>administrador/funciones/precios-fncs.php" >
				<div >
                <table  align="center">
                  <tr>
                    <td>Tratamiento</td>
                    
                    <td><?php 
					$Sel_Tra = $registro['tra_id'];
					fnc_listTra($Sel_Tra,'input-block-level', 'tratamiento', 'autofocus required', 'array_change_key_case()'); ?> </td>
                  </tr>
                  <label class="add-on" id="resultTraSuc">
                   <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>Sucursal</td>
                    <td><?php $idSelSuc = $registro['suc_id'];
					fnc_listSuc($idSelSuc,'input-block-level', 'suc', 'autofocus required'); ?></td>
                    <td>&nbsp;</td>
                  </tr>
                   <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>Valor</td>
                    <td><input type="number" class="input-block-level" id="pre_val" name="pre_val" min="0" value="<?php echo $registro['pre_val']; ?>" placeholder="Valor en Dólares" required></td>
                  </tr>
                   <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>Descuento</td>
                    <td><input type="number" class="input-block-level" id="pre_des" name="pre_des" min="0" max="100" value="<?php echo $registro['pre_des']; ?>" placeholder="Descuento en Porcentaje" required></td>
                    <td>&nbsp;</td>
                  </tr>
                   <tr>
                    <td>&nbsp;</td>
                  </tr>
                   <tr>
                    <td>
                    <?php echo $button; ?>
                    </td>
                    <td>
					<a href="<?php echo $RUTAm; ?>administrador/precios-index.php" type="button" class="btn">CANCELAR</a>
					</td>
                  </tr>
                </table>
				</div>
				<input type="hidden" name="accion" id="accion" value="<?php echo $accion; ?>">
				<input type="hidden" name="tra_id" id="tra_id" value="<?php echo $Sel_Tra; ?>">
                <input type="hidden" name="pre_id" id="pre_id" value="<?php echo $registro['pre_id']; ?>">
						
				</form>
			</div>
		</div>
    </div>
</body>
<footer>
</footer>
</html>
