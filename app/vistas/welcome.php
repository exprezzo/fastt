<script type="text/javascript">
$( function(){
	var tabId="<?php echo $_REQUEST['tabId']; ?>";
	$('a[href="'+tabId+'"]').html('WELCOME');		
});
</script>

<div class="">
	<h3>Changelog</h3>
	<ul> 
		<li>estrenando Wijmo framework (25 Dic 2012)</li>
	</ul>
	<hr>
	<h3>En Proceso</h3>
		<li><h3>Layout General</h3>
			<ul>						
				<li>Tabs: Bug visual en firefox, la x usada para cerrar el tab, aparece en el piso</li>						
				<li>Bug: Un tab puede abrirse dos veces: Abrir tab de acceso directo, abrir el mismo tab desde el menu principal, Erro! </li>
			</ul>
				
		</li>		
		<li><h3>Catalogo Pedidos</h3></li>
		<li><h4>Lista de Pedidos</h4></li>		
		<li><h4>Edicion de Pedido</h4></li>
	<hr>
	<h3>Otros</h3>			
		<li>Crear lista de dispositivos y navegadores donde debe funcionar el sistema</li>
		<li>Definir las acciones que debe tener el toolbar de edicion y el de busqueda</li>
		<li>Definir Tema principal para adaptar la pantalla de login</li>
</div>