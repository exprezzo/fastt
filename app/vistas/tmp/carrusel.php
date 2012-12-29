<script type="text/javascript">
	$(function () {
		var wh = $(window).width();
		var nw=wh-35;
		var numIcons=parseInt(nw/96);
		numIcons--;				
		$('#carousel').width(nw);
		
		$("#carousel").wijcarousel({ 
			display: numIcons, 
			step:numIcons,
			showTimer: false, 
			showPager: false, 
			loop: true, 
			showControlsOnHover: true,
			itemClick: function (e, data) {
				var ancla=data.el.find('a');
				if (ancla.length > 0){
					var ruta=a.attr('href');
					alert(ruta);	
				}else{
					$.gritter.add({
						position: 'bottom-left',
						title:'Info',
						text: 'Menu de demostración',
						image: '/images/info.png',
						class_name: 'my-sticky-class'
					});
				}
			
			} 
		});
		
		$('.menListarPedidos').click(function(){
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
		
		$('.menNuevoPedido')
			.click(function () {				
				TabManager.add('/pedidoi/nuevoPedido', 'Nuevo Pedido');
			});
	});
	
	
</script>
<style type="text/css">
	 #carousel
	{
		
		height: 100px;
		margin-bottom:4px;
		margin-top:-23px;
	}
	li.wijmo-wijcarousel-item .wijmo-wijcarousel-text,li.wijmo-wijcarousel-item .wijmo-wijcarousel-caption{
		visibility:hidden;
	}
	
	li.wijmo-wijcarousel-item:hover .wijmo-wijcarousel-text,li.wijmo-wijcarousel-item:hover .wijmo-wijcarousel-caption{
		visibility:visible;
	}
	#carousel.ui-widget-content{
		border:0;
		background:none;
	}
</style>
	<div id="carousel">
  <ul>
    <li>
        <a href="#" class="menListarPedidos"><img src="/images/icons/diagram_v2_01.png" alt="Sports 1" /></a>
        <span>Pedidos</span></li>
    <li>
        <a href="#" class="menNuevoPedido"> <img src="/images/icons/diagram_v2_02.png" alt="Sports 2" /></a>
        <span>Nuevo Pedido</span></li>
    <li>
        <img src="/images/icons/diagram_v2_03.png" alt="Sports 3" />
        <span>Caption 3</span></li>
    <li>
        <img src="/images/icons/diagram_v2_04.png" alt="Sports 4" />
        <span>Caption 4</span></li>
    <li>
        <img src="/images/icons/diagram_v2_05.png" alt="Sports 5" />
        <span>Caption 5</span></li>
    <li>
        <img src="/images/icons/diagram_v2_06.png" alt="Sports 6" />
        <span>Caption 6</span></li>
    <li>
        <img src="/images/icons/diagram_v2_07.png" alt="Sports 7" />
        <span>Caption 7</span></li>
    <li>
        <img src="/images/icons/diagram_v2_08.png" alt="Sports 8" />
        <span>Caption 8</span></li>
	<li>
        <img src="/images/icons/diagram_v2_09.png" alt="Sports 8" />
        <span>Caption 8</span></li>
	<li>
        <img src="/images/icons/diagram_v2_10.png" alt="Sports 8" />
        <span>Caption 8</span></li>
	<li>
        <img src="/images/icons/diagram_v2_11.png" alt="Sports 8" />
        <span>Caption 8</span></li>
	<li>
        <img src="/images/icons/diagram_v2_17.png" alt="Sports 8" />
        <span>Caption 8</span></li>
	<li>
        <img src="/images/icons/diagram_v2_13.png" alt="Sports 8" />
        <span>Caption 8</span></li>
	<li>
        <img src="/images/icons/diagram_v2_16.png" alt="Sports 8" />
        <span>Caption 8</span></li>
		
  </ul>
</div>