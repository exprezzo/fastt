<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="us">
<head>
	<meta charset="utf-8">
	<title>Wijmo Layout</title>
	<!--jQuery References-->
	<!--link href="/js/jquery-ui-1.9.2.custom/css/flick/jquery-ui-1.9.2.custom.css" rel="stylesheet"-->	
	<script src="/js/libs/jquery-1.8.3.js"></script>
	<script src="/js/libs/jquery-ui-1.9.2.custom/jquery-ui-1.9.2.custom.js"></script>  
	<!--Theme-->
	<!--link href="http://cdn.wijmo.com/themes/rocket/jquery-wijmo.css" rel="stylesheet" type="text/css" title="rocket-jqueryui" /-->
	<!--link href="/css/themes/rocket/jquery-wijmo.css" rel="stylesheet" type="text/css" title="rocket-jqueryui" /-->
	<link href="/css/themes/cobalt/jquery-wijmo.css" rel="stylesheet" type="text/css" title="rocket-jqueryui" />		
	<!--Wijmo Widgets CSS-->	
	<link href="/js/libs/Wijmo.2.3.2/Wijmo-Complete/css/jquery.wijmo-complete.2.3.2.css" rel="stylesheet" type="text/css" />
	<link href="/js/libs/Wijmo.2.3.2/Wijmo-Open/css/jquery.wijmo-open.2.3.2.css" rel="stylesheet" type="text/css" />		
	<!--Wijmo Widgets JavaScript-->
	<script src="/js/libs/Wijmo.2.3.2/Wijmo-Complete/js/jquery.wijmo-complete.all.2.3.2.min.js" type="text/javascript"></script>
	<script src="/js/libs/Wijmo.2.3.2/Wijmo-Open/js/jquery.wijmo-open.all.2.3.2.min.js" type="text/javascript"></script>		
	<!-- Gritter -->
	<link href="/js/libs/Gritter-master/css/jquery.gritter.css" rel="stylesheet" type="text/css" />
	<script src="/js/libs/Gritter-master/js/jquery.gritter.min.js" type="text/javascript"></script>
	
	
	<script src="/js/TabManager.js" type="text/javascript"></script>
	
	<script type="text/javascript">
		$(function () {
			$.extend($.gritter.options, { 
				position: 'bottom-right', // defaults to 'top-right' but can be 'bottom-left', 'bottom-right', 'top-left', 'top-right' (added in 1.7.1)
				fade_in_speed: 'medium', // how fast notifications fade in (string or int)
				fade_out_speed: 2000, // how fast the notices fade out
				time: 6000 // hang on the screen for...
			});

			TabManager.init();
			//$tabs.wijtabs('add','/pedidoi/lista_de_pedidos', 'Lista de pedidos');
			//$tabs.wijtabs('add','/index2', 'Tabs con extjs');
			//tab_counter++;			
			
			$('.btnVerPedidos')
			.button()
			.click(function () {				
				var tabListaPedidos = $('.ui-tabs-nav .listaPedidos');				
				if (tabListaPedidos.length > 0){					
					//Obtener el indice de este tab
					var tabs = $('.ui-tabs-nav li[role="tab"]');
					$.each(tabs, function(index, element) {																	
						var jElement = $(element);						
						if ( jElement.find ){
							var listaPedidos = jElement.find('.listaPedidos'); 							
							if ( listaPedidos.length > 0 ){
								TabManager.tabs.wijtabs('select', index);
							}							
						}
					});	
					
					
					return false;
				}
				
				TabManager.add('/pedidoi/verPedidos', 'Ver Pedidos');
			});
			
			
			$('.btnNuevoPedido')
			.button()
			.click(function () {				
				TabManager.add('/pedidoi/nuevoPedido', 'Nuevo Pedido');
			});
			
			
			ajustarTab();
		});
		$(window).resize(function() {
		  ajustarTab();
		});
		
		ajustarTab();
		function ajustarTab(){
			var h=$(window).height();
			
			var h2=$('.btnNuevoPedido').height();
			
			var newH = h-h2-30;
			
			
			$('#tabs').css('min-height',newH);
		}
	</script>
	<style type="text/css">
		.ui-tabs-panel{
			/* -background-color:white !important; */
		}
		 .ui-button { position: relative; }
		span.ui-button-text { 
			padding-top:40px !important;		
			background-repeat: no-repeat;
			background-position: top center;
			background-position:center 6px !important;
		}
		#gritter-notice-wrapper {
			/* 
			position:fixed;
			top: 20px;
			right: 20px;
			width:301px;
			z-index:9999; */
		}
		
		.btnVerPedidos span{
			background-image: url('/images/berlin_iconpack/order_list.png');
			background-position:center 5px;
		}
		
		.btnNuevoPedido span{
			background-image: url('/images/berlin_iconpack/order.png');
			background-position:center 5px;
		}
		
	/* TABS */
	#tabs{
		/* min-height:525px; */
		
	}
	
	.ui-tabs-nav{
		min-height:47px;
	}
	ul.ui-tabs-nav li a {		
			padding-top: 14px !important;
			padding-left: 38px !important;
			
			background-repeat: no-repeat;
			padding-bottom: 12px !important;
			background-position:5px;			
	}
	ul.ui-tabs-nav li a.listaPedidos{
		background-image:url('/images/berlin_iconpack/order_list.png');
	}
	
	/* GRID */
	.wijmo-wijgrid-row{
		height:38px;
	}
	/* PAGINADOR */
	li.ui-page{
		padding:8px 15px 8px 15px;
	}
	
	.btnGuardar span{
		background-image: url('/images/icons/save.png');
		
	}
	.btnEliminar span{
		background-image: url('/images/icons/delete.png');
		
	}
	.btnNuevo span{
		background-image: url('/images/icons/new.png');
		
	}
	@media only screen and (max-width: 999px) {
	  /* rules that only apply for canvases narrower than 1000px */
	}

	@media only screen and (device-width: 768px) and (orientation: landscape) {
	  /* rules for iPad in landscape orientation */
	}

	@media only screen and (min-device-width: 320px) and (max-device-width: 480px) {
	  /* iPhone, Android rules here */
	}
	</style>
</head>
<body>	
	<style type="text/css">
  
</style>
	<button class="btnVerPedidos" value="Ver Pedidos" >Ver Pedidos</button>
	<button class="btnNuevoPedido"  >Nuevo Pedido</button>
	
	<div id="tabs">
		 <ul>
			<li><a href="#tabs-1">Welcome</a> <span class="ui-icon ui-icon-close">Remove Tab</span></li>						
		</ul>
		<div id="tabs-1">
			<h3>Changelog</h3>
			<ul> 
				<li>estrenando Wijmo framework (25 Dic 2012)</li>
			</ul>
			<!--h3>En Proceso</h3>
				<li><h3>Layout General</h3>
					<ul>
						<li>Definir identificadores para los tabs, y funciones de buscar y seleccionar tabs con esos ids</li>
						<li>Layout de Tabs, Bug en firefox</li>						
					</ul>
				</li>
				<li><h3>Catalogo de Pedidos Internos</h3>
					<ul>
						<li>Validar Fecha del lado del cliente y del servidor</li>						
					</ul>
				</li>
				
			<h3>Pendientes</h3>			
				<li>Definir lista de dispositivos y navegadores donde se haran pruebas de usabilidad</li-->
				
			
		</div>
	</div>	 
</body>
</html>

