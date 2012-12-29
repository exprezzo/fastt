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
	
	<link href="/css/estilos_wijmo.css" rel="stylesheet" type="text/css" / >
	<script src="/js/TabManager.js" type="text/javascript"></script>
	
	<script type="text/javascript">
		function iniciarLinkTabs(){		
			var links=$('[tablink="true"]');
			$.each(links, function(index, element) {
				var link=$(element);
				if ( !link.attr )  return false;
				var destino=link.attr('href');
				link.attr('href','#');
				
				link.attr('tablink',false);
				link.addClass('link');
				link.click(function(){
					TabManager.add(destino,'Cargando...');
				});
			});
		}
		
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
			
			ajustarTab();
			iniciarLinkTabs();
			
			
			$("#lnkMenu").click(function(){
				// var url='/menu';
				// var titulo='Menu Principal';
				// TabManager.add(url,titulo);
				TabManager.add('/welcome');
            });
			
			TabManager.add('/welcome');
			TabManager.add('/menu');
			
			
			$(window).resize(function() {
			  ajustarTab();
			});
		});
		
		
		
		function ajustarTab(){
			var h=$(window).height();			
			var position=$('#tabs').position();			
			var newH = (h-position.top);			
			$('#tabs').css('min-height',newH);
			
			
		}
		
		
	</script>
	<style type="text/css">
		.btnVerPedidos span{ background-image: url('/images/berlin_iconpack/order_list.png'); background-position:center 5px; }		
		.btnNuevoPedido span{ background-image: url('/images/berlin_iconpack/order.png'); background-position:center 5px; }	
		.btnGuardar span{ background-image: url('/images/icons/save.png'); }
		.btnEliminar span{ background-image: url('/images/icons/delete.png'); }
		.btnNuevo span{ background-image: url('/images/icons/new.png'); }
		@media only screen and (max-width: 999px) {	  } /* rules that only apply for canvases narrower than 1000px */
		@media only screen and (device-width: 768px) and (orientation: landscape) {} /* rules for iPad in landscape orientation */
		@media only screen and (min-device-width: 320px) and (max-device-width: 480px) {}/* iPhone, Android rules here */		
		.link{
			cursor:pointer;
		}
	</style>
	
</head>
<body style="padding:0; margin:0;">	
	<style type="text/css">
  
	</style>
	<div style="padding:10px 0 10px 20px; float:left;">
		<a href="#" id="lnkMenu" ><img height="91px" src="/images/lamona.png" /></a>
	</div>
	
	<div style="float:right;margin-right:20px;">
		<a href="/user/perfil" tablink="true">Perfil</a>
		<a href="/user/logout">Salir</a>
	</div>
	
	<div style="float:right;margin-right:20px;">
		<a href="/menu" tablink="true" ><img width="60px" src="/images/icons/diagram_v2_13.png" /></a>
	</div>
	<div style="clear:both;"></div>
	<div id="tabs">
		 <ul>			
		</ul>		
	</div>	 
</body>
</html>

