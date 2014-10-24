<?php 
	if (!isset($_SESSION)) session_start();
	include("../../start.php");
	fnc_autentificacion();
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Reporte citas</title>
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
        <td><input type="text" name="filtro" placeholder="Ingrese el caracter para filtrar"></td>
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
                Nombres
            </td>
            
            <td>
                Teléfono
            </td>
            <td>
                Doctor
            </td>
            
            <td>
                Hora
            </td>
        </tr>
        
      </thead>
      
      <tbody>
        <tr style="text-align:center">
            <td>
                taty
            </td>
            
            <td>
                9090909
            </td>
            <td>
                cristofer car
            </td>
            
            <td>
                21:30
            </td>
        </tr>
      </tbody>
    </table>
    
    </div>
    </div>
</body>
</html>