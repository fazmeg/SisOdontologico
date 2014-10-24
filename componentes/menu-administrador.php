<title>Menu</title>
<!--  Barra de navegacion  -->
<div class="navbar navbar-fixed-bottom">
	<div class="navbar-inner">
    	<div class="container">
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span> 
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>   
            </button>
        	<div><img src="../images/Administrative-Tools-32.png" class="pull-left" ></div>
            	<div class="nav-collapse collapse">
                <!--  Dropdowns Recepción -->
                <!--  Dropdowns -->    
                    <ul class="nav">
            			<li style="color:#FFF">  '</li>
                       	<li><div><h4><strong>Administración de Sistema</strong></h4></div></li>
                 		<li></li>
                        <li><a href=<?php echo $RUTAm.'administrador/crear-usuario.php'; ?> >Crear Usuario</a></li>
                        <li><a href=<?php echo $RUTAm.'administrador/actualizar-usuario.php'; ?>>Actualizar Usuario</a></li>
                        <li><a href=<?php echo $RUTAm.'administrador/eliminar-usuario.php'; ?>>Eliminar Usuario</a></li>
                        <li><a href=<?php echo $RUTAm.'administrador/modificar-permisos.php'; ?>>Modificar Permisos</a></li>
                    </ul>
                </div>
           </div>
      </div>
</div>
