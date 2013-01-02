<script type="text/javascript">
$( function(){
	var tabId="<?php echo $_REQUEST['tabId']; ?>";
	$('a[href="'+tabId+'"]').html('WELCOME');		
});
</script>

<div id="tabs-1">
	<h3>Changelog</h3>
	<ul> 
		<li>estrenando Wijmo framework (25 Dic 2012)</li>
	</ul>
	<h3>En Proceso</h3>
		<li><h3>Layout General</h3>
			<ul>						
				<li>Tab: Bug visual en firefox</li>						
			</ul>
		</li>		
		
	<h3>Pendientes</h3>			
		<li>Definir lista de dispositivos y navegadores donde se haran pruebas de usabilidad</li>
		<li>Los grids deben crecer al tamaño de pantalla disponible</li>		
</div>