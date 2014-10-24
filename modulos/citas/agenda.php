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
    <style>
	#external-events {
		float: left;
		width: 150px;
		padding: 0 10px;
		border: 1px solid #ccc;
		background: #eee;
		text-align: left;
		}		
	#external-events h4 {
		font-size: 16px;
		margin-top: 0;
		padding-top: 1em;
		}		
	.external-event { /* try to mimick the look of a real event */
		margin: 10px 0;
		padding: 2px 4px;
		background: #3366CC;
		color: #fff;
		font-size: .85em;
		cursor: pointer;
		}		
	#external-events p {
		margin: 1.5em 0;
		font-size: 11px;
		color: #666;
		}		
	#external-events p input {
		margin: 0;
		vertical-align: middle;
		}
	#calendar {
		float: right;
		width: 900px;
	}
</style>
</head>    
<body>
	<?php include(RUTAcom.'menu-principal.php'); ?>
    <div class="container">
		<div class="page-header"><h3>GESTIÓN DE CITAS</h3></div>
        <div id='wrap'>
            <div id='external-events'>
                <h4>Draggable Events</h4>
                <div class='external-event'>My Event 1</div>
                <div class='external-event'>My Event 2</div>
                <div class='external-event'>My Event 3</div>
                <div class='external-event'>My Event 4</div>
                <div class='external-event'>My Event 5</div>
                <p>
                <input type='checkbox' id='drop-remove' /> <label for='drop-remove'>remove after drop</label>
                </p>
            </div>    
        	<div id='calendar'></div>    
        	<div style='clear:both'></div>
    	</div>
	</div>
</body>
</html>