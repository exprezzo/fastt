<script type="text/javascript">
	$(function () {
		$(".ribbon").wijribbon({
			click: function (e, cmd) {
				switch(cmd.commandName){
					case 'nuevo':
						TabManager.add('/pedidoi/nuevo','Nuevo Pedido');				
					break;
					default:						
						$.gritter.add({
							position: 'bottom-left',
							title:"Informaci&oacute;n",
							text: "Acciones del toolbar en construcci&oacute;n",
							image: '/images/info.png',
							class_name: 'my-sticky-class'
						});
					break;
				}
				
			}
		})
	});	
</script>
<style type="text/css">	
</style>
	
<div class="ribbon">
	<ul>
		 <li><a href="#tbPedido">Format</a></li>		 
	</ul>
	<div id="tbPedido" class="tbPedido">
		<ul>
			<li id="actiongroup">				
				<button title="Nuevo" class="" name="nuevo">
					<div class="btnNuevo"></div>
					<span>Nuevo</span>
				</button>				
				<button title="Eliminar" class="" name="eliminar">
					<div class="btnEliminar"></div>
					<span>Eliminar</span>
				</button>
				<button title="Imprimir" class="" name="imprimir">
					<div class="btnImprimir"></div>
					<span>Imprimir</span>
				</button>				
			 </li>
		</ul>
	</div>
</div>
