<?php 
	if (!isset($_SESSION)) session_start();
	include("../../start.php");
	fnc_autentificacion();
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Reporte facturas</title>
    <?php include(RUTAp.'jquery/styl-jquery.php'); ?>
    <?php include(RUTAs.'styles/styl-bootstrap.php'); ?>
</head>    
<body>
	<?php include(RUTAcom.'menu-principal.php'); ?>
    
    
    <div class="row-fluid">
    <div class="span2" >
    </div>
    <div class="span8" class="contenedor_cuerpo">
    <form>
    <table width="400" height="20px" align="center" border="0">
      <thead>
      <tr  align="center">
        <td>Fecha Inicial</td>
        <td></td>
        <td>Fecha Final</td>
        <td></td>
        <td>Filtrar</td>
        <td></td>
      </tr>
      </thead>
      <tbody>
      <tr>
        <td><input type="date" name="finicial"></td>
        <td></td>
        <td><input type="date" name="ffinal"></td>
        <td></td>
        <td><input type="text" name="filtro" placeholder="Ingrese número de factura"></td>
        <td></td>
        <td><input type="submit" class="btn"></td>
      </tr>
      
      </tbody>
    </table>
      
    </form>
    <br>
    <div>
    <hr>
    <table class="table table-hover">
      <thead style="border:#009">
        <tr style="text-align:center" style="margin:auto">
            <td>
                Ver Factura
            </td>
            <td>
                Numero de Factura
            </td>
            
            <td>
                RUC o Cédula
            </td>
            <td>
                Fecha
            </td>
            
            <td>
                Hora
            </td>
        </tr>
        
      </thead>
      
      <tbody>
        <tr style="text-align:center" style="color:#00C">
            <td >
                <button type="button" class="btn btn-primary"><img alt="#" src="../../img/lupa.png" height="10px"></button>
            </td>
            
            <td >
                0012345
            </td>
            
            <td>
                01010101010
            </td>
            <td>
                20/08/2013
            </td>
            
            <td>
                16:30
            </td>
        </tr>
      </tbody>
    </table>
    
    </div>
    </div>
</body>
</html>
