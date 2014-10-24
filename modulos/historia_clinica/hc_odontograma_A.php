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
function test()
{
	alert('correcto');
}
function evolucionar(Sec, die_id)
{
    var url_cap = $("#Url").val();
    var per_id = $("#per_id").val();

    if(Sec==1)
    {
        var	det_die_per_fec_pen = $("#TratamientosPendientes1"+die_id).val();
        var	det_die_per_des_rea = $("#Realizado1"+die_id).val();
        var	id = $("#ID1"+die_id).val();
    }
    if(Sec==2)
	{
        var det_die_per_fec_pen = $("#TratamientosPendientes2"+die_id).val();
        var det_die_per_des_rea = $("#Realizado2"+die_id).val();
        var id = $("#ID2"+die_id).val();
    }



	var det_die_per_des_rea2 = det_die_per_des_rea+" |::| "+det_die_per_fec_pen;
	det_die_per_fec_pen = "";
    var det_die_per_fec_act = $("#Fecha").val();
    var accion ="Evolucionar";

var parametros = "det_die_per_fec_act="+det_die_per_fec_act+"&det_die_per_fec_pen="+det_die_per_fec_pen+"&det_die_per_des_rea="+det_die_per_des_rea2+"&id="+id+"&accion="+accion;	


		$.ajax({
			type: "POST",
			url: url_cap,
			data: parametros,
			success : function (resultado) { 
                            alert("Paciente Evolucionado");       //muestra el resultado en la alerta
                if(Sec==1)
                {
                    	$("#TratamientosPendientes1"+die_id).val(" ");
                    	$("#Realizado1"+die_id).val(det_die_per_des_rea2);

                }
                if(Sec==2)
                {
                        $("#TratamientosPendientes2"+die_id).val("");
                        $("#Realizado2"+die_id).val(det_die_per_des_rea2);

                }
                buscar_existencia(die_id);
                       }
    });

};
function ActualizarDatos(Sec,die_id){
	per_id = $("#per_id").val();
	det_die_per_fec_act = $("#Fecha").val();
	det_die_per_fec_reg1 = $("#Fecha").val();
	url_cap = $("#Url").val();

(Sec==1)
{
	det_die_per_fec_ini = $("#IngresaAtencion1"+die_id).val();
	det_die_per_fec_pen = $("#TratamientosPendientes1"+die_id).val();
	det_die_per_des_rea = $("#Realizado1"+die_id).val();
	exdie_id = $("#exdie_id"+die_id).val();
    id = $("#ID1"+die_id).val();
}
if(Sec==2)
{
	det_die_per_fec_ini = $("#IngresaAtencion2"+die_id).val();
	det_die_per_fec_pen = $("#TratamientosPendientes2"+die_id).val();
	det_die_per_des_rea = $("#Realizado2"+die_id).val();
    exdie_id = $("#exdie_id2"+die_id).val();
    id = $("#ID2"+die_id).val();

}
    if (exdie_id!=""){
        accion ="Actualizar";
    }else {
        accion ="Insertar";
    }
var parametros = "per_id="+per_id+"&die_id="+die_id+"&det_die_per_fec_act="+det_die_per_fec_act+"&det_die_per_fec_reg1="+det_die_per_fec_reg1+"&det_die_per_fec_ini="+det_die_per_fec_ini+"&det_die_per_fec_pen="+det_die_per_fec_pen+"&det_die_per_des_rea="+det_die_per_des_rea+"&accion="+accion+"&id="+id;
		//alert(det_die_per_fec_ini+" "+det_die_per_fec_pen+" "+det_die_per_des_rea+" "+Sec);

		$.ajax({
			type: "POST",
			url: url_cap,
			data: parametros,
			success : function (resultado) { 
                            alert("Cambios Realizados ");       //muestra el resultado en la alerta
                      buscar_existencia(die_id);
					   }
    });

   //alert(resultado);      //no muestra nada !!!
   $("#resultado"+die_id).val(resultado);

}
function conf_existencia(Sec)
{(Sec==1)
{
	det_die_per_fec_pen = $("#TratamientosPendientes1"+die_id).val();
	
}
if(Sec==2)
{
	det_die_per_fec_pen = $("#TratamientosPendientes2"+die_id).val();

}
alert("presiono")
if(det_die_per_fec_pen == " ")
{
	$("#ev1").attr("enable");
	}
	}
function buscar_existencia(die_id)
{
	per_id = $("#per_id").val();
	var parametros = "per_id="+per_id+"&die_id="+die_id;
	url_exi = $("#Url2").val();		
			$.ajax({
			type: "POST",
			url: url_exi,
			data: parametros,
			success : function (datos) { 
                           //alert(datos['det_die_per_id']);       //muestra el resultado en la alerta
						$("#exi"+die_id).attr('class','badge badge-success');
						   
						   
                       }
    });
	
	}
</script>
<?php
	$sqldientS = sprintf("select *from dientes where die_sec= 'S' and die_des_per ='A' order by die_ord asc;");
	$querydientS = mysql_query($sqldientS, $conexion_mysql) or die(mysql_error());
	$rowdientS = mysql_fetch_assoc($querydientS);
	$tot_rowsdientS = mysql_num_rows($querydientS);
	
	$sqldientI = sprintf("select *from dientes where die_sec= 'I' and die_des_per ='A' order by die_ord asc;");
	$querydientI = mysql_query($sqldientI, $conexion_mysql) or die(mysql_error());
	$rowdientI = mysql_fetch_assoc($querydientI);
	$tot_rowsdientI = mysql_num_rows($querydientI);
	
?>
<div >
  <div class="row-fluid" align="center">

  <table cellspacing="2">
  <tr>
    <?php 
        do {?>
    <?php    	$sqldienper = sprintf("SELECT * FROM detalle_die_per inner join persona on persona.per_id=detalle_die_per.per_id where die_id=". $rowdientS["die_id"]." and detalle_die_per.per_id=".$per_id);
	$querydienper = mysql_query($sqldienper, $conexion_mysql) or die(mysql_error());
	$rowdienper = mysql_fetch_assoc($querydienper);
	$tot_rowsdienper= mysql_num_rows($querydienper);
   ?>
			<!--Inicio  Modal -->
		<div id="Modal_<?php echo $rowdientS["die_id"] ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h4 id="myModalLabel1">DETALLE DE PIEZA DENTAL "Adultos"</h4>
		  </div>
  
		  <div class="modal-body">
				<div class="row-fluid" align="center">  
					<div class="span3">
						<img src="<?php echo $RUTAi."dientes-odontograma/".$rowdientS["die_nom"] ?>"  style="width:40px" data-toggle="tooltip" style="color:#000" data-placement="right" title="<?php echo $rowdienper["det_die_per_des_pen"];?>" >
                         
					</div>
					<div class="span6">
						<div>
                        <strong><a style="color:#FF4A4A">Realizado</a></strong>
                        <textarea rows="4" style="background:#FF8282; color:#000; font-weight:bold" disabled id="Realizado1<?php echo $rowdientS["die_id"];?>"><?php echo $rowdienper["det_die_per_des_rea"];?></textarea>
                        </div>
                        <div>
                        <strong><a style="color:#999">Tratamientos Pendientes</a></strong>
                        <textarea rows="4"  style="background:#999; color:#FFF; font-weight:bold" id="TratamientosPendientes1<?php echo $rowdientS["die_id"];?>"><?php echo $rowdienper["det_die_per_des_pen"];?></textarea>
                        </div>
                        <div>
                        <strong><a style="color:#09F">Presenta Tratamiento/s</a></strong>
                       
                        <textarea rows="4" style="background:#09F; color:#FFF; font-weight:bold" id="IngresaAtencion1<?php echo $rowdientS["die_id"];?>" ><?php echo $rowdienper["det_die_per_des_ini"];?></textarea>
                        </div>
					</div>
                    <div class="span3">
        			<br>
                    <br>
                   
                    <button class="btn btn-primary"  id="ev1" onClick="evolucionar(1, <?php echo $rowdientS["die_id"] ?>)">Evolucionar</button>
                    <input type="hidden" id="<?php echo "exdie_id".$rowdientS["die_id"];?>" value="<?php echo $rowdienper ['die_id']; ?>">
                    <input type="hidden" id="<?php echo "ID1".$rowdientS["die_id"];?>" value="<?php echo $rowdienper ['det_die_per_id']; ?>">
        			</div>
				</div>	
		  </div>
	
	  
          <?php 	fnc_msgGritter(); ?>
            <span id="resultado<?php echo $rowdientS["die_id"];?>" name"resultado<?php echo $rowdientS["die_id"];?>"></span>
		  <div class="modal-footer">
			<button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
			<button class="btn btn-primary" onClick="ActualizarDatos(<?php echo $Sec=1; ?>,<?php echo $rowdientS["die_id"];?>)">Aplicar Cambios</button>
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
                
                <span class="badge badge-info" id="exi<?php echo $rowdientS["die_id"];?>"><?php echo $est1; ?></span>
                </div>
             <div>
                <img href="#Modal_<?php echo $rowdientS["die_id"] ?>" role="button" class="btn" data-toggle="modal" src="<?php echo $RUTAi."dientes-odontograma/".$rowdientS["die_nom"] ?>"  style="width:40px" data-toggle="tooltip" style="color:#000; background:#F00" data-placement="right" title="<?php echo "Tratamiento pendiente: ".$rowdienper["det_die_per_des_pen"];?>">
                </div>
                

      </td>
    <?php
        } while ($rowdientS = mysql_fetch_assoc($querydientS));
    ?>
    </tr>
    </table>
    </div>
    <div class="row">
  	<div class="span6 offset3">
    <hr>
    		<br>
            <?php include "hc_odontograma_N.php";     ?>
    		<br>
    <hr>
    </div>
	</div>
    <div class="row-fluid" align="center">
        <table cellspacing="2">
  
   <tr>

	<?php 
        do {
        	$sqldienper2 = sprintf("SELECT * FROM detalle_die_per inner join persona on persona.per_id=detalle_die_per.per_id where die_id=". $rowdientI["die_id"]." and detalle_die_per.per_id=".$per_id);
        	$querydienper2 = mysql_query($sqldienper2, $conexion_mysql) or die(mysql_error());
	        $rowdienper2 = mysql_fetch_assoc($querydienper2);
	        ?>

    <!--Inicio  Modal -->
		<div id="Modal_<?php echo $rowdientI["die_id"] ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h4 id="myModalLabel2">DETALLE DE PIEZA DENTAL "Adultos"</h4>
		  </div>
		  <div class="modal-body">
				<div class="row-fluid" align="center">  
					<div class="span3">
						<img src="<?php echo $RUTAi."dientes-odontograma/".$rowdientI["die_nom"] ?>"  style="width:40px" data-toggle="tooltip" style="color:#000" data-placement="right" title="<?php echo $rowdienper2["det_die_per_des_pen"]; ?>" >
					</div>
                    <div class="span6">
                        <div>
                            <strong><a style="color:#FF4A4A">Realizado</a></strong>
                            <textarea rows="4" style="background:#FF8282; color:#000; font-weight:bold" id="Realizado2<?php echo $rowdientI["die_id"];?>" disabled><?php echo $rowdienper2["det_die_per_des_rea"];?></textarea>
                        </div>
                        <div>
                            <strong><a style="color:#999">Tratamientos Pendientes</a></strong>
                            <textarea rows="4" style="background:#999; color:#FFF; font-weight:bold" id="TratamientosPendientes2<?php echo $rowdientI["die_id"];?>"><?php echo $rowdienper2["det_die_per_des_pen"];?></textarea>
                        </div>
                        <div>
                            <strong><a style="color:#09F">Presenta Tratamiento/s</a></strong>

                            <textarea rows="4" style="background:#09F; color:#FFF; font-weight:bold" id="IngresaAtencion2<?php echo $rowdientI["die_id"];?>" ><?php echo $rowdienper2["det_die_per_des_ini"];?></textarea>
                        </div>
                    </div>
                    <div class="span3">
        			<br>
                    <br>
                    <button class="btn btn-primary" onClick="evolucionar(2, <?php echo $rowdientI["die_id"];?>)" >Evolucionar</button>
        			</div>
				</div>
		  </div>
          <?php 	fnc_msgGritter(); ?>
		  <span id="resultado<?php echo $rowdientI["die_id"];?>" name"resultado<?php echo $rowdientI["die_id"];?>"></span>
		  <div class="modal-footer">
			<button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
			<button class="btn btn-primary" onClick="ActualizarDatos(<?php echo $Sec=2; ?>,<?php echo $rowdientI["die_id"];?>)">Aplicar Cambios</button>
              <input type="hidden" id="<?php echo "exdie_id2".$rowdientI["die_id"];?>" value="<?php echo $rowdienper2 ['die_id']; ?>">
              <input type="hidden" id="<?php echo "ID2".$rowdientI["die_id"];?>" value="<?php echo $rowdienper2 ['det_die_per_id']; ?>">
		  </div>
		</div>
				<!--FIN  Modal -->
<td>
<div>
    <img href="#Modal_<?php echo $rowdientI["die_id"] ?>" role="button" class="btn" data-toggle="modal" src="<?php echo $RUTAi."dientes-odontograma/".$rowdientI["die_nom"] ?>"  style="width:40px" data-toggle="tooltip" style="color:#000" data-placement="right" title="<?php echo "Tratamiento pendiente: ".$rowdienper2["det_die_per_des_pen"];?>" >
</div>
<div align="center">
<?php $existencia = $rowdienper2["det_die_per_des_pen"];
if($existencia=="")
{ $est="NO";
	}else {
		$est="<i class='icon-remove'></i>";
		}

?>
<span class="badge badge-info" id="exi<?php echo $rowdientI["die_id"];?>"><?php echo $est; ?></span>
</div>
 </td>
  
    <?php
        } while ($rowdientI = mysql_fetch_assoc($querydientI));
		
    ?>
    </tr>
    </table>
    </div>
		

<input type="hidden" id="Url" value="<?php echo $RUTAm."historia_clinica/funciones/odontograma-fncs.php"; ?>">
<input type="hidden" id="Url2" value="<?php echo $RUTAm."historia_clinica/funciones/bus-odon-items.php"; ?>">
<input type="hidden" id="Url3" value="<?php echo $RUTAm."historia_clinica/funciones/bus-tra-items.php"; ?>">
		
<input type="hidden" id="per_id" value="<?php echo $per_id;?>">		
<input type="hidden" id="Fecha" value="<?php echo date("Y-m-d"); ?>">






</div>