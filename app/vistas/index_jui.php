<!doctype html>
<html lang="us">
<head>
	<meta charset="utf-8">
	<title>Prototype</title>
	<link href="/js/jquery-ui-1.9.2.custom/css/flick/jquery-ui-1.9.2.custom.css" rel="stylesheet">
	<script src="/js/jquery-1.8.3.js"></script>
	<script src="/js/jquery-ui-1.9.2.custom/jquery-ui-1.9.2.custom.js"></script>
	<script>
	$(function() {
		
		$( "#accordion" ).accordion();
		

		
		var availableTags = [
			"ActionScript",
			"AppleScript",
			"Asp",
			"BASIC",
			"C",
			"C++",
			"Clojure",
			"COBOL",
			"ColdFusion",
			"Erlang",
			"Fortran",
			"Groovy",
			"Haskell",
			"Java",
			"JavaScript",
			"Lisp",
			"Perl",
			"PHP",
			"Python",
			"Ruby",
			"Scala",
			"Scheme"
		];
		$( "#autocomplete" ).autocomplete({
			source: availableTags
		});
		

		
		$( "#button" ).button();
		$( "#radioset" ).buttonset();
		

		
		$( "#tabs" ).tabs();
		

		
		$( "#dialog" ).dialog({
			autoOpen: false,
			width: 400,
			buttons: [
				{
					text: "Ok",
					click: function() {
						$( this ).dialog( "close" );
					}
				},
				{
					text: "Cancel",
					click: function() {
						$( this ).dialog( "close" );
					}
				}
			]
		});

		// Link to open the dialog
		$( "#dialog-link" ).click(function( event ) {
			$( "#dialog" ).dialog( "open" );
			event.preventDefault();
		});
		

		$('#datepicker').datepicker({inline: true})
		
		// $( "#datepicker" ).datepicker({
			// 
		// });
		

		
		$( "#slider" ).slider({
			range: true,
			values: [ 17, 67 ]
		});
		

		
		$( "#progressbar" ).progressbar({
			value: 20
		});
		

		// Hover states on the static widgets
		$( "#dialog-link, #icons li" ).hover(
			function() {
				$( this ).addClass( "ui-state-hover" );
			},
			function() {
				$( this ).removeClass( "ui-state-hover" );
			}
		);
		
		 $(function() {
			$( "input[type=submit]" )
				.button()
				.click(function( event ) {
					event.preventDefault();
				});
		});
	});
	</script>
	<style>
	body{
		font: 90% "Trebuchet MS", sans-serif;
		margin: 50px;
	}
	
	
	form .field label{
		width:60px;
		display:inline-block;
	}
	</style>
</head>
<body>

<h1>Prototype</h1>


<!-- Tabs -->
<div id="tabs">
	<ul>
		<li><a href="#tabs-1">Orden Interna</a></li>
		<li><a href="#tabs-2">Listado de ordenes</a></li>
		<li><a href="#tabs-3">Concentrado</a></li>
	</ul>
	<div id="tabs-1">
		<form action="/ordeni/guardar">
			<div class='field'>
				<label>Almacén:</label>
				<input type="number" />							
			<div>
			<div class='field'>
				<label>No. Pedido</label>
				<input type="number" />							
			<div>
			<div class='field'>
				<label>Fecha</label>
				<input type="date" />							
			<div>
			<input type="submit" value="A submit button" />
		</form>	
	</div>
	<div id="tabs-2">Phasellus mattis tincidunt nibh. Cras orci urna, blandit id, pretium vel, aliquet ornare, felis. Maecenas scelerisque sem non nisl. Fusce sed lorem in enim dictum bibendum.</div>
	<div id="tabs-3">Nam dui erat, auctor a, dignissim quis, sollicitudin eu, felis. Pellentesque nisi urna, interdum eget, sagittis et, consequat vestibulum, lacus. Mauris porttitor ullamcorper augue.</div>
</div>



</body>
</html>
