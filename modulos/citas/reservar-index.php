<?php 
	if (!isset($_SESSION)) session_start();
	include("../../start.php");
	fnc_autentificacion();
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Agenda</title>
    <?php include(RUTAp.'jquery/styl-jquery.php'); ?>
    <?php include(RUTAs.'styles/styl-bootstrap.php'); ?>
    <script type="text/javascript">
		$(document).on('ready', function(){
			$("#paciente").autocomplete({
				source: 'funciones/bus-pac.php',
				minLength: 1,
				autoFocus: true
			});
		});
	</script>
    <style>
		#external-events {
			padding: 10px;
			background: #DFF0D8;		
		}
		.external-event {
			margin: 10px 0;
			padding: 2px 4px;
			background: #3366CC;
			color: #fff;	
			cursor: pointer;
		}
		#calendar {
			width: 750px;
		}
	</style>
</head>    
<body>	
	<?php include(RUTAcom.'menu-principal.php'); ?>
    <div class="container">
		<div class="page-header"><h3>GESTIÓN DE CITAS</h3></div>
        <div class="row-fluid">
        	<div class="span4">
                <div class="alert alert-success">
                    <legend style="text-align:right"><strong>PACIENTE</strong></legend>
                    <input type="text" class="input-block-level" id="paciente" name="paciente" placeholder="Buscar paciente" required>
                    <div class="row-fluid">
                        <div class="span3"><label class="label label-info">Documento</label></div>
                        <div class="span9"><label class="label label-success">1400663389</label></div>
                    </div>
                    <div class="row-fluid">
                        <div class="span3"><label class="label label-info">Nombres</label></div>
                        <div class="span9"><label class="label label-success">Fausto Fabian Suarez Quito</label></div>
                    </div>
                    <div class="row-fluid">
                        <div class="span3"><label class="label label-info">Ciudad</label></div>
                        <div class="span9"><label class="label label-success">Cuenca</label></div>
                    </div>
                </div>              
                <div class="alert alert-success">
                    <legend style="text-align:right"><strong>TRATAMIENTO</strong></legend>
                    <?php fnc_genSelect(fnc_datosTra(),'input-block-level','tratamiento','required'); ?>
                </div>
                <div id='external-events'>                                         
                    <div class='external-event' id='drop-remove'>Fausto Suarez</div>
                    <div class='external-event' id='drop-remove'>Fausto Suarez</div>
                </div>
        	</div>
            <div class="span8">
                <div id='calendar'></div>    
                <div style='clear:both'></div>
            </div>        	
    	</div>
	</div>
</body>
</html>