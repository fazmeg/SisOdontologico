<?php 
include('../../start.php');
	$tra_rea_fec=$_GET['tra_rea_fec'];
    $per_id=$_GET['per_id'];
	$sqlCotiza = sprintf("SELECT * FROM detalle_tratamientosxrealizar inner join tratamientos on detalle_tratamientosxrealizar.tra_id=tratamientos.tra_id inner join precios on tratamientos.tra_id=precios.tra_id WHERE per_id = '".$per_id."' and tra_rea_fec='".$tra_rea_fec."'and det_tra_rea_estado='C'");
	$queryCotiza = mysql_query($sqlCotiza, $conexion_mysql) or die(mysql_error());
	$rowCotiza = mysql_fetch_assoc($queryCotiza);
	$tot_rowsCotiza = mysql_num_rows($queryCotiza);
?>
<script>
	$( document ).ready(function() {
		$("#btnfac").hide();
	});
	function FacturarTratamientos(fecha,per_id)
	{ 
		//Cabecera
		ModelodePago=$("#SelecioneModeloPago").val();
		Descuento=$("#Aplica_Descuento").val();
		total=$("#total").val();
		tdescuento=$("#tdescuento").val();
		id_fac=$("#id_fac").val();
		url=$("#urlfac").val();
		alert(fecha+" "+per_id+" "+ModelodePago+" "+Descuento +" "+id_fac);
		parametros='ModelodePago='+ModelodePago+'&Descuento='+Descuento+'&id_fac='+id_fac+'&tdescuento='+tdescuento+'&total='+total+'&fecha='+fecha+'&per_id='+per_id;
		
		//Detalle de Factura
		$.ajax({
			type: "POST",
			url: url,
			data: parametros,
			success : function (resultado){
				alert(resultado); 
			}
   			});
	
		}
			function Validatefactura()
	{ 
		id_fac=$("#id_fac").val();
		
		
		if(id_fac!=null)
		{
			$("#btnfac").show();
			}
		
		}
</script>
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
							  $descuento=($rowCotiza['pre_val']/100);
							  $totdes=($totdes+($totalTra*$descuento));
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
				<input type="hidden" id="tdescuento" name="tdescuento" value="<?php echo $totdes;?>">
                <input type="hidden" id="total" name="total" value="<?php echo $totalTra2;?>">
<div class="control-group well" >
                 <div class="row-fluid">
                 	<div class="span6">
                   <div>
                   <strong> Forma de Pago</strong>
					<select id="SelecioneModeloPago" name="SelecioneModeloPago">
                      <option value="1">Contado</option>
                      <option value="2">Crédito</option>
                    </select>
                    </div>
                     <div>
                   <strong> Aplica Descuento</strong>
					<select id="Aplica_Descuento" name="Aplica_Descuento">
                      <option value="N">NO</option>
                      <option value="S">SI</option>
                    </select>
                    </div>
                     </div>
                     <input type="hidden" name="per_id" id="per_id" value="<?php echo $per_id; ?>">
					 <input type="hidden" name="tra_rea_fec" id="tra_rea_fec" value="<?php echo $tra_rea_fec; ?>">
					 <input type="hidden" name="urlfac" id="urlfac" value="<?php echo $RUTAm.'historia_clinica/funciones/funciones.php'; ?>">
                     <div class="span1">
                     </div>
                     <div class="span5">
                    <button type="button" class="btn btn-primary"  onClick="modalfac()"> <strong>DATOS DE LA FACTURA</strong></button>
                     <button style="height:60px" class="btn btn-primary" id="btnfac" name="btnfac"  onClick="FacturarTratamientos('<?php echo $tra_rea_fec; ?>','<?php echo $per_id; ?>')"><strong> Confirmar Factura</strong></button>
                     </div> 
                 </div>
                 </div>
                 Número de Factura 
                 <input type="text" name="id_fac" id="id_fac" placeholder="Número de Factura" onKeyPress="Validatefactura()" required>
                 
                 
                            <!-- Modal -->
        <div align="center" id="modalfac"   class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="modalfac" aria-hidden="true">
          <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 id="modalcredito"><strong>Datos de la Factura</strong></h4>
                <div align="center">
              
            </div>
          </div>
          <div class="modal-body">
            ==============> hola 
          </div>
          <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
          </div>
        </div>

 