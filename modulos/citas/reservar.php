<?php 
	if (!isset($_SESSION)) session_start();
	include("../../start.php");
	fnc_autentificacion();
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Reservar</title>
    <?php include(RUTAp.'jquery/styl-jquery.php'); ?>
    <?php include(RUTAs.'styles/styl-bootstrap.php'); ?>
</head>    
<body>
	<?php include(RUTAcom.'menu-principal.php'); ?>
    
    <div class="row-fluid">
        <div class="span2"></div>
        <div class="span3">
        <?php include(RUTAcom.'menu-reservar.php'); ?>
        </div>
        <div class="span4" class="contenedor_cuerpo" align="center">
        <br />
        <h3> Reservar Cita Medica</h3>
        <br />
    
        <div><input type="date" /></div>
        <div>
            <p align="center">
                 <label>Seleccione hora</label>
                 <select id = "Listahoras">
                   <option value = "1">8:00</option>
                   <option value = "2">8:30</option>
                   <option value = "3">9:00</option>
                   <option value = "4">9:30</option>
                   <option value = "5">10:00</option>
                   <option value = "6">10:30</option>
                   <option value = "7">11:00</option>
                   <option value = "8">11:30</option>
                   <option value = "9">12:00</option>
                   <option value = "10">12:30</option>
                   <option value = "11">15:00</option>
                   <option value = "12">15:30</option>
                   <option value = "13">16:00</option>
                   <option value = "14">16:30</option>
                   <option value = "15">17:00</option>
                   <option value = "16">17:30</option>
                   <option value = "17">18:00</option>
                   <option value = "18">18:30</option>
                   <option value = "19">19:00</option>
                   <option value = "20">19:30</option>
                   <option value = "21">20:00</option>
                   <option value = "22">20:30</option>
                 </select>
              </p>
        </div>
        <div>
        <form>
           <fieldset>
              <legend>Tratamientos Frecuentes</legend>
              <p>
                 <label>Seleccione Tratamiento</label>
                 <select id = "ListaProblema">
                   <option value = "1">CONTROL</option>
                   <option value = "2">LIMPIEZA</option>
                   <option value = "3">CARIES</option>
                   <option value = "4">ENDODONCIA</option>
                   <option value = "5">TRATAMIENTO DE CONDUCTO</option>
                   <option value = "6">COLOCAR BRACKETS</option>
                   <option value = "7">RETIRAR BRACKETS</option>
                   
                 </select>
              </p>
           </fieldset>
        </form>
        </div>
        <h5>Codigo de Usuario</h5>
        <input type="text" />
        <br />
        <input  class="btn" type="submit" title="GRABAR" value="GRABAR" />
    </div>
  </div>  
</body>
</html>