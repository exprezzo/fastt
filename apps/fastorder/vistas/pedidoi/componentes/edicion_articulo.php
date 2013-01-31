<script src="/web/apps/<?php echo $_PETICION->modulo; ?>/js/catalogos/pedidos/edicion_articulo.js"></script>
<script>
	$(function(){
		var  tabId="<?php echo $_REQUEST['tabId']; ?>";
		var frmEdicionArticulo = new EdicionArticulo(tabId);
		 frmEdicionArticulo.init(tabId);
	});
</script>
<div class="frmEditInlinePedido" style="">

	<form>
		<input type="hidden" class="txtId" />
		<input readonly="true" type="text" class="txtCodigo" placeholder="Codigo" style="display:inline-block;width:200px;"/>
		<select class="cmbArticulo" placeholder="Articulo">
			<option value="1">a</option>
			<option value="2">b</option>
			<option value="3">c</option>
			<option value="4">d</option>
		</select>						
		<input readonly="true" placeholder="Presentacion"  class="txtPresentacion"/>
			
		<input placeholder="maximo" class="txtMaximo"/>
		<input placeholder="minimo" class="txtMinimo"/>
		<input placeholder="reorden" class="txtPuntoReorden"/>
		<input placeholder="inv_inicial" class="txtInvInicial" value="0" />
		<input placeholder="sugerido" class="txtSugerido"/>
		<input placeholder="cantidad pedida" class="txtPedido"/>
		<input placeholder="pendiente" class="txtPendiente"/>		
		<input type="hidden" class="txtFkArticulo" />
		<input type="hidden" class="txtIdArticuloPre" />
		<input type="hidden" class="txtIdTmp" />
	</form>
	<div class="toolbarFormPedidoInline">

		<div style="text-align:center;" class="boton btnGuardar">
			<div class="iconWrap">		
				<div class="icon"></div>
			</div>
			<div class="wrapText">
				<span>Guardar</span>
			</div>		
		</div>
		<div style="text-align:center;" class="boton btnCancel">
			<div class="iconWrap">		
				<div class="icon"></div>
			</div>
			<div class="wrapText">
				<span>Cancelar</span>
			</div>		
		</div>				
		<div style="text-align:center;" class="boton btnDelete">
			<div class="iconWrap">		
				<div class="icon"></div>
			</div>
			<div class="wrapText">
				<span>Borrar</span>
			</div>		
		</div>	
							
	</div>
</div>