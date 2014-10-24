<?php 
include('../../start.php');
	$tra_rea_fec=$_GET['tra_rea_fec'];
    $per_id=$_GET['per_id'];
	$sqlCotiza = sprintf("SELECT * FROM detalle_tratamientosxrealizar inner join tratamientos on detalle_tratamientosxrealizar.tra_id=tratamientos.tra_id inner join precios on tratamientos.tra_id=precios.tra_id WHERE per_id = '".$per_id."' and tra_rea_fec='".$tra_rea_fec."'and det_tra_rea_estado='C'");
	$queryCotiza = mysql_query($sqlCotiza, $conexion_mysql) or die(mysql_error());
	$rowCotiza = mysql_fetch_assoc($queryCotiza);
	$tot_rowsCotiza = mysql_num_rows($queryCotiza);
?>
  <?php if($tot_rowsCotiza > 0)	{ ?>
                  <div class="row-fluid">
					<table class="table table-bordered table-condensed table-striped" id="tab_usr">
		 				<thead>
     					     <tr>
                              <th>Código</th>
                              <th>Tratamiento</th>
                              <th>Cant</th>
                              <th>Valor</th>
                          </tr>
                          </thead>
                          <tbody>
                          <?php do {
							  $totalTra=($rowCotiza['det_tra_rea_cantidad']*$rowCotiza['pre_val']);
							  $totalTra2=$totalTra2+$totalTra; 
							   ?>
                              <tr>
                                  <td><?php echo $rowCotiza['tra_id']; ?></td>
                                  <td><?php echo $rowCotiza['tra_nom']; ?></td>
                                  <td><?php echo $rowCotiza['det_tra_rea_cantidad']; ?></td>
                                  <td><?php echo $totalTra;?></td>
                              </tr>
                          <?php } while ($rowCotiza = mysql_fetch_assoc($queryCotiza)); ?>
                          </tbody>
                      </table>
                      <strong>VALOR TOTAL:  $ <a style="font-size:18px"><?php echo $totalTra2;?></a></strong>
                     </div>
                  <?php mysql_free_result($queryCotiza);
              }else{ echo '<div class="alert alert-error"><h4>No existen cotizaciones pendientes.</h4></div>'; } ?>


 