<?php 
	header('Location: /wijmo');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/>
		<title>Fast Order</title>
		<link rel="shortcut icon" href="imagen/favicon.ico"/>
		<link href="css/index.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="js/jquery/jquery-1.8.2.js"></script>
		<script type="text/javascript" src="js/fastorder.js"></script>
	</head>

	<body onload="">
		<h1>Bienvenidos al sistema FastOrder</h1>
		<form id="forLogin" action="index.php" method="POST" >
			Usuario: <input id="txtLogUsu" name="txtLogUsu" type="text" placeholder="Nombre de usuario" />
			Contraseña: <input id="txtLogCon" name="txtLogCon" Type="password" placeholder="Contraseña de Usuario" />
			<input id="botLogAce" type="submit" name="submit" value="Iniciar" />
		</form>
	</body>
</html>