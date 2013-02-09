<style type="text/css">
	.frmPedido .inputBox{display:inline-block !important; }
	.divLabel {vertical-align:bottom;text-alignt:right; text-align:right; display:inline-block;}
.divNumerosStock ul{padding:0;margin:0;}
.divNumerosStock li{display:inline ;padding:0;margin:0;}
.stock_numbers li{display:inline;}

	.frmEditInlinePedido input[readonly="true"]{
		border:none !important;
		text-align:right;
	}
	.frmEditInlinePedido input{
		text-align:right;
	}
	@media screen and (max-width:1280px) { 
		
	}
	
	@media screen and (min-width:1250px) { 
		/* .divNumerosStock li:not(:first-child):before, .stock_numbers li:not(:first-child):before
		{ 
		content:", ";
		} */
		
		.stock_numbers li
		{ 
			border:1px solid;
			border-left:0;
			border-color:gray;
			padding:10px 8px 10px 8px;
		}		
		.stock_numbers li:last-child{
			border-right:0;
		}
		
		.divNumerosStock ul{margin-top:5px;}
		.divNumerosStock li{
			border:1px solid;
			border-left:0;
			border-color:gray;
			padding:10px 8px 10px 8px;
			
		}
		
		.divNumerosStock li:first-child{
			border-left:1px solid;
		}
		
	}
	@media screen and (max-width:1250px) { 
		.divNumerosStock li{display:block;padding:0;margin-right:10px;}
		.stock_numbers li{display:block;}

	}
</style>
<script src="/web/apps/<?php echo $_PETICION->modulo; ?>/js/catalogos/pedidos/edicion_articulo.js"></script>
<script src="/web/apps/<?php echo $_PETICION->modulo; ?>/js/catalogos/pedidos/edicion_pedido.js"></script>
<link href='/web/apps/<?php echo $_PETICION->modulo; ?>/css/pedidoi.css' rel="stylesheet" type="text/css" />
<script>
	$( function(){
		var tabId="<?php echo $_REQUEST['tabId']; ?>";
		var pedidoId=<?php echo $_REQUEST['pedidoId']; ?>;
		var almacen="<?php echo isset($this->pedido)?  $this->pedido['nombreAlmacen'] : ''; ?>";
		var edicion = new EdicionPedido();
		edicion.init(tabId, pedidoId, almacen);
		$('#'+tabId+' .toolbarFormPedido .boton:not(.btnPrint, .btnEmail)').mouseenter(function(){
			$(this).addClass("ui-state-hover");
		});
		
		// $('#'+tabId+' .toolbarFormPedido .boton *').mouseenter(function(){						
			 // $(this).parent('.boton').addClass("ui-state-hover");						
		// });		
		
		$('#'+tabId+' .toolbarFormPedido .boton').mouseleave(function(e){			 
				$(this).removeClass("ui-state-hover");			
		});
		
		
	});
</script>

<!--div >
	<button class='btnGuardar'>Guardar</button>
	<button class='btnEliminar'>Eliminar</button>
	<button class='btnNuevo'>Nuevo</button>
</div-->

<?php
	if (isset($this->pedido)){
		$fecha= $this->pedido['fecha'];
		$vencimiento= $this->pedido['vencimiento'];
		$nombreAlmacen= $this->pedido['nombreAlmacen'];
		$fk_almacen= isset($this->pedido)? $this->pedido['fk_almacen'] : '';
		$id= isset($this->pedido)? $this->pedido['id'] : 0;
		$id_tmp= empty($this->pedido['id_tmp'])?0 : $this->pedido['id_tmp'];
		$fk_serie= empty($this->pedido['fk_serie'])?0 : $this->pedido['fk_serie'];
		$folio= empty($this->pedido['folio'])?0 : $this->pedido['folio'];
		
	}	
?>


<!--div class="formTitle ui-widget-header ">
	<!-- BARRA DE TITULO --c
	<span class="">PEDIDO</span>
	<span class="closeBtn ui-icon ui-icon-close"></span>
</div-->

<div class="paneles" style="width:90%;">
	<div class="pnlIzq">
		<div style="display:block;">
		<?php $this->mostrar($_PETICION->controlador.'/componentes/toolbar'); ?>
		</div>
		<form class='frmPedidoi' style='padding-top:10px;'>	
			<input type='hidden' name='id' class="txtId" value="<?php echo $id; ?>" />	
			<input type='hidden' name='id_tmp' class="txtIdTmp" value="<?php echo $id_tmp; ?>" />	
			<input type='hidden' name='fecha' class="txtFkAlmacen" value="<?php echo $fk_almacen; ?>" />
			<input type='hidden'  name='serie' class="txtFkSerie" value="<?php echo $fk_serie; ?>" />
			<div style='display:inline-block;'>
				<div class="inputBox" style='margin-bottoms:5px;display:inline;'>		
					<label class="lblSerie" style="width:auto;">Serie:</label>
					<select class="cmbSerie" style='width:70px;'>			
					</select>
				</div>	
				<div class="inputBox" style='margin-bottom:8px;display:inline;margin-left:10px;'>
					<label style="width:auto;">Folio:</label>
					<input readonly="readonly" type='text' name='folo' class="txtFolio" value="<?php echo $folio; ?>" style="width:70px;text-align:right;" />
				</div>
				<br/>
				<div class="inputBox" style='margin-bottoms:5px;display:inline;'>		
					<label class="lblAlmacen" style="width:auto;">Almacen:</label>
					<select class="cmbAlmacen" style='width:170px;'>			
					</select>
				</div>		
				<div class="inputBox" style='margin-bottoms:5px;display:inline;'>							
					<button class="btnCargarArticulos" >Cargar Articulos</button>
				</div>						
				<div class="inputBox" style='margin-bottom:8px;display:inline;margin-left:10px;'>
					<label style="width:auto;">Fecha:</label>
					<input type='text' name='fecha' class="txtFecha" style='width:150px;' value="<?php echo $fecha; ?>" autofocus />
				</div>
				
				<div class="inputBox" style='margin-bottom:8px;display:inline;height:26px;margin-left:10px;'>
					<label style="width:auto;">Vencimiento:</label>
					<input type='text' name='vencimiento' class="txtVencimiento" value="<?php echo $vencimiento; ?>"  />
				</div>
				
			</div>
			
			<br />	
		</form>
		
	</div>
	<div class="cardArticulos">
			<div style='display:inline-block;' class="pnlArticulos ui-widget-content">								
				<table class="grid_articulos" style="width:98%;">
					<thead>
						<th>Producto</th> 
						<th>Cantidad</th>
					</thead>
				  <tbody>
					<tr><td></td> <td></td></tr>
					<?php 
						if ( isset($this->pedido) )
						foreach($this->pedido['articulos'] as $articulo){			
						//	echo '<tr><td>'.$articulo['nombreProducto'].'</td> <td>'.$articulo['cantidad'].'</td></tr>';
						}
					?>
					
				  </tbody>
				</table>
			</div>
			
			<?php $this->mostrar('pedidoi/componentes/edicion_articulo'); ?>
			
		</div>
	<div class="pnlDer" >
		
	</div>
</div>