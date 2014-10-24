<?php
	if (!isset($_SESSIOxN)) session_start();
	include('../../start.php');
	fnc_autentificacion();
	ob_start();
	$per_id=$_GET['id'];
	$tra_rea_fec=date('Y-m-d');
	$sqlPer = sprintf("SELECT * FROM persona WHERE per_id = '".$per_id."'");
	$queryPer = mysql_query($sqlPer, $conexion_mysql) or die(mysql_error());
	$rowPer = mysql_fetch_assoc($queryPer);
	$tot_rowsPer = mysql_num_rows($queryPer);
	
?>
<page>
            <!-- INICIO -->
<div style="padding:70px 0px 0px 50px; border:0px none #FFF; width:700px;">
<img src="../../images/odonto-logo-final.png" width="176" height="144"  alt=""/> 
<label  style="font-size:18px;"><?php
$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
echo $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;
?>
</label>

<h3 align="center" ><strong >Cotización de Tratamientos</strong></h3>
	<!-- INICIO -->
    <table border="1" cellpadding="0" cellspacing="0">
       <tr>
           <td style="width:658px; "><div style="padding:5px 0px 5px 5px;">Paciente:  <strong><?php echo $rowPer['per_nombre'];?></strong></div></td>
           </tr>
	</table>
	<table border="1" cellpadding="0" cellspacing="0">
    	<tr>
        	<td style="width:350px"><div style="padding:5px 0px 5px 5px;">Dirección:  <strong><?php echo $rowPer['per_direccion1'].' '.$rowPer['per_num_viv'];?></strong></div></td>
            <td style="width:300"><div style="padding:5px 0px 5px 5px;">E-Mail:  <strong><?php echo $rowPer['per_mail'];?></strong></div></td>
        </tr>
    </table>
    <strong><h5>DETALLE DE TRATAMIENTOS A REALIZAR</h5></strong>
    <!-- DETALLE -->
     <br>
		            <!-- FIN DETALLE -->    
           <?php	$sql = sprintf("SELECT * FROM detalle_tratamientosxrealizar inner join tratamientos on detalle_tratamientosxrealizar.tra_id=tratamientos.tra_id inner join precios on tratamientos.tra_id=precios.tra_id WHERE per_id = '".$per_id."' and tra_rea_fec= '".$tra_rea_fec."'");
			$query = mysql_query($sql, $conexion_mysql) or die(mysql_error());
			$row = mysql_fetch_assoc($query);
			$tot_rows = mysql_num_rows($query); 
		if($tot_rows>0){
		 ?>
            	<table border="1">
                	<tr>
                    	<td style="width:100px; text-align:center">Código</td>
                        <td style="width:350px; text-align:center">Nombre </td>
                        <td style="width:80px; text-align:center">Cantidad</td>
                        <td style="width:90px; text-align:center">Total</td>
                    </tr>
                    
                     <?php do {
							  $totalTra=($row['det_tra_rea_cantidad']*$row['pre_val']); 
							  $Suma=$Suma+$totalTra;
							   ?>
                    <tr>
                        <td style="text-align:center"><?php echo $row['tra_id']; ?></td>
                        <td><?php echo $row['tra_nom']; ?></td>
                        <td style="text-align:center"><?php echo $row['det_tra_rea_cantidad']; ?></td>
                        <td style="text-align:center"><?php echo $totalTra;?></td>
                    </tr>
  
					<?php } while ($row = mysql_fetch_assoc($query)) ?>
                    
                </table>
             <?php mysql_free_result($query);
              }else{ echo '<div ><h4>No existen tratamientos cotizados.</h4></div>'; }
            ?>
  </div>
            <!-- FIN -->
            <br>
            <table  border="0">
                	<tr>
                    	<td style="width:520px;"></td>
                        <td style="width:75px;"><div style="padding:5px 0px 5px 5px;">Subtotal</div></td>
                        <td style="width:55px;  text-align:center"><div style="padding:5px 0px 5px 5px;">$ <?php echo $Suma;?>,00</div></td>
                    </tr>
                    <tr>
                    	<td style="width:520px;"></td>
                        <td ><div style="padding:5px 0px 5px 5px;">Desc.</div></td>
                        <td style=" text-align:center"><div style="padding:5px 0px 5px 5px;">$ 0,00</div></td>
                    </tr>
                    <tr>
                    	<td style="width:500px;"></td>
                        <td ><div style="padding:5px 0px 5px 5px;">IVA</div></td>
                        <td style="  text-align:center"><div style="padding:5px 0px 5px 5px;">$ 0,00</div></td>
                    </tr>
                    <tr >
                    	<td style="width:500px;"></td>
                        <td ><div style="padding:5px 0px 5px 5px;">Total</div></td>
                        <td style="  text-align:center"><div style="padding:5px 0px 5px 5px;">$ <?php echo $Suma;?>,00</div></td>
                    </tr>
                </table>

            
   <br>
	<div style="padding:70px 0px 0px 50px; border:0px none #FFF; width:700px;">
    La  vigencia de este documento será de 15 días a partir de(l) <strong><?php echo $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y');?></strong><br>
   	Vargas Machuca 4-03 y Alfonso Jerves<br>
	<label>Cel:</label> (+593) 0999-933-190<br>
    <label title="Teléfono">Telf:</label> 2843854 - 4088269<br>
    <a href="mailto:#">info@odontoclinic.ec</a>
  	<strong>CUENCA, AZUAY - ECUADOR</strong>

</div>
</page>
<?php 
$content = ob_get_clean();
require_once(RUTAs.'funciones/html2pdf/html2pdf.class.php');
$pdf = new HTML2PDF('P','A4','fr','UTF-8');
$pdf->writeHTML($content);
$pdf->pdf->IncludeJS('print(TRUE)');
$pdf->Output('tratamientos.pdf'); 
?>

