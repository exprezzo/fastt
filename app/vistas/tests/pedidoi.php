<style type="text/css">
	form.frmPedidoi label{
		width:100px;
		/* display:inline-block; */
	}
	
	
</style>
<script src="/js/catalogos/pedidos/edicion_pedido.js"></script>
<script>
	$( function(){
		var tabId="<?php echo $_REQUEST['tabId']; ?>";
		var pedidoId=<?php echo $_REQUEST['pedidoId']; ?>;
		var almacen="<?php echo isset($this->pedido)?  $this->pedido['nombreAlmacen'] : ''; ?>";
		
		EdicionPedido.init(tabId, pedidoId, almacen);

	});
</script>
<?php include_once('../app/vistas/pedidoi/toolbar.php'); ?>
<!--div >
	<button class='btnGuardar'>Guardar</button>
	<button class='btnEliminar'>Eliminar</button>
	<button class='btnNuevo'>Nuevo</button>
</div-->

<?php
	$fecha= isset($this->pedido)? $this->pedido['fecha'] : '';
	$nombreAlmacen= isset($this->pedido)? $this->pedido['nombreAlmacen'] : '';
	$fk_almacen= isset($this->pedido)? $this->pedido['fk_almacen'] : '';
	$id= isset($this->pedido)? $this->pedido['id'] : 0;
?>
<form class='frmPedidoi' style='padding-top:10px;'>	
	<input type='hidden' name='id' class="txtId" value="<?php echo $id; ?>" />	
	<input type='hidden' name='fecha' class="txtFkAlmacen" value="<?php echo $fk_almacen; ?>" />
	<div class="inputBox" style='margin-bottoms:5px;'>
		<label >Fecha:</label>
		<input type='text' name='fecha' class="txtFecha" value="<?php echo $fecha; ?>" />
	</div>
	<div class="inputBox" style='margin-bottoms:5px;'>		
		<label>Almacen:</label>
		<select class="cmbAlmacen" style='width:170px;'>			
		</select>
	</div>		
	
	<br />	
</form>

<div style='background-color:white; padding:2px;'>
	<?php include_once('../app/vistas/pedidoi/toolbar_articulos.php'); ?>
	<table class="grid_articulos" style="">
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