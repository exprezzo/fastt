<style>
	div.pedido {padding:0 !important;}
	.content .top{display:block;background: #f1f1f1;padding:9px;
	background: -webkit-gradient(radial,100 36,0,100 -40,120,from(#fafafa),to(#f1f1f1)),#f1f1f1;}
	.content .left{display:inline-block;}
	
	.content .center{display:inline-block;vertical-align:top;}
</style>
<script>
	$(function(){
		var tabId='<?php echo $_REQUEST['tabId']; ?>';
		$('#'+tabId).addClass('pedido');
		var selector='#tabs > ul a[href="#'+tabId+'"]';
		
		$(selector).addClass('pedido');		
		//$('#'+tabId+" .tabpanel").wijtabs({alignment :'left'});
	});
</script>
<div class='content'>
	<div style="padding:0;display:inline-block;height:800px;" class="ui-widget-content">
		
		<div class="" style="padding-top:8px;">
			<h1><?php echo NOMBRE_APL; ?></h1>
			<span style="font-weight:bold;">Pedido 150, Almacen: Cocina</span>
		</div>		
		<!--div class="toolbar" style="display:inline-block;margin-top:10px;margin-left:10px;">			
			<div style="text-align:center;display:inline-block;margin-right:5px;" class="boton btnNew" >
				<div class="iconWrap" style="float:left;border-radius:7px;" >		
					<div class="icon" style="border-radius:7px;"></div>
				</div>								
			</div>
			<div style="text-align:center;display:inline-block;margin-right:5px;" class="boton btnGuardar" >
				<div class="iconWrap" style="float:left;border-radius:7px;" >		
					<div class="icon" style="border-radius:7px;"></div>
				</div>								
			</div>
			<div style="text-align:center;display:inline-block;margin-right:5px;" class="boton btnDelete" >
				<div class="iconWrap" style="float:left;border-radius:7px;" >		
					<div class="icon" style="border-radius:7px;"></div>
				</div>								
			</div>
			<div style="text-align:center;display:inline-block;margin-right:5px;" class="boton btnEmail" >
				<div class="iconWrap" style="float:left;border-radius:7px;" >		
					<div class="icon" style="border-radius:7px;"></div>
				</div>								
			</div>
			<div style="text-align:center;display:inline-block;margin-right:5px;" class="boton btnPrint" >
				<div class="iconWrap" style="float:left;border-radius:7px;" >		
					<div class="icon" style="border-radius:7px;"></div>
				</div>								
			</div>
			<div style="clear:both;"></div>
		</div-->
		
		<div class="tab-nav">
			<ul style="width:auto;padding:0;background:white;-webkit-box-shadow:1px">
				<li><a href="#tb1">Pedidos</a></li>
				<li><a href="#tb2">Pedido Nuevo</a></li>
				<li><a href="#tb3">Pedido 153</a></li>
			</ul>
		</div>
	</div>	
	<div class="left" style="vertical-align:top;">		
		
		<div class="tabpanel" style="display:inline;">		
			
			<div id="tb1"style="display:inline-block;">
				<?php //$this->mostrar($_PETICION->controlador.'/lista_de_pedidos'); ?>
			</div>
			<div id="tb2">
				<?php $this->mostrar($_PETICION->controlador.'/nuevo'); ?>
			</div>
			<div id="tb3"></div>
		</div>
	</div>
	
	<div class="centerx">
		
	</div>
</div>

