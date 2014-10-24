<!doctype html>
<html> 
<head> 
    <title>Reloj con Javascript</title> 
    <script language="JavaScript"> 
		function mueveReloj(){ 
			momentoActual = new Date() 
			hora = momentoActual.getHours() 
			minuto = momentoActual.getMinutes() 
			segundo = momentoActual.getSeconds() 
		
			horaImprimible = hora + " : " + minuto + " : " + segundo 
		
			document.form_reloj.reloj.value = horaImprimible 
		
			setTimeout("mueveReloj()",1000) 
		} 
	</script> 
</head> 
<body onload="mueveReloj()">	
    <h5 style="color:#03F">Hora</h5> 
    <form name="form_reloj"> 
    	<input  class="btn" type="button" name="reloj" size="50" style="border:#FFF" style="color:#00C" > 
    </form>
</body> 
</html> 
