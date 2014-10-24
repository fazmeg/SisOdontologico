<?php 
	include('start.php');
	
	$loginFormAction = $_SERVER['PHP_SELF'];
	
	if (isset($_GET['accesscheck'])){
	 	$_SESSION['PrevUrl'] = $_GET['accesscheck'];
	}

	if (isset($_POST['user'])){	
  		$loginUsername=$_POST['user'];
		$password=$_POST['pass'];
		$MM_fldUserAuthorization = "";
		$MM_redirectLoginSuccess = "modulos/index.php";
		$MM_redirectLoginFailed = "index.php?wrong=wd";
		$MM_redirecttoReferrer = false;
		mysql_select_db($database_conexion_mysql, $conexion_mysql);
   		$LoginRS__query=sprintf("SELECT * FROM usuarios WHERE usr_nombre = %s AND usr_contrasena = %s",
    	GetSQLValueString($loginUsername, "text"), 
		GetSQLValueString(md5($password), "text"));    
  		$LoginRS = mysql_query($LoginRS__query, $conexion_mysql) or die(mysql_error());
		$row_RS_datos = mysql_fetch_assoc($LoginRS);		
  		$loginFoundUser = mysql_num_rows($LoginRS);	
  		
		if ($loginFoundUser){
    		$loginStrGroup = "";
    
			if (PHP_VERSION >= 5.1){
				session_regenerate_id(true);
			} 
			else{
				session_regenerate_id();
			}
			//declare session variables and assign them
			$_SESSION['MM_Username'] = $loginUsername;
			$_SESSION['MM_UserGroup'] = $loginStrGroup;
			$_SESSION['autentificacion'] = true;
			$_SESSION['id_usuario'] = $row_RS_datos['usr_id'];
			$_SESSION['id_empleado'] = $row_RS_datos['emp_id'];

    		if (isset($_SESSION['PrevUrl']) && false){
      			$MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    		}
    		header("Location: " . $MM_redirectLoginSuccess );
  		}
  		else{
   			header("Location: ". $MM_redirectLoginFailed );
  		}
	}
?>
<!doctype html>
<html>
<head>	
	<meta charset="utf-8">
   	<title>Iniciar Sesión - OdontoClinic</title>
    <?php include(RUTAs.'styles/styl-bootstrap.php'); ?>
    <link href="<?php echo $RUTAm.'login/styles/styl-login.css'; ?>" rel="stylesheet"></link>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="container">	    
        <div class="row">          
            <div class="span7">
                <img src="<?php echo $RUTAi.'logo-odontoclinic.png'; ?>">
            </div>          
            <div class="span5">
                <form name="form_login" class="formulario-login" method="POST" action="<?php echo $loginFormAction; ?>">
                    <h3>Acceso al sistema</h3>
                    <?php
                        if($_GET['wrong']=='wd'){
							echo '<div class="alert alert-error">';
							echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
							echo '<h6>Datos incorrectos, por favor intente de nuevo.</h6>';
							echo '</div>';
						}
                    ?>                        
                    <input type="text" class="input-block-level" placeholder="Usuario" name="user" required autofocus>       		
                    <input type="password" class="input-block-level" placeholder="Contraseña" name="pass" required>
                    <label class="checkbox"><input type="checkbox" value="remember-me">Recordar mis datos.</label>	
                    <input class="btn btn-large btn-block btn-primary" type="submit" name="btn_ingresar" value="Ingresar">  
                </form>
            </div>        	       
        </div>  
    </div>	    
</body>
<footer class="footer hidden-phone">
	<?php include(RUTAm.'login/login-footer.php'); ?>
</footer>
</html>