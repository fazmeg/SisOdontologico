
 <?php
  
 	$Suma = $_POST['Suma'];
 	/*Consulta uno Categorias*/
	$sql = sprintf("SELECT * FROM tra_categorias where tra_cat_elim='N'");
	$query = mysql_query($sql, $conexion_mysql) or die(mysql_error());
	$row = mysql_fetch_assoc($query);
	$tot_rows = mysql_num_rows($query);
	/*Consulta dos tratamientos*/
	$sql2 = sprintf("SELECT * FROM tratamientos inner join tra_categorias on tratamientos.tra_cat_id = tra_categorias.tra_cat_id ");
	$query2 = mysql_query($sql2, $conexion_mysql) or die(mysql_error());
	$row2 = mysql_fetch_assoc($query2);
	$tot_rows2 = mysql_num_rows($query2);
	

?> 
<script>
		var Total=0;
	function totalprod(CatId,cont)
	{
		var valor_pro=$("#cant_pre"+CatId+cont+"").val();
		var valor_ingre=$("#val_ingre"+CatId+cont+"").val();
		var valor_pro_tot=valor_pro*valor_ingre;
		var valor_registrado=$("#resp_val"+CatId+cont+"").val();
		var fecha=$("#Fecha").val();
		var signo;
		var tra_id=$("#traID"+CatId+cont+"").val();
		
		if(valor_registrado<valor_pro_tot)
		{
			signo=1;
		}
		else
		{
			signo=2;
		}
		$("#resp_val"+CatId+cont+"").attr('Value',valor_pro_tot);
		
//		alert("El parametro sera: "+valor_ingre+" "+tra_id+" "+fecha);
		Caltotal(valor_pro_tot,signo,valor_registrado,valor_pro);
		//buscar_existenciatra(0,tra_id);
	Aplicar_tratamientos(tra_id,fecha,valor_ingre)
	}
	function Aplicar_tratamientos(tra_id,fecha,det_tra_rea_cantidad)
{
	per_id=$("#per_id").val();
	
	var parametros_tra_per = "per_id="+per_id+"&tra_id="+tra_id+"&fecha="+fecha+"&det_tra_rea_cantidad="+det_tra_rea_cantidad;
	url_tra_apli = $("#url_func_tra").val();	
			$.ajax({
			type: "POST",
			url: url_tra_apli,
			data: parametros_tra_per,
			success : function (resultado){//alert(resultado); 
			}
    });
		}

	
	//Funcion de suma total de tratamientos
		function Caltotal(Valor,signo,valor_registrado,valor_pro)
		{
			if(signo==1)
			{
				Total=Total - valor_registrado;
				Total= Total + Valor;
			}
			else
			{ 
					Total= Total - valor_pro;
			}
			$("#total").attr('value',Total.toFixed(2));
			var IVA= Total*0;
			//$("#iva").val(IVA);
			$("#iva").attr('value',IVA.toFixed(2));
			var GranTotal=Total+ IVA;
			$("#GranTotal").attr('value',GranTotal.toFixed(2));
			//$("#conten").attr("visible");
		}

function buscar_existenciatra(tratamientoID,tra_id)
{
	per_id = $("#per_id").val();
	var parametros = "per_id="+per_id+"&tra_id="+tra_id;
	url_exi = $("#Url3").val();	
		
			$.ajax({
			type: "POST",
			url: url_exi,
			data: parametros,
			success : function (datos_tra) { 
                          if(datos_tra!=null)
						  {
						   //alert(datos['det_die_per_id']);       //muestra el resultado en la alerta
						tratamientoID=1;   
						  }else{
							  tratamientoID=0;
							  } }
    });
	   
		}
</script>
<div class="row-fluid">
	<div class="control-group well">
    	<ul class="nav nav-tabs">     <!------     Inicio de Etiquetas      ------->
        	<li class="active"><a href="#Odonto" data-toggle="tab">Odontograma</a></li>
            	<?php do {
					 $posicion++;
				?>
				<li ><a href="#<?php echo $row['tra_cat_id'];?>" data-toggle="tab"><?php echo $row['tra_cat_nom'] ?></a></li>
                
                
				<?php 
				} while ($row = mysql_fetch_assoc($query)); 
				?>
		</ul> <!------     Fin de Etiquetas      ------->
        <div  class="tab-content">     <!------     Inicio de Contenedor      ------->
            <div class="tab-pane active" id="Odonto" >
                <?php include "hc_odontograma_A.php";     ?>
           </div>
            	<?php 
					do {?>
                    
                        <div class="tab-pane " id="<?php echo $row2['tra_cat_id'] ?>">
                        <!-------   Cuerpo --------->
                        <?php
						$tot_rowstra=0;
						$CatId = $row2['tra_cat_id'];
						/* Consulta de tratamientos */
		 				$sqltra = sprintf("SELECT * FROM tratamientos inner join precios on tratamientos.tra_id=precios.tra_id WHERE tra_cat_id = '".$CatId."'");
						$querytra = mysql_query($sqltra, $conexion_mysql) or die(mysql_error());
						$rowtra = mysql_fetch_assoc($querytra);
						$tot_rowstra = mysql_num_rows($querytra);
						
						/* Consulta de precios 
		 				$sqltrapre = sprintf("SELECT * FROM precios WHERE tra_id = '".$rowtra['tra_id']."'");
						$querytrapre = mysql_query($sqltrapre, $conexion_mysql) or die(mysql_error());
						$rowtrapre = mysql_fetch_assoc($querytrapre);
						$tot_rowstrapre = mysql_num_rows($querytrapre);
						*/
						?><div class="row-fluid" align="left"><?php 
							?><div class="span2"><?php
							?></div><?php
							
							if($tot_rowstra>0){
							
							?><div class="span8">
                            <form class="form-horizontal" method="post" action="<?php echo $RUTAm; ?>historia_clinica/funciones/hc_tra-fncs.php" >
                            <?php echo $Suma;?>
							<table class="table table-bordered table-condensed table-striped" id="tab_tra" align="center">
                                <thead align="center">
                                    <tr style="text-align:center">
                                        <th style="text-align:center">Id</th>
                                        <th style="text-align:center">Nombre</th>
                                        <th style="text-align:center">Cantidad</th>
                                        <th style="text-align:center">Valor por Tratamiento</th>
                                    </tr>
                                </thead>
                                <tbody >
						<?php do{  $cont=$cont+1; ?>
							<tr >
                                <td style="text-align:center"><?php echo $rowtra['tra_id'];?></td>
                                <td style="text-align:center"><?php echo $rowtra['tra_nom'];?></td>      
                                <input type="hidden" id="cant_pre<?php echo $CatId.$cont;?>" value="<?php echo $rowtra['pre_val'];?>" >
                                <input type="hidden" id="traID<?php echo $CatId.$cont;?>" value="<?php echo $rowtra['tra_id'];?>" >
                                <?php
								
								$tra_rea_fec = date('Y-m-d');
								$sqltraXrea = sprintf("SELECT * FROM detalle_tratamientosxrealizar WHERE tra_id = '".$rowtra['tra_id']."' and per_id = '".$per_id."' and tra_rea_fec='".$tra_rea_fec."'");
								$querytraXrea = mysql_query($sqltraXrea, $conexion_mysql) or die(mysql_error());
								$rowtraXrea = mysql_fetch_assoc($querytraXrea);
								
								?>
								<td style="text-align:center">
                                <input type="number" id="val_ingre<?php echo $CatId.$cont;?>" onChange="totalprod(<?php echo $CatId;?>,<?php echo $cont;?>)"  min="0" placeholder="Ingrese el número" value="<?php echo $rowtraXrea['det_tra_rea_cantidad'];?>"></td>
                                <td style="text-align:center" >
                                <input type="number" disabled style=" text-align:center; color:#03C; font-family:'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; font-size:16px; font-style:normal" id="resp_val<?php echo $CatId.$cont;?>"   ></td>
                            </tr>
							<?php
							} while ($rowtra = mysql_fetch_assoc($querytra));
							?>
                               	</tbody>
                            </table>
                            <input type="hidden" id="Tot_tra<?php echo $CatId;?>" value="<?php echo $tot_rowstra;?>" >
                            <?php
							// mysql_free_result($querytra);?>
                            <div class="row-fluid" align="center">
                            <div class="span6">
                           
                            </div>
                            <div class="span6">
                            </div>
                            </div>
                            </div>
							<?php
							?><div class="span2">
							</div>
                        </form>
                            <?php
						} 
                        else
						{
							 echo '<div class="alert "><h4>NO EXISTEN TRATAMIENTOS EN ESTA CATEGORÍA</h4></div>';
							} 
						?></div><?php 	
						?>                        
                        <!-------  Fin Cuerpo -------->
                       </div> 
                        <?php
                        } while ($row2 = mysql_fetch_assoc($query2)); 
                      ?>
					
            <div  >
</div>
        </div>     <!------     Fin de Contenedor      ------->
        
    <br>
    <hr>        
<!--- FIN DE RESULTADOS--->
<div  id="conten" name="conten">
<div class="row-fluid" align="center">
     <div class="span6">
     <br>
     <div>
     
    <?php include "hc_cotizarModal.php";     ?>
    <?php include "hc_facturarModal.php";     ?>
     </div>
    </div>
     <div class="span6" align="center">
      	<div class="span3">
        <strong style="font-size:20px; color:#009"><em>Subtotal: $</em></strong>
		</div>
		<div class="span3">
        
        <input type="number" name="total" id="total" value="Total" disabled style=" text-align:center; color:#003; font-family:'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; font-size:16px; font-style:normal; text-shadow:#003; font-weight:bold">
    	</div>
	</div>
</div>    
<div class="row-fluid" align="center">
     <div class="span6">
	</div>
     <div class="span6" align="center">
      	<div class="span3">
        <strong style="font-size:20px; color:#009"><em>IVA:   $</em></strong>
		</div>
		<div class="span3">
        
        <input type="number" name="iva" id="iva" value="iva" disabled style=" text-align:center; color:#003; font-family:'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; font-size:16px; font-style:normal; text-shadow:#003; font-weight:bold">
    	</div>
	</div>
</div>    
<div class="row-fluid" align="center">
     <div class="span6">
	</div>
     <div class="span6" align="center">
      	<div class="span3">
        <strong style="font-size:20px; color:#009"><em>TOTAL: $</em></strong>
		</div>
		<div class="span3">
        <input type="number" name="GranTotal" id="GranTotal" value="GranTotal" disabled style=" text-align:center; color:#03C; font-family:'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; font-size:16px; font-style:normal; text-shadow:#003; font-weight:bold">
    	</div>
	</div>
    
</div>    
<!--- FIN DE RESULTADOS--->                            
</div>                            
                            
 <input type="hidden" id="url_func_tra" value="<?php echo $RUTAm."historia_clinica/funciones/tratamientos-fncs.php"; ?>">                           
	</div>
</div>  

