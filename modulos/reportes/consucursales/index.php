<?php 
	if (!isset($_SESSION)) session_start();
	include("../../../start.php");
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
    <br>
    <br>
    <div class="row-fluid">
    	<div class="span1" >
    	</div>
    	<div class="span10" >
        	<div class="well">
            	<div>
                	<div class="row-fluid">
    					<div class="span4" align="center">
                        <strong><label>Seleción de Flitro </label></strong>
                        	<select  name="sectip" id="sectip">
                             	<option value="1">Individual</option>
								<option value="2">Todos</option>
                            </select>
                        </div>
                        <div class="span4" align="center">
                        <strong><label>Nombre </label></strong>
            				<input class="in-medium" name="nom" id="nom" placeholder="Nombre" required>
                        </div>
                        <div class="span4" align="center" >
                        <br>
            				<button class="btn btn-info" name="btnbuscar" id="btnbuscar" onClick="Generar()" ><strong>Buscar</strong></button>
                            <input type="hidden" id="url_autocomplete" value="<?php echo $RUTAm."reportes/consucursales/funciones/aut_suc.php"; ?>">
                            <input type="hidden" id="suc_id" name="suc_id" >

                        </div>
                    </div>    
                </div>    
            </div>
    	</div>
        <div class="span1" >
    	</div>
    </div>
    </div>
    
    <div class="row-fluid">
    	<div class="span1" >
    	</div>
    	<div class="span10" >
        	<div class="well">
            	<div>
                	<div class="row-fluid">
    					<div class="control-group well" id="ContenedorResultado">
                    </div>    
                </div>    
            </div>
    	</div>
        <div class="span1" >
    	</div>
    </div>
    </div>
</body>
</html>
<script>

function Generar()
{ 
var suc  =   $("#suc_id").val();
var sectip = $("#sectip").val();
	if((suc=="") && (sectip==1)){
	alert ("Seleccione una sucursal");
	refrescar();
	}else{
		 cargar(suc,sectip);
		 $("#nom").val("");
		 $("#suc_id").val("");
		 }
}
function cargar(suc,sectip){
			$("#ContenedorResultado").load("resultado.php?suc_id="+suc+"&sectip="+sectip);
			$("#suc_id").val("");
}
function refrescar(){
			$("#ContenedorResultado").load("limpiar.php");
}
function solonumeros(e)
{
	var keynum = window.event ? window.event.keyCode : e.which;
	if ((keynum == 8) || (keynum == 46))
	return true;

	return /\d/.test(String.fromCharCode(keynum));
}

$( "#nom" ).autocomplete({
    source: $("#url_autocomplete").val() ,//availableTags,
    select: function( event, ui ) {

      ///  $("#inputproducto").val(ui.item.code);
        $("#nom").val(ui.item.label);
		$("#suc_id").val(ui.item.code);
    },
	focus: function( event, ui ) {

	}
   });

</script>