
<script src="/web/apps/<?php echo $_PETICION->modulo; ?>/js/catalogos/<?php echo $_PETICION->controlador; ?>/edicion.js"></script>

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
				nombre:'DetalleDeOrden'
			}
			
		};				
		 var editor=new Ediciondetalle_de_la_orden();
		 editor.init(config);		
	});
</script>

	<div class="pnlIzq">
		<?php 	
			global $_PETICION;
			$this->mostrar('/componentes/toolbar');	
			if (!isset($this->datos)){		
				$this->datos=array();		
			}
		?>
		
		<form class="frmEdicion" style="padding-top:10px;">	
			<input type="hidden" name="id" class="txtId" value="<?php echo $this->datos['id']; ?>" />	
			<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;" autoFocus >
			<label style="">fk_orden_compra:</label>
			<input type="text" name="fk_orden_compra" class="txt_fk_orden_compra" value="<?php echo $this->datos['fk_orden_compra']; ?>" style="width:500px;" />
		</div><div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;" autoFocus >
			<label style="">fk_articulo:</label>
			<input type="text" name="fk_articulo" class="txt_fk_articulo" value="<?php echo $this->datos['fk_articulo']; ?>" style="width:500px;" />
		</div><div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;" autoFocus >
			<label style="">idarticulopre:</label>
			<input type="text" name="idarticulopre" class="txt_idarticulopre" value="<?php echo $this->datos['idarticulopre']; ?>" style="width:500px;" />
		</div><div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;" autoFocus >
			<label style="">cantidad:</label>
			<input type="text" name="cantidad" class="txt_cantidad" value="<?php echo $this->datos['cantidad']; ?>" style="width:500px;" />
		</div><div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;" autoFocus >
			<label style="">fk_pedido_detalle:</label>
			<input type="text" name="fk_pedido_detalle" class="txt_fk_pedido_detalle" value="<?php echo $this->datos['fk_pedido_detalle']; ?>" style="width:500px;" />
		</div><div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;" autoFocus >
			<label style="">fk_producto_origen:</label>
			<input type="text" name="fk_producto_origen" class="txt_fk_producto_origen" value="<?php echo $this->datos['fk_producto_origen']; ?>" style="width:500px;" />
		</div><div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;" autoFocus >
			<label style="">fk_pedido:</label>
			<input type="text" name="fk_pedido" class="txt_fk_pedido" value="<?php echo $this->datos['fk_pedido']; ?>" style="width:500px;" />
		</div><div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;" autoFocus >
			<label style="">pedidoi:</label>
			<input type="text" name="pedidoi" class="txt_pedidoi" value="<?php echo $this->datos['pedidoi']; ?>" style="width:500px;" />
		</div><div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;" autoFocus >
			<label style="">fk_almacen:</label>
			<input type="text" name="fk_almacen" class="txt_fk_almacen" value="<?php echo $this->datos['fk_almacen']; ?>" style="width:500px;" />
		</div><div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;" autoFocus >
			<label style="">pendiente:</label>
			<input type="text" name="pendiente" class="txt_pendiente" value="<?php echo $this->datos['pendiente']; ?>" style="width:500px;" />
		</div>
	</div>
</div>
