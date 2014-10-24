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
	<table border="0" cellpadding="0" cellspacing="0">
		<tr>
        	<td style="width:650px">
            	<table border="0" cellpadding="0" cellspacing="0">
                	<tr>
                    	<td style="width:450px; background:#C30"><div style="padding:5px 0px 5px 5px;">Cliente:</div></td>
                        <td style="width:200px; background:#C64"><div style="padding:5px 0px 5px 5px;">Fecha:</div></td>
                    </tr>
                </table>
                <table border="0" cellpadding="0" cellspacing="0">
                    <tr>
                    	<td style="width:300px; background:#C99"><div style="padding:5px 0px 5px 5px;">RUC/CI:</div></td>
                        <td style="width:350; background:#C12"><div style="padding:5px 0px 5px 5px;">Dirección:</div></td>
                    </tr>
                </table>
                <table border="0" cellpadding="0" cellspacing="0">
                    <tr>
                    	<td style="width:500px"></td>
                        <td style="width:150px; background:#06F"><div style="padding:5px 0px 5px 5px; >Teléfono</div></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
        	<td style="padding:40px 0px 0px 0px; height:160px; overflow:hidden;">
            <!-- DETALLE -->
            <?php $cont=1;
			for($x=0;$x<$cont;$x++){?>
            	<table border="0">
                	<tr>
                    	<td style="width:100px; background:#06F">Cantidad</td>
                        <td style="width:350px; background:#07F">Descripcion</td>
                        <td style="width:100px; background:#06F">Valor</td>
                        <td style="width:100px; background:#07F">Subtotal</td>
                    </tr>
                </table>
            <?php } ?>
            <!-- FIN DETALLE -->    
            </td>
        </tr>
        <tr>
        	<td>
            	<table style="font-size:8px" border="0">
                	<tr>
                    	<td style="width:350px;"></td>
                        <td style="width:300px; background:#07F"><div style="padding:5px 0px 5px 5px;">Subtotal</div></td>
                    </tr>
                    <tr>
                    	<td style="width:500px;"></td>
                        <td style="width:100px;"><div style="padding:5px 0px 5px 5px;">Descuento</div></td>
                    </tr>
                    <tr>
                    	<td style="width:500px;"></td>
                        <td style="width:100px;"><div style="padding:5px 0px 5px 5px;">IVA</div></td>
                    </tr>
                    <tr>
                    	<td style="width:500px;"></td>
                        <td style="width:100px; "><div style="padding:5px 0px 5px 5px;">Total</div></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>


</page>
<?php 
$content = ob_get_clean();
require_once(RUTAs.'funciones/html2pdf/html2pdf.class.php');
$pdf = new HTML2PDF('L','A5','fr','UTF-8');
$pdf->writeHTML($content);
$pdf->pdf->IncludeJS('print(TRUE)');
$pdf->Output('tratamientos.pdf'); 
?>

