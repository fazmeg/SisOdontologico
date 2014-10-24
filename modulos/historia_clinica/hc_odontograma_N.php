<script>
//$('#ima').tooltip('hide');
//$ ( '# ven_diente' ). modal ( 'show' )
</script>
<script type="text/javascript">
function ajax(){
	var ajax;
	if(window.XMLHttpRequest)
	{
		ajax=new XMLHttpRequest();
	}else{
		ajax=ActiveXObject("Microsoft.XMLHTTP")
		}
	}

function evolucionarN(Sec, die_id)
{
    var url_cap = $("#Url").val();
    var per_id = $("#per_id").val();

    if(Sec==1)
    {
        var	det_die_per_des_penN = $("#TratamientosPendientes1N"+die_id).val();
        var	det_die_per_des_reaN = $("#Realizado1N"+die_id).val();
        var	id = $("#ID1"+die_id).val();
    }
    if(Sec==2)
	{
        var det_die_per_des_penN = $("#TratamientosPendientes2N"+die_id).val();
        var det_die_per_des_reaN = $("#Realizado2N"+die_id).val();
        var id = $("#ID2"+die_id).val();
    }

	var det_die_per_des_rea2N = det_die_per_des_reaN+" |::| "+det_die_per_des_penN;
	det_die_per_des_penN = "";
    var det_die_per_fec_actN = $("#Fecha").val();
    var accion ="Evolucionar";

var parametrosN = "det_die_per_fec_act="+det_die_per_fec_actN+"&det_die_per_fec_pen="+det_die_per_des_penN+"&det_die_per_des_rea="+det_die_per_des_rea2N+"&id="+id+"&accion="+accion;	

		$.ajax({
			type: "POST",
			url: url_cap,
			data: parametrosN,
			success : function (resultado) { 
                            alert("Paciente Evolucionado");       //muestra el resultado en la alerta
                if(Sec==1)
                {
                    	$("#TratamientosPendientes1N"+die_id).val(" ");
                    	$("#Realizado1N"+die_id).val(det_die_per_des_rea2N);

                }
                if(Sec==2)
                {
                        $("#TratamientosPendientes2"+die_id).val("");
                        $("#Realizado2"+die_id).val(det_die_per_des_rea2N);

                }
                buscar_existenciaN(die_id);
                       }
    });


}
function ActualizarDatosN(Sec,die_id){
	per_id = $("#per_id").val();
	det_die_per_fec_actN = $("#Fecha").val();
	det_die_per_fec_reg1N = $("#Fecha").val();
	url_cap = $("#Url").val();

(Sec==1)
{
	det_die_per_fec_ini = $("#IngresaAtencion1"+die_id).val();
	det_die_per_des_penN = $("#TratamientosPendientes1N"+die_id).val();
	det_die_per_des_reaN = $("#Realizado1N"+die_id).val();
	exdie_id = $("#exdie_id"+die_id).val();
    id = $("#ID1"+die_id).val();
}
if(Sec==2)
{
	det_die_per_fec_ini = $("#IngresaAtencion2"+die_id).val();
	det_die_per_des_penN = $("#TratamientosPendientes2"+die_id).val();
	det_die_per_des_reaN = $("#Realizado2"+die_id).val();
    exdie_id = $("#exdie_id2"+die_id).val();
    id = $("#ID2"+die_id).val();

}
    if (exdie_id!=""){
        accion ="Actualizar";
    }else {
        accion ="Insertar";
    }
var parametrosN = "per_id="+per_id+"&die_id="+die_id+"&det_die_per_fec_act="+det_die_per_fec_actN+"&det_die_per_fec_reg1="+det_die_per_fec_reg1N+"&det_die_per_fec_ini="+det_die_per_fec_ini+"&det_die_per_fec_pen="+det_die_per_des_penN+"&det_die_per_des_rea="+det_die_per_des_reaN+"&accion="+accion+"&id="+id;
		//alert(det_die_per_fec_ini+" "+det_die_per_des_penN+" "+det_die_per_des_reaN+" "+Sec);

		$.ajax({
			type: "POST",
			url: url_cap,
			data: parametrosN,
			success : function (resultado) { 
                            alert("Cambios Realizados ");       //muestra el resultado en la alerta
                      buscar_existenciaN(die_id);
					   }
    });

   //alert(resultado);      //no muestra nada !!!
   $("#resultado"+die_id).val(resultado);

}
function buscar_existenciaN(die_id)
{
	per_id = $("#per_id").val();
	var parametrosN = "per_id="+per_id+"&die_id="+die_id;
	url_exi = $("#Url2").val();		
			$.ajax({
			type: "POST",
			url: url_exi,
			data: parametrosN,
			success : function (datos) { 
                           //alert(datos['det_die_per_id']);       //muestra el resultado en la alerta
						$("#exi"+die_id).attr('class','badge badge-success');
                       }
    			});
	}
</script>
<?php
	$sqldientSN = sprintf("select *from dientes where die_sec= 'S' and die_des_per ='N' order by die_ord asc;");
	$querydientSN = mysql_query($sqldientSN, $conexion_mysql) or die(mysql_error());
	$rowdientSN = mysql_fetch_assoc($querydientSN);
	$tot_rowsdientSN = mysql_num_rows($querydientSN);
	
	$sqldientIN = sprintf("select *from dientes where die_sec= 'I' and die_des_per ='N' order by die_ord asc;");
	$querydientIN = mysql_query($sqldientIN, $conexion_mysql) or die(mysql_error());
	$rowdientIN = mysql_fetch_assoc($querydientIN);
	$tot_rowsdientIN = mysql_num_rows($querydientIN);
	
?>
<div>
  <div class="row-fluid" align="center">
  <table cellspacing="2">
  <tr>
    <?php 
        do {?>
    <?php    	$sqldienper = sprintf("SELECT * FROM detalle_die_per inner join persona on persona.per_id=detalle_die_per.per_id where die_id=". $rowdientSN["die_id"]." and detalle_die_per.per_id=".$per_id);
	$querydienper = mysql_query($sqldienper, $conexion_mysql) or die(mysql_error());
	$rowdienper = mysql_fetch_assoc($querydienper);
	$tot_rowsdienper= mysql_num_rows($querydienper);
   ?>
			<!--Inicio  Modal -->
		<div id="Modal_<?php echo $rowdientSN["die_id"] ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h4 id="myModalLabel1">DETALLE DE PIEZA DENTAL "Niños"</h4>
		  </div>
  
		  <div class="modal-body">
				<div class="row-fluid" align="center">  
					<div class="span3">
						<img src="<?php echo $RUTAi."dientes-odontograma/".$rowdientSN["die_nom"] ?>"  style="width:40px" data-toggle="tooltip" style="color:#000" data-placement="right" title="<?php echo $rowdienper["det_die_per_des_pen"];?>" >
                         
					</div>
					<div class="span6">
						<div>
                        <strong><a style="color:#FF4A4A">Realizado</a></strong>
                        <textarea rows="4" style="background:#FF8282; color:#000; font-weight:bold" disabled id="Realizado1N<?php echo $rowdientSN["die_id"];?>"><?php echo $rowdienper["det_die_per_des_rea"];?></textarea>
                        </div>
                        <div>
                        <strong><a style="color:#999">Tratamientos Pendientes</a></strong>
                        <textarea rows="4" style="background:#999; color:#FFF; font-weight:bold" id="TratamientosPendientes1N<?php echo $rowdientSN["die_id"];?>"><?php echo $rowdienper["det_die_per_des_pen"];?></textarea>
                        </div>
                        <div>
                        <strong><a style="color:#09F">Presenta Tratamiento/s</a></strong>
                       
                        <textarea rows="4" style="background:#09F; color:#FFF; font-weight:bold" id="IngresaAtencion1<?php echo $rowdientSN["die_id"];?>" ><?php echo $rowdienper["det_die_per_des_ini"];?></textarea>
                        </div>
					</div>
                    <div class="span3">
        			<br>
                    <br>
                   
                    <button class="btn btn-primary" onClick="evolucionarN(1, <?php echo $rowdientSN["die_id"] ?>)">Evolucionar</button>
                    <input type="hidden" id="<?php echo "exdie_id".$rowdientSN["die_id"];?>" value="<?php echo $rowdienper ['die_id']; ?>">
                    <input type="hidden" id="<?php echo "ID1".$rowdientSN["die_id"];?>" value="<?php echo $rowdienper ['det_die_per_id']; ?>">
        			</div>
				</div>	
		  </div>
          <?php 	fnc_msgGritter(); ?>
            <span id="resultado<?php echo $rowdientSN["die_id"];?>" name"resultado<?php echo $rowdientSN["die_id"];?>"></span>
		  <div class="modal-footer">
			<button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
			<button class="btn btn-primary" onClick="ActualizarDatosN(<?php echo $Sec=1; ?>,<?php echo $rowdientSN["die_id"];?>)">Aplicar Cambios</button>
		  </div>
		</div>
        
				<!--FIN  Modal -->

             <td>
             <div align="center">
				<?php $existencia1 = $rowdienper["det_die_per_des_pen"];
                if($existencia1=="")
                { $est1="NO";
                    }else {
                        $est1="<i class='icon-remove'></i>";
                        }
                
                ?>
                
                <span class="badge badge-info" id="exi<?php echo $rowdientSN["die_id"];?>"><?php echo $est1; ?></span>
                </div>
             <div>
                <img href="#Modal_<?php echo $rowdientSN["die_id"] ?>" role="button" class="btn" data-toggle="modal" src="<?php echo $RUTAi."dientes-odontograma/".$rowdientSN["die_nom"] ?>"  style="width:40px" data-toggle="tooltip" style="color:#000; background:#F00" data-placement="right" title="<?php echo "Tratamiento pendiente: ".$rowdienper["det_die_per_des_pen"];?>">
                </div>
                

      </td>
    <?php
        } while ($rowdientSN = mysql_fetch_assoc($querydientSN));
    ?>
    </tr>
    </table>
    </div>
    <div class="row">
  	<div class="span6 offset3"><hr></div>
	</div>
    <div class="row-fluid" align="center">
        <table cellspacing="2">
  <tr>
    
	<?php 
        do {
        	$sqldienper2 = sprintf("SELECT * FROM detalle_die_per inner join persona on persona.per_id=detalle_die_per.per_id where die_id=". $rowdientIN["die_id"]." and detalle_die_per.per_id=".$per_id);
        	$querydienper2 = mysql_query($sqldienper2, $conexion_mysql) or die(mysql_error());
	        $rowdienper2 = mysql_fetch_assoc($querydienper2);
	        ?>

    <!--Inicio  Modal -->
		<div id="Modal_<?php echo $rowdientIN["die_id"] ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h4 id="myModalLabel2">DETALLE DE PIEZA DENTAL "Niños"</h4>
		  </div>
		  <div class="modal-body">
				<div class="row-fluid" align="center">  
					<div class="span3">
						<img src="<?php echo $RUTAi."dientes-odontograma/".$rowdientIN["die_nom"] ?>"  style="width:40px" data-toggle="tooltip" style="color:#000" data-placement="right" title="<?php echo $rowdienper2["det_die_per_des_pen"]; ?>" >
					</div>
                    <div class="span6">
                        <div>
                            <strong><a style="color:#FF4A4A">Realizado</a></strong>
                            <textarea rows="4" style="background:#FF8282; color:#000; font-weight:bold" id="Realizado2<?php echo $rowdientIN["die_id"];?>" disabled><?php echo $rowdienper2["det_die_per_des_rea"];?></textarea>
                        </div>
                        <div>
                            <strong><a style="color:#999">Tratamientos Pendientes</a></strong>
                            <textarea rows="4" style="background:#999; color:#FFF; font-weight:bold" id="TratamientosPendientes2<?php echo $rowdientIN["die_id"];?>"><?php echo $rowdienper2["det_die_per_des_pen"];?></textarea>
                        </div>
                        <div>
                            <strong><a style="color:#09F">Presenta Tratamiento/s</a></strong>

                            <textarea rows="4" style="background:#09F; color:#FFF; font-weight:bold" id="IngresaAtencion2<?php echo $rowdientIN["die_id"];?>" ><?php echo $rowdienper2["det_die_per_des_ini"];?></textarea>
                        </div>
                    </div>
                    <div class="span3">
        			<br>
                    <br>
                    <button class="btn btn-primary" onClick="evolucionarN(2, <?php echo $rowdientIN["die_id"];?>)" >Evolucionar</button>
        			</div>
				</div>
		  </div>
          <?php 	fnc_msgGritter(); ?>
		  <span id="resultado<?php echo $rowdientIN["die_id"];?>" name"resultado<?php echo $rowdientIN["die_id"];?>"></span>
		  <div class="modal-footer">
			<button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
			<button class="btn btn-primary" onClick="ActualizarDatosN(<?php echo $Sec=2; ?>,<?php echo $rowdientIN["die_id"];?>)">Aplicar Cambios</button>
              <input type="hidden" id="<?php echo "exdie_id2".$rowdientIN["die_id"];?>" value="<?php echo $rowdienper2 ['die_id']; ?>">
              <input type="hidden" id="<?php echo "ID2".$rowdientIN["die_id"];?>" value="<?php echo $rowdienper2 ['det_die_per_id']; ?>">
		  </div>
		</div>
				<!--FIN  Modal -->
<td>
<div>
    <img href="#Modal_<?php echo $rowdientIN["die_id"] ?>" role="button" class="btn" data-toggle="modal" src="<?php echo $RUTAi."dientes-odontograma/".$rowdientIN["die_nom"] ?>"  style="width:40px" data-toggle="tooltip" style="color:#000" data-placement="right" title="<?php echo "Tratamiento pendiente: ".$rowdienper2["det_die_per_des_pen"];?>" >
</div>
<div align="center">
<?php $existencia = $rowdienper2["det_die_per_des_pen"];
if($existencia=="")
{ $est="NO";
	}else {
		$est="<i class='icon-remove'></i>";
		}

?>
<span class="badge badge-info" id="exi<?php echo $rowdientIN["die_id"];?>"><?php echo $est; ?></span>
</div>
 </td>
  
    <?php
        } while ($rowdientIN = mysql_fetch_assoc($querydientIN));
		
    ?>
    </tr>
    </table>
    </div>
</div>