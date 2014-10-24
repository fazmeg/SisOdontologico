<?php 
	if (!isset($_SESSION)) session_start();
	include('../../start.php');
	fnc_autentificacion();	
	$tra_id = fnc_varGetPost('tra_id');
	$tratamiento = fnc_datTra($tra_id);
	$cat_tra= fnc_datCatTra($tra_id);
	if($tratamiento){
		$accion = 'Actualizar';
		$button = '<input type="submit" class="btn btn-primary" name="btnGuardar" value="ACTUALIZAR">';
		$etiqueta ='Actualice el';
		echo "si existe toca Actualizar";
	}else{
		$accion = 'Insertar';
		$button='<input type="submit" class="btn btn-primary" name="btnGuardar" value="INSERTAR">';
		$etiqueta ='Cree un ';
		echo "NO existe toca Insertar";
	}
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8"></meta>
	<title>Administrador de Tratamientos</title>
    <?php include(RUTAp.'jquery/styl-jquery.php'); ?>
    <?php require_once(RUTAs.'styles/styl-bootstrap.php'); ?>
    <script type="text/javascript">
		$(document).on('ready', function(){
			$("#categoria").autocomplete({
				source: 'funciones/bus-categoria.php',
				minLength: 1,
				autoFocus: true
			});
			$("#categoria").chosen({});
		});
	</script> 
</head>
<body>
	<?php include(RUTAcom.'menu-principal.php'); 
	fnc_msgGritter();
	?>
<div class="container">
		<div class="page-header"><h3><?php echo strtoupper($accion); ?> TRATAMIENTOS</h3></div>
	       	<div class="row-fluid">
        	   <div class="span8">
                    <ul class="breadcrumb">
                        <li>
                            <i class="icon-home"></i>
                            <a href="<?php echo $RUTAm; ?>administrador/tratamientos-index.php"> Gestión de Tratamientos</a>
                            <span class="divider">/</span>
                        </li>
                        <li class="active"><?php echo $accion; ?> Tratamientos</li>
                    </ul>
			   </div>
               <div class="span4">
            	<?php if($categoria){ ?>
                	<a href="<?php echo $RUTAm; ?>administrador/tratamientos-form.php" class="btn btn-primary btn-large btn-block"><strong> NUEVA TRATAMIENTO</strong></a>
                <?php } ?>
            	</div>
			</div>
		</div>
        <div class="row-fluid">
	        
	        	<div class="span4">
	        	</div>
	        	<div class="span4">
	        	<div style="height:160px" align="center">
				<form class="navbar-search pull-left" method="post" action="<?php echo $RUTAm; ?>administrador/funciones/tra.php">
	                <table cellspacing="2" align="center">
                    	<tr>
	                        <label><?php echo $etiqueta; ?> Tratamiento</label>
                       	</tr>
	                      <tr>
	                        <td><label> Categoría</label></td>
	                        <td>
	                        <br>
	                        <!--- Chosen  de busqueda de Categorias -->
	                        <div class="control-group">
	                        <div class="controls" id="chosen_cat" style="height:15px">
	                            <?php 
								
									$idSel = $cat_tra['tra_cat_id'];
									fnc_listCat($idSel,'input-block-level', 'categoria', 'autofocus required'); 
								
								?>
	                        </div>  
	                        </div>
	                        </td>
	                      </tr>
	                      <tr>
	                      <td>&nbsp;</td>
	                      <td>&nbsp;</td>
	                      </tr>
	                      <tr>
	                        <td>
	                        <label>Nombre</label>
	                        </td>
	                        <td>
							<input type="text" class="input-block-level" name="tra_nom" id="tra_nom" placeholder="Nombre" required value="<?php echo $tratamiento['tra_nom']; ?>">
	                        </td>
	                      </tr>
	                	  <tr>
                        	<td>
							<?php echo $button; ?>
                            </td>
                            <td>
                 			<a href="<?php echo $RUTAm; ?>administrador/tratamientos-index.php" type="button" class="btn">CANCELAR</a>	</td>
                          </tr>
	                    </table>
                        
                        	<input type="hidden" name="accion" id="accion" value="<?php echo $accion; ?>">
                			<input type="hidden" name="tra_id" id="tra_id" value="<?php echo $tra_id; ?>">
                        
	          </form>
	        </div>
	        <div class="span4">
	        </div>
	    </div>
     </div>  
</body>
<footer>	
</footer>
</html>
