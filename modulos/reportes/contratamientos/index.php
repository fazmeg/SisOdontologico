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
                        	<select id="sectip" name="sectip">
                             	<option value="1">Individual</option>
								<option value="2">Todos</option>
                            </select>
                        </div>
                        <div class="span4" align="center">
                        <strong><label>Cédula de Identidad </label></strong>
            				<input class="in-medium" name="per_doc" id="per_doc" placeholder="Cédula de Identidad" onkeypress="return solonumeros(event);" maxlength="13" >
                        </div>
                        <div class="span4" align="center" >
                        <br>
            				<button class="btn btn-info" name="btnbuscar" id="btnbuscar" onClick="Generar()" ><strong>Buscar</strong></button>

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
var doc  =   $("#per_doc").val();
var sectip = $("#sectip").val();
	if((doc=="") && (sectip==1)){
	alert ("Ingrese un número de Cédula o RUC");
	refrescar();
	}else{
		 cargar(doc,sectip);
		 }
}
function cargar(doc,sectip){
			$("#ContenedorResultado").load("resultado.php?per_doc="+doc+"&sectip="+sectip);
			$("#per_doc").val("");
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

</script>