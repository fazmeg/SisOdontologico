<?php 
	if (!isset($_SESSION)) session_start();
	include('../../start.php');
	fnc_autentificacion();
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8"></meta>
	<title>Gestión de precios</title>
    <?php include(RUTAp.'jquery/styl-jquery.php'); ?>
    <?php require_once(RUTAs.'styles/styl-bootstrap.php'); ?>
    
</head>
<body>
	<?php include(RUTAcom.'menu-principal.php');
	$sql = sprintf("SELECT * FROM precios inner join sucursal on precios.suc_id = sucursal.suc_id  inner join tratamientos on tratamientos.tra_id = precios.tra_id inner join tra_categorias on tratamientos.tra_cat_id = tra_categorias.tra_cat_id WHERE tratamientos.tra_elim = 'N' ORDER BY tratamientos.tra_id DESC");
	$query = mysql_query($sql, $conexion_mysql) or die(mysql_error());
	$row = mysql_fetch_assoc($query);
	$tot_rows = mysql_num_rows($query); 
	fnc_msgGritter();?>
	<div class="container">
		<div class="page-header"><h3>ADMINISTRACIÓN DE PRECIOS</h3></div>
        <div class="row-fluid">
        	<div class="span8">
                <ul class="breadcrumb">
                    <li class="active"><i class="icon-home"></i> Administración de precios</li>
                </ul>
			</div>
            <div class="span4">
            	<a href="<?php echo $RUTAm; ?>administrador/precios-form.php" class="btn btn-primary btn-large btn-block"><strong> NUEVO PRECIO</strong></a>
            </div>
		</div>
		<div class="portlet-body">
			<div class="row-fluid">
				<div class="alert alert-info">
					<h4><i class="icon-list"></i> Lista de precios <span class="badge"><?php echo $tot_rows; ?></span></h4>
				</div>
			</div>
            <?php if($tot_rows > 0)	{ ?>
            <div class="row-fluid">
			<table class="table table-bordered table-condensed table-striped" id="tab_tra">
				<thead>
					<tr>
						<th width="125px"></th>
                        <th>Sucursal</th>
                        <th>Categoría</th>
                        <th>Tratamiento</th>
                        <th>Valor</th>
                        <th>Descuento</th>
                    </tr>
				</thead>
				<tbody>
					<?php do { ?>
					<tr>
						<td>
							<div class="btn-group">
                        		<a href="<?php echo $RUTAm; ?>administrador/precios-form.php?pre_id=<?php echo $row['pre_id']; ?>" class="btn btn-primary btn-mini"><i class="icon-edit"></i> Editar</a>
								<a href="<?php echo $RUTAm; ?>administrador/funciones/precios-fncs.php?pre_id=<?php echo $row['pre_id']; ?>&accion=Eliminar" class="btn btn-danger btn-mini" onClick="javascript:return confirm('¿Esta seguro que desea eliminar <?php echo $row['tra_nombre']; ?>?');"><i class="icon-trash"></i> Eliminar</a>
                    		</div>
						</td>
                        <td><?php echo $row['suc_nombre']; ?></td>
                        <td><?php echo $row['tra_cat_nom']; ?></td>
						<td><?php echo $row['tra_nom']; ?></td>
                        <td><?php echo '$ '.$row['pre_val']; ?></td>
						<td><?php echo $row['pre_des'].'%'; ?></td>
                        </tr>
					<?php } while ($row = mysql_fetch_assoc($query)); ?>
				</tbody>
			</table>
            </div>        			
			<?php mysql_free_result($query);
			}else{ echo '<div class="alert alert-error"><h4>No existen precios.</h4></div>'; } ?>
		</div>     	     
	</div>
</body>
<footer>	
</footer>
</html>