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
	.ribbon .ui-tabs-nav{
		display:none;
	}
	.tbPedido .btnGuardar{
		background-image:url('/images/floppy.png') !important;
		top:5px;
		width:48px;
		height:48px;
		background-size:40px;
		background-repeat:no-repeat;
		background-position: 5px 0px;
		padding: 0;		
	}
	
	.tbPedido .btnNuevo{
		background-image:url('/images/file.png') !important;
		top:5px;
		width:48px;
		height:48px;
		background-size:40px;
		background-repeat:no-repeat;
		background-position: 5px 0px;
		padding: 0;		
	}
	
	.tbPedido .btnEliminar{
		background-image:url('/images/recycle.png') !important;
		top:5px;
		width:48px;
		height:48px;
		background-size:40px;
		background-repeat:no-repeat;
		background-position: 5px 0px;
		padding: 0;		
	}
	
	.tbPedido .btnImprimir{
		background-image:url('/images/print.png') !important;
		top:5px;
		width:48px;
		height:48px;
		background-size:40px;
		background-repeat:no-repeat;
		background-position: 5px 0px;
		padding: 0;		
	}
	
	.tbPedido button{
		width:61px;
	}
	.tbPedido .ui-button-text{
		padding:0;
	}
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
