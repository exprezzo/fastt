
<script src="/web/<?php echo $_PETICION->modulo; ?>/js/catalogos/<?php echo $_PETICION->controlador; ?>/busqueda.js"></script>

<script>			
	$( function(){		
		var config={
			tab:{
				id:'<?php echo $_REQUEST['tabId']; ?>'
			},
			controlador:{
				nombre:'<?php echo $_PETICION->controlador; ?>'
			},
			catalogo:{
				nombre:'DetalleDeOrden'
			}
			
		};				
		 var lista=new Busquedadetalle_de_la_orden();
		 lista.init(config);		
	});
</script>
<?php 	
	global $_PETICION;
	$this->mostrar('/componentes/busqueda_toolbar');
?>
<div >	
	<table class="grid_busqueda">
		<thead>
			<th>id</th>		
			<th>titulo</th>					
		</thead>  	 
		<tbody>			
		</tbody>
	</table>
</div>
</div>
