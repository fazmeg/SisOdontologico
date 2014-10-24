
<script  type="text/javascript">
	function facturar(tra_rea_fec,per_id){
	$("#contFormatFacturar").load("Facturar.php?tra_rea_fec="+tra_rea_fec+"&per_id="+per_id);
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
<div id="ModalFacturar" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" width="800px" >
    <div class="modal-header" >
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 id="myModalLabel">Facturar Tratamientos de <?php echo $datpac['per_nombre']; ?></h4>
    </div>
          <div class="modal-body">
            <?php 	$tra_rea_fec = date('Y-m-d');?>	
            <input >
					
            <div>
              
            </div>
                    	
			    <div class="control-group well" >
                     <h4 style="color:#036"> <i class="icon-file"></i> Tratamientos a Facturar</h4>
                     <div class="control-group well" id="contFormatFacturar">
                     </div>

					 
                 </div>
                 
  </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
     		<!--	<button class="btn " onClick="ImprimirC('<?php echo $tra_rea_fec; ?>','<?php echo $per_id; ?>')" >Imprimir Factura</button> -->
            </div>

</div>
     
     
     
      <a href="#ModalFacturar" role="button" class="btn btn-primary" data-toggle="modal" onClick="facturar('<?php echo $tra_rea_fec; ?>','<?php echo $per_id; ?>')"> <i class="icon-file"></i>  Facturar Tratamientos </a>
      <input type="hidden" id="urlCot" value="<?php echo $RUTAm."historia_clinica/cotizacion_PDF.php"; ?>">
