<script type="text/javascript">
	$(function () {		
		var tabId="<?php echo $_REQUEST['tabId']; ?>";
		tabId='#'+tabId;
		$('a[href="'+tabId+'"]').html('Menu Principal');		
		$('a[href="'+tabId+'"]').addClass('tabMenuPrincipal');
		iniciarLinkTabs();	
		
		var h=$(window).height();		
		var position=$('#tabs').position();					
		var tabsH = $('#tabs ul[role="tablist"]').height();
		var newH = (h-position.top)-tabsH-60;
		//alert("h= "+h + "position.top= "+position.top+" tabsH="+tabsH+" newH= "+newH);			
		$('#menu_principal').css('max-height',newH);
		
		var items = $('#menu_principal div');
		var ancho;
		$.each(items, function(indexInArray, valueOfElement){
			ancho = $(valueOfElement).find('img').width();
			
			$(valueOfElement).css('width',96);
			$(valueOfElement).css('height',96);
		});
		
		
		$('#menu_principal div').mouseenter(function(){						
			// var imagen=$(this).find('img').animate({width:'110px'},100);
			var label=$(this).find('label').animate({opacity:1},500);
		});
		
		$('#menu_principal div').click(function(){
			var img=$(this).find('img');
			// img.animate({width:'102px'},50);
			// img.animate({width:'110px'},90);
		});
		
		$('#menu_principal div').mouseleave(function(){
			// var imagen=$(this).find('img').animate({width:'96px'},100);
			var label=$(this).find('label').animate({opacity:'0'},500);
		});
		
	});
</script>
<style type="text/css">
 
 
        .menu_elements div {display:inline-block; text-align:center; padding:23px;}
		.menu_elements img {display:inline-block;}
		.menu_elements label {display:block;}
		#menu_principal{overflow:auto;	}
</style>

        <div id="menu_principal" class="menu_elements">
            <div tabLink="true" href="/pedidoi/verPedidos" title="Ver Pedidos">
				<img src="/images/icons/diagram_v2_17.png" />
				<label>Pedidos</label>
			</div>
			<div tabLink="false" href="/pedidoi/verPedidos" title="Ver Pedidos">
				<img src="/images/icons/diagram_v2_01.png" />
				<label>MENU</label>
			</div>
			<div tabLink="false" href="/pedidoi/verPedidos" title="Ver Pedidos">
				<img src="/images/icons/diagram_v2_02.png" />
				<label>MENU</label>
			</div>
			<div tabLink="false" href="/pedidoi/verPedidos" title="Ver Pedidos">
				<img src="/images/icons/diagram_v2_03.png" />
				<label>MENU</label>
			</div>
			<div tabLink="false" href="/pedidoi/verPedidos" title="Ver Pedidos">
				<img src="/images/icons/diagram_v2_04.png" />
				<label>MENU</label>
			</div>
			<div tabLink="false" href="/pedidoi/verPedidos" title="Ver Pedidos">
				<img src="/images/icons/diagram_v2_05.png" />
				<label>MENU</label>
			</div>
			<div tabLink="false" href="/pedidoi/verPedidos" title="Ver Pedidos">
				<img src="/images/icons/diagram_v2_06.png" />
				<label>MENU</label>
			</div>
			<div tabLink="false" href="/pedidoi/verPedidos" title="Ver Pedidos">
				<img src="/images/icons/diagram_v2_07.png" />
				<label>MENU</label>
			</div>
			<div tabLink="false" href="/pedidoi/verPedidos" title="Ver Pedidos">
				<img src="/images/icons/diagram_v2_08.png" />
				<label>MENU</label>
			</div>
			<div tabLink="false" href="/pedidoi/verPedidos" title="Ver Pedidos">
				<img src="/images/icons/diagram_v2_09.png" />
				<label>MENU</label>
			</div>
			<div tabLink="false" href="/pedidoi/verPedidos" title="Ver Pedidos">
				<img src="/images/icons/diagram_v2_10.png" />
				<label>MENU</label>
			</div>
			<div tabLink="false" href="/pedidoi/verPedidos" title="Ver Pedidos">
				<img src="/images/icons/diagram_v2_11.png" />
				<label>MENU</label>
			</div>
			<div tabLink="false" href="/pedidoi/verPedidos" title="Ver Pedidos">
				<img src="/images/icons/diagram_v2_13.png" />
				<label>MENU</label>
			</div>
			
			
			<div tabLink="true" href="/tests/popup" title="Ver Pedidos">
				<img src="/images/icons/diagram_v2_13.png" />
				<label>MENU 2</label>
			</div>
        </div>


