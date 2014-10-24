<?php 
	if (!isset($_SESSION)) session_start();
	include('../../start.php');
	fnc_autentificacion();
	$tra_cat_id = fnc_varGetPost('tra_cat_id');
	$categoria = fnc_datCat($tra_cat_id);
	if($categoria){
		$accion = 'Actualizar';
		$button = '<input type="submit" class="btn btn-primary" name="btnGuardar" value="ACTUALIZAR">';
	}else{
		$accion = 'Insertar';
		$button='<input type="submit" class="btn btn-primary" name="btnGuardar" value="INSERTAR">';
	}
	
?>
<script type="text/javascript">
		$(document).on('ready', function(){
			$("#tra_cat_nom").autocomplete({
				source: 'funciones/bus_cat_tra.php',
				minLength: 1,
				autoFocus: true
			});
			$("#tra_cat_nom").chosen({});
		});
</script> 
<!doctype html>
<html>
    <head>
    	<meta charset="utf-8"></meta>
    	<title><?php echo $accion; ?> Categoías</title>
        <?php include(RUTAp.'jquery/styl-jquery.php'); ?>
        <?php require_once(RUTAs.'styles/styl-bootstrap.php'); ?>
    </head>
<body>
	<?php include(RUTAcom.'menu-principal.php'); ?>
    <div class="container">
		<div class="page-header"><h3><?php echo strtoupper($accion); ?> CATEGORÍAS</h3></div>
	       	<div class="row-fluid">
        	   <div class="span8">
                    <ul class="breadcrumb">
                        <li>
                            <i class="icon-home"></i>
                            <a href="<?php echo $RUTAm; ?>administrador/categorias_tratamientos-index.php"> Administración de Categoías</a>
                            <span class="divider">/</span>
                        </li>
                        <li class="active"><?php echo $accion; ?> Categoías</li>
                    </ul>
			   </div>
            <div class="span4">
            	<?php if($categoria){ ?>
                	<a href="<?php echo $RUTAm; ?>administrador/categoria_tratamientos-form.php" class="btn btn-primary btn-large btn-block"><strong> NUEVA CATEGORÍA</strong></a>
                <?php } ?>
            </div>
		</div>
    </div>
<form class="form-horizontal" method="post" action="<?php echo $RUTAm; ?>administrador/funciones/categorias_tratamientos-fncs.php">
	<div class="row-fluid">
        <div class="control-group well">
            <div class="span3">
                </div>
                    <div class="span7">
                        <p>
                        <label for="textfield">Nombre:</label>
                        <input type="text" class="impu-large" style="height:30px" id="tra_cat_nom" name="tra_cat_nom" value="<?php echo $categoria['tra_cat_nom']; ?>" placeholder="Nombre" required>
                        </p>
                        <div>
                        	<input type="hidden" name="accion" id="accion" value="<?php echo $accion; ?>">
                			<input type="hidden" name="tra_cat_id" id="accion" value="<?php echo $tra_cat_id; ?>">
                			<?php echo $button; ?>
                 			<a href="<?php echo $RUTAm; ?>administrador/categorias_tratamientos-index.php" type="button" class="btn">CANCELAR</a>
                        </div>
                    </div>
                <div class="span3">
            </div>
        </div>
    </div>
</form>
</body>
<footer>
</footer>
</html>