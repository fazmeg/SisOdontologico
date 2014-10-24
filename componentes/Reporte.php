<?php
$E1=$_POST['editor1'];
?>
<html>
<head>
    <title>Reporte</title>
    <meta content="text/html; charset=utf-8" http-equiv="content-type" />
    <script type="text/javascript" src="ckeditor/ckeditor.js"></script>
    <script src="ckeditor/_samples/sample.js" type="text/javascript"></script>
    <link href="ckeditor/_samples/sample.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript"> 
window.onload = function() 
{ 
var oFCKeditor = new ckeditor( 'editor1' ) ; 
oFCKeditor.ReplaceTextarea() ; 
} 
</script> 
</head>
<body>
    <form target="_blank" action="" method="post">
            <textarea class="ckeditor" cols="80" id="editor1" name="editor1" rows="20"></textarea>

            </textarea>
            <script type=”text/javascript”>
            CKEDITOR.replace ("editor1");
            </script></p>
        <p>
            <input type="submit" value="Generar" />
        </p>
    </form>
    <?php echo $E1; ?>
</body>
</html>