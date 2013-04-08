<script src="/web/<?php echo $_PETICION->modulo; ?>/js/catalogos/orden_compra/lista_orden_compra.js"></script>
<style type="text/css">
	.colFecha{
		text-align:right;
	}
	.tbFecha input{
		height: 30px;
		font-size: 17px;
		text-align: right;
	}
	
	.tbFecha > div:first-child{
		display:block;
	}
	
	.tbFecha .ui-icon{
		
	/*
		background-image: url('/images/office_calendar.png') !important;
		width:52px !important;
		height:19px !important;*/
		background-position:-47px -95px !important; 
		
	}
	
	.tbFecha .wijmo-wijinput-trigger{
		background: transparent;
		border: 0;
		
	}
	div.lista_orden_compra{
		margin-top: 25px !important;
		
	}
	
</style>
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
				nombre:'Orden de Compra'
			}
			
		};
		
		
		
		var lista=new ListaOrdenCompra();
		lista.init(config);
		
	});
</script>
<?php 
	//include_once('../app/vistas/pedidoi/lista_toolbar.php') 
	global $_PETICION;
	$this->mostrar($_PETICION->controlador.'/componentes/lista_toolbar');
?>
<div style="">	
	<table class="lista_orden_de_compra">
		<thead>
			<th>id</th>		
			<th>Almac&eacute;n</th>		
			<th>Fecha</th> 		
		</thead>  	 
		<tbody>
			
		</tbody>
	</table>
</div>
</div>