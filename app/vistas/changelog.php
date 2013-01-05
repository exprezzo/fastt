<script type="text/javascript">
$( function(){
	var tabId="<?php echo $_REQUEST['tabId']; ?>";
	$('a[href="'+tabId+'"]').html('WELCOME');
	$('a[href="'+tabId+'"]').addClass('tabWelcome');
});
</script>

<div class="">
	<h3>Changelog</h3>
	<ul> 		
		<li>Bug corregido: bug que permitia abrir tabs duplicados (3 Ene 2012).</li>
		<li>Cambios al header.</li>
		<li>estrenando Wijmo framework (25 Dic 2012)</li>		
	</ul>
	<hr>
	<h3>En Proceso</h3>
		<li><h4>Edicion de Pedido</h4></li>
		<ul>
			<li>Bug que oculta el segundo toolbar</li>			
		</ul>
		<li><h4>Lista de Pedidos</h4></li>
		<ul><li>Agregar filtros por fechas</li></ul>
		<ul><li>Imprimir</li></ul>
		<li><h4>Layout General</h4>
		
		
	<hr>
	<h3>Otros</h3>			
		<li>Crear lista de dispositivos y navegadores donde debe funcionar el sistema</li>		
</div>