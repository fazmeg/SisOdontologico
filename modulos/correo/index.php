<?php 
	if (!isset($_SESSION)) session_start();
	include('../../start.php');
	fnc_autentificacion();
?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Enviar Correo desde el Sistema Odontologico</title>
 <?php include(RUTAp.'jquery/styl-jquery.php'); ?>
 <?php require_once(RUTAs.'styles/styl-bootstrap.php'); ?>
<script type="text/javascript">
$(document).on('ready', function(){
	
	function presionado(){
		//alert("barra de progreso");
		while(porcentage >=100) {
 			porcentage=porcentage+10;
		}

		
	}
$("#submit").click(function(){
		presionado();
	});
});
</script>
</head>

<body>
<?php include(RUTAcom.'menu-principal.php'); 
	fnc_msgGritter();
?>

<div class="container">
		<div class="page-header"><i class="icon-pencil"></i> <strong>NOTIFICACIONES DE ODONTOCLINIC </strong></div>
		<div class="row-fluid">
        <ul class="breadcrumb">
                    <li class="active"><i class="icon-envelope"></i> Gestor de Correo</li>
                </ul>
        	<div class="span2">
            </div>
            <div class="span8" id = "divcuerpo">
            <div class="control-group well">
                <form name="ENVIAR" method="post" action="<?php echo $RUTAm; ?>	correo/enviar_correo.php" onSubmit="">
                <table cellspacing="2">
                  <tr>
                    <td width="120px"><h5 style="color:#03C">DESTINATARIO </h5></td>
                    <td><input type="email" name="destinatario" id="destinatario" required placeholder="ejempo@gmail.com"></td>
                    
                  </tr>
                  <tr>
                    <td><h5 style="color:#03C">ASUNTO</h5></td>
                    <td><input type="text" name="asunto" id="asunto" required placeholder="Tema de Correo"></td>
                    <td>&nbsp;</td>
                    <td width="120px" ><button class="btn btn-info" align="center"  style="height:30px" type="submit" name="submit" id="submit" style="width:180PX" >Enviar</button>
                    </td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    
                  </tr>
                </table>
                  <textarea class="ckeditor" type="text" name="contenido" id="contenido" style="width:300px; height:300px" placeholder="Cuerpo del Correo"></textarea>
                    <script type=”text/javascript”>
           				CKEDITOR.replace ("contenido");
          				</script>
              <?php
					if($_POST["destinatario"]!=NULL){		
						while($porcentage <=90) {
 							$porcentage = $porcentage+10;
						}
					}
				?>
                
                </form>
                
                </div> 
                <div class="progress progress-striped active">
            	<div class="bar" name="barra" id="barra" style="width: <?php echo $porcentage;?>%;"></div>
                </div>
       		<div class="modal hide fade">
	    	<div class="modal-body">
                 
 				 
				</div>
            </div>
            </div>
            <div class="span2">
            </div>
        </div>
</body>


</html>