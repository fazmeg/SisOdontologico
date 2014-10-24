<?php 
	include('../../start.php');
	
	?>
     <?php include(RUTAp.'jquery/styl-jquery.php'); ?>
     
    <?php require_once(RUTAs.'styles/styl-bootstrap.php'); ?>
<div class="row-fluid">
        <div class="control-group well">
       		 <ul class="nav nav-tabs">
              <li class="active"><a href="#tab1" data-toggle="tab">Odontograma</a></li>
              <li><a href="#tab2" data-toggle="tab">Endodoncia</a></li>
              <li><a href="#tab3" data-toggle="tab">Ortodoncia</a></li>
              <li><a href="#tab4" data-toggle="tab">Estética</a></li>
              <li><a href="#tab5" data-toggle="tab">Cirugía</a></li>
              <li><a href="#tab6" data-toggle="tab">Pendiente</a></li>
              
            </ul>
            <div class="tab-content">
       			<div class="tab-pane active" id="tab1" style="height:600px">    <!--tab 1 odontograma INICIO-->    <?php     
    echo $odo_row1;
    ?>
    <div class="dropdown">
                    <?php if($odo_row1['odo_url']==NULL){ ?>
                   		<img class="dropdown-toggle" id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="/page.html" src="<?php echo $RUTAi?>odo/1.png">
                        <?php  }
						else{?>
                   		<img class="dropdown-toggle" id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="/page.html" src="<?php echo $RUTAi.$odo_row1['odo_url'];?>">
							
						<?php	} ?>
		                <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel" >
                        	
        		            <li><form name="b1s1u1p1" method="post" action="<?php echo $RUTAm; ?>	historia_clinica/funciones/historiaclinica-fncs.php" onSubmit="SeleccionDaño()" >
                            <input type="hidden" name="per_nombre" id="per_nombre" value="<?php echo $datpac['per_nombre']; ?>">
                            <input type="hidden" name="odo_id" id="odo_id" value="1">
                        	<input type="hidden" name="odo_bloque" id="odo_bloque" value="1">
                            <input type="hidden" name="odo_posicion" id="odo_posicion" value="1">
                        	<input type="hidden" name="odo_ubicacion" id="odo_ubicacion" value="1">
                            <input type="hidden" name="per_id" id="per_id" value="<?php echo $per_id;?>">
                        	<input type="hidden" name="odo_url" id="odo_url" value="images/odo/1_sup.png">
                            <input type="hidden" name="accion" id="accion" value="Actualizar">
                            <input type="checkbox" name="checkbox1" id="checkbox1" value="1">
                            </form>
                            </li>
                            
                            
                            <li>
                            <form name="b1s1u1p2" method="post" action="<?php echo $RUTAm; ?>	historia_clinica/funciones/historiaclinica-fncs.php">
                            <input type="hidden" name="per_nombre" id="per_nombre" value="<?php echo $datpac['per_nombre']; ?>">
                        	<input type="hidden" name="odo_id" id="odo_id" value="1">
                        	<input type="hidden" name="odo_bloque" id="odo_bloque" value="1">
                            <input type="hidden" name="odo_posicion" id="odo_posicion" value="1">
                        	<input type="hidden" name="odo_ubicacion" id="odo_ubicacion" value="1">
                            <input type="hidden" name="per_id" id="per_id" value="<?php echo $per_id;?>">
                        	<input type="hidden" name="odo_url" id="odo_url" value="images/odo/1_der.png">
                            <input type="hidden" name="accion" id="accion" value="Insertar">
                            <input type="checkbox" name="checkbox1" id="checkbox1" value="1">
                            </form>
                            </li>
                            <li>
                            <form name="b1s1u1p3" method="post" action="<?php echo $RUTAm; ?>	historia_clinica/funciones/historiaclinica-fncs.php">
                            <input type="hidden" name="per_nombre" id="per_nombre" value="<?php echo $datpac['per_nombre']; ?>">
                            <input type="hidden" name="odo_id" id="odo_id" value="1">
                        	<input type="hidden" name="odo_bloque" id="odo_bloque" value="1">
                            <input type="hidden" name="odo_posicion" id="odo_posicion" value="1">
                        	<input type="hidden" name="odo_ubicacion" id="odo_ubicacion" value="1">
                            <input type="hidden" name="per_id" id="per_id" value="<?php echo $per_id;?>">
                        	<input type="hidden" name="odo_url" id="odo_url" value="images/odo/1_inf.png">
                            <input type="hidden" name="accion" id="accion" value="Actualizar">
                           <input type="checkbox" name="checkbox2" id="checkbox2" value="1">
                            </form>
                            </li>
                            <li>
                            <form name="b1s1u1p4" method="post" action="<?php echo $RUTAm; ?>	historia_clinica/funciones/historiaclinica-fncs.php">
                            <input type="hidden" name="per_nombre" id="per_nombre" value="<?php echo $datpac['per_nombre']; ?>">
                            <input type="hidden" name="odo_id" id="odo_id" value="1">
                        	<input type="hidden" name="odo_bloque" id="odo_bloque" value="1">
                            <input type="hidden" name="odo_posicion" id="odo_posicion" value="1">
                        	<input type="hidden" name="odo_ubicacion" id="odo_ubicacion" value="1">
                            <input type="hidden" name="per_id" id="per_id" value="<?php echo $per_id;?>">
                        	<input type="hidden" name="odo_url" id="odo_url" value="images/odo/1_izq.png">
                            <input type="hidden" name="accion" id="accion" value="Actualizar">
                            <input type="checkbox" name="checkbox3" id="checkbox3" value="1">
                            </form>
                            </li>
                            <li>
                            <form name="b1s1u1p5" method="post" action="<?php echo $RUTAm; ?>	historia_clinica/funciones/historiaclinica-fncs.php">
                            <input type="hidden" name="per_nombre" id="per_nombre" value="<?php echo $datpac['per_nombre']; ?>">
                            <input type="hidden" name="odo_id" id="odo_id" value="1">
                        	<input type="hidden" name="odo_bloque" id="odo_bloque" value="1">
                            <input type="hidden" name="odo_posicion" id="odo_posicion" value="1">
                        	<input type="hidden" name="odo_ubicacion" id="odo_ubicacion" value="1">
                            <input type="hidden" name="per_id" id="per_id" value="<?php echo $per_id;?>">
                        	<input type="hidden" name="odo_url" id="odo_url" value="images/odo/1_tot.png">
                            <input type="hidden" name="accion" id="accion" value="Actualizar">
                            <input type="checkbox" name="checkbox4" id="checkbox4" value="1">
                            </form>
                            </li>
                            <li>
                            <a href="javascript:odo1()">Consulta  <i class="icon-warning-sign"></i><a> 
                            </li>
                         </ul>
                    </div>
 <form action="<?php echo $RUTAm; ?>historia_clinica/funciones/historiaclinica-fncs.php" method="post" name="SOLUCION_1"> 
							<input type="hidden" name="per_nombre" id="per_nombre" value="<?php echo $datpac['per_nombre']; ?>">
                            <input type="hidden" name="odo_id" id="odo_id" value="1">
                        	<input type="hidden" name="odo_bloque" id="odo_bloque" value="1">
                            <input type="hidden" name="odo_posicion" id="odo_posicion" value="1">
                        	<input type="hidden" name="odo_ubicacion" id="odo_ubicacion" value="1">
                            <input type="hidden" name="per_id" id="per_id" value="<?php echo $per_id;?>">
                        	<input type="hidden" name="odo_url" id="odo_url" value="images/odo/1_tot.png">
                            <input type="hidden" name="accion" id="accion" value="Actualizar">
                            
</form> 
    <form action="<?php echo $RUTAm; ?>historia_clinica/funciones/bus-odontograma.php" method="post" name="CONSULTA1"> 
					     	
                            <input type="hidden" name="odo_bloque" id="odo_bloque" value="1">
                            <input type="hidden" name="odo_posicion" id="odo_posicion" value="1">
                        	<input type="hidden" name="odo_ubicacion" id="odo_ubicacion" value="1">
                            <input type="hidden" name="per_id" id="per_id" value="<?php echo $per_id; ?>">
                            
</form> 
    

 				</div>
                <div class="tab-pane active" id="tab2" >    <!--tab 1 odontograma INICIO-->         
    
 				</div>
         	</div>