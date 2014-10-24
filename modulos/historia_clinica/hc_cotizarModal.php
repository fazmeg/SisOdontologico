
<script  type="text/javascript">
	function cotizar(tra_rea_fec,per_id){
	$("#contFormatCotizar").load("Cotizar.php?tra_rea_fec="+tra_rea_fec+"&per_id="+per_id);
	}
	function ImprimirC(fecha,per_id)
	{
      
		urlCot=$("#urlCot").val();
		var tra_rea = "per_id="+per_id+"&fecha="+fecha;
        $.ajax({
			type: "POST",
			url: urlCot,
			data: tra_rea,
			success : function (resultado) { 
                            //alert("Paciente Evolucionado"); 
							 	} 
							});
			  //
			  
			window.open( "cotizacion_PDF.php?id="+per_id , "Cotización de Tratamientos" , "width=800 , height = 600");
		}
</script> 
<div id="ModalCotizar" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header" >
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 id="myModalLabel">Cotización de Tratamientos de <?php echo $datpac['per_nombre']; ?></h4>
    </div>
          <div class="modal-body">
            <?php 	$tra_rea_fec = date('Y-m-d');?>	
					<button id="btn_cotizar" class="btn btn-success" onClick="cotizar('<?php echo $tra_rea_fec; ?>','<?php echo $per_id; ?>')"><i class="icon-pencil"></i> Generar Cotización</button>
					<br>
                    <div>
                    <hr>
                    </div>
                    	
			    <div class="control-group well" id="contFormatCotizar">
                     <h5 style="color:#036"> <i class="icon-file"></i> Generé Cotización</h5>
                 </div>
          </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
     			<button class="btn " onClick="ImprimirC('<?php echo $tra_rea_fec; ?>','<?php echo $per_id; ?>')" >Imprimir Cotización</button>
            </div>

</div>
     
     
     
      <a href="#ModalCotizar" role="button" class="btn btn-primary" data-toggle="modal"> <i class="icon-align-left"></i>  Cotizar  Tratamientos </a>
      <input type="hidden" id="urlCot" value="<?php echo $RUTAm."historia_clinica/cotizacion_PDF.php"; ?>">
