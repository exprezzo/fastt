<script src="/js/catalogos/pedidos/edicion_articulo.js"></script>
<script>
	$(function(){
		var  tabId="<?php echo $_REQUEST['tabId']; ?>";
		EdicionArticulo.init(tabId);
	});
</script>
<form>	
	<div class="inputBox" style='margin-bottoms:5px;'>		
		<label>Articulo:</label>
		<select class="cmbArticulo" style='width:170px;'>			
		</select>
	</div>	
	
	<div class="inputBox" style='margin-bottoms:5px;'>
		<label >Cantidad:</label>
		<input type='text' name='cantidad' class="txtCantidad" value="" />
	</div>
	
	<div class="inputBox" style='margin-bottoms:5px;'>		
		<label>UM:</label>
		<select class="cmbUM" style='width:170px;'>			
		</select>
	</div>	
</form>	