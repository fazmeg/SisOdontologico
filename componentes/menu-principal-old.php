<div class="navbar navbar-inverse">
	<div class="navbar-inner">
  		<div class="container">
        	<button class="btn btn-navbar" data-target=".nav-collapse" data-toggle="collapse" type="button">
            	<span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
          	<a class="brand" href="<?php echo $RUTAm.'index.php'; ?>">ODONTO CLINIC</a>            
 			<div class="nav-collapse collapse">           
                <ul class="nav navbar-nav">
                	<!-- Inicio --> 
                   	<li>
                   		<a href="<?php echo $RUTAm.'index.php'; ?>" class="dropdown-toggle" >Inicio</a>       	 
                   	</li> 
                	<!-- Pacientes -->               
                    <li class="dropdown">
                    	<a href="#" class="dropdown-toggle" data-toggle="dropdown">Pacientes
                    		<b class="caret"></b>
                        </a>
                       	<ul class="dropdown-menu" >
                            <li><a tabindex="-1" href="<?php echo $RUTAm.'pacientes/crear-paciente.php'; ?>">Mantenimiento</a></li>
                            <li><a tabindex="-1" href="#">*Sesiones*</a></li>
                            <li><a tabindex="-1" href="<?php echo $RUTAm.'odontologico/odontograma.php'; ?>">Odontograma</a></li>
                        </ul>
                 	</li>
                	<!-- Citas -->                
                	<li class="dropdown">
                    	<a href="#" class="dropdown-toggle" data-toggle="dropdown">Citas
                      		<b class="caret"></b>
                    	</a>  
                        <ul class="dropdown-menu" >
                        	<li><a tabindex="-1" href="<?php echo $RUTAm.'citas/reservar.php'; ?>">Reservar</a></li>
                        	<li><a tabindex="-1" href="<?php echo $RUTAm.'citas/agenda.php'; ?>">Agenda</a></li> 	  	
                    	</ul>
                  	</li>
                	<!-- Facturación -->                
                   	<li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Facturación
                            <b class="caret"></b>
                        </a>   
                        <ul class="dropdown-menu" >
                           <li><a tabindex="-1" href="<?php echo $RUTAm.'facturacion/facturar.php'; ?>">Facturar</a></li>
                           <li><a tabindex="-1" href="<?php echo $RUTAm.'facturacion/anular-factura.php'; ?>">Anular Factura</a></li>
                      	</ul>
                  	</li>
                	<!-- Reportes-->                
                	<li class="dropdown">
                    	<a href="#" class="dropdown-toggle" data-toggle="dropdown">Reportes
                      		<b class="caret"></b>
                    	</a>    
                        <ul class="dropdown-menu" >
                       		<li><a tabindex="-1" href="<?php echo $RUTAm.'reportes/reporte-citas.php'; ?>">Citas</a></li>
                       		<li><a tabindex="-1" href="<?php echo $RUTAm.'reportes/reporte-facturas.php'; ?>">Facturas</a></li>
                       	</ul>
                  	</li>
                	<!-- Administracion -->                
                   <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Administración
                            <b class="caret"></b>
                        </a>    
                       	<ul class="dropdown-menu" >
                            <li><a tabindex="-1" href="<?php echo $RUTAm.'administrador/crear-usuario.php'; ?>">Usuarios</a></li>
                       		<li><a tabindex="-1" href="#">Roles</a></li>
                       		<li><a tabindex="-1" href="#">Consultorios</a></li>
                       		<li><a tabindex="-1" href="#">Talento Humano</a></li>  		     
                    	</ul>
                  	</li>
                	<!-- Ayuda -->                
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Ayuda
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu" >
                            <li><a tabindex="-1" href="#">Manual de Usuario</a></li>
                        </ul>
                    </li>                
            	</ul> 
                <!-- Nombre de usuario logeado -->
               	<ul class="nav navbar-nav pull-right">
                	<li class="divider-vertical"></li>
                    <li class="dropdown user">                    
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img alt="username" src="<?php echo $RUTAi.'user.png'; ?>" style="max-width:25px; max-height:25px;"/>
                            <?php echo $_SESSION['nombre_usr']; ?>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a tabindex="-1" href="#"><i class="icon-user"></i> Mi perfil</a></li>
                            <li class="divider"></li>
                            <li><a tabindex="-1" href="<?php echo $RUTA.'logout.php'?>"><i class="icon-off"></i> Salir</a></li>
                    	</ul>
                	</li>        
           		</ul>
           </div>   
  		</div>
    </div>  
</div>