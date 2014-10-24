<?php 
	
	include('start.php');
?>
<script>
function conf_existencia(Sec)
{
	alert("Presionado "+Sec);
	var val = $("#ev1").attr("btn btn-primary");

	}
</script>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>test</title>
</head>

<body>
<button class="btn btn-primary" onKeyPress="conf_existencia(1)" disabled id="ev1" name="ev1">Evolucionar</button>
 <textarea rows="4"  id="1"></textarea>
</body>
</html>