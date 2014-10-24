<div class="row"> <!--- Inicio Fila 1  -->
<div class="span6"><!--- Inicio Fila bloque 1  -->
 	<div class="span1">
    
    </div>
    <div class="span1" align="center">
    <label>18</label>
    <table cellspacing="2">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
    </table>
    <?php //SELECT SUBSTRING(odo_b1,1,1)  FROM ODONTO  ?>
    <table cellspacing="2">
      <tr>
        <td>&nbsp;</td>
         <td><img src= "<?php echo $RUTAi;?>odo/fig1.png" /></td>
      </tr>
      <tr>
        <td><img src= "<?php echo $RUTAi;?>odo/fig1.png" /></td>
        <td><img src= "<?php echo $RUTAi;?>odo/fig1.png" /></td>
        <td><img src= "<?php echo $RUTAi;?>odo/fig1.png" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><img src= "<?php echo $RUTAi;?>odo/fig1.png" /></td>
        <td>&nbsp;</td>
      </tr>
    </table>

    <div>
    
    </div>
    </div>
    <div class="span1">
    17
    </div>
    <div class="span1">
    16
    </div>
    <div class="span1">
    15
    </div>
    <div class="span1">
    14
    </div>
    <div class="span1">
    13
    </div>
    <div class="span1">
    12
    </div>
    <div class="span1">
    11
    </div>
</div>	<!--- Fin Fila bloque 1  -->	
<div class="span6">
<div class="span6"><!--- Inicio Fila bloque 2  -->
    <div class="span1">
    21
    </div>
    <div class="span1">
    22
    </div>
    <div class="span1">
    23
    </div>
    <div class="span1">
    24
    </div>
    <div class="span1">
    25
    </div>
    <div class="span1">
    26
    </div>
    <div class="span1">
    27
    </div>
    <div class="span1">
    28
    </div>
</div>	<!--- Fin Fila bloque 2  -->
</div>
</div><!--- Fin Fila 1  -->
<div class="row"> <!--- Inicio Fila 2  -->
<div class="span6">
		<?php echo 'ssss'.$per_id; ?>
</div>		
<div class="span6">
		<?php echo 'ssss'.$per_id; ?>
</div>
</div><!--- Fin Fila 2  -->


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