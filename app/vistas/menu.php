<script type="text/javascript">
	$(function () {		
		var tabId="<?php echo $_REQUEST['tabId']; ?>";
		$('a[href="'+tabId+'"]').html('Menu Principal');		
		$('a[href="'+tabId+'"]').addClass('tabMenuPrincipal');
		iniciarLinkTabs();	
		
		var h=$(window).height();		
			var position=$('#tabs').position();					
			var tabsH = $('#tabs ul[role="tablist"]').height();
			var newH = (h-position.top)-tabsH-60;
			//alert("h= "+h + "position.top= "+position.top+" tabsH="+tabsH+" newH= "+newH);			
			$('#menu_principal').css('max-height',newH);
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
        </div>


