
<script>
	$(function(){
		// var  tabId="<?php echo $_REQUEST['tabId']; ?>";
		// var frmEdicionArticulo = new EdicionArticulo(tabId);
		// frmEdicionArticulo.init(tabId);
	});
</script>
<div class="frmEditInlinePedido" style="">

	<form>
		<input type="hidden" class="txtId" />
		<!--input readonly="true" type="text" class="txtCodigo" placeholder="Codigo" style="display:inline-block;width:200px;"/-->
		
			<select class="cmbCodigo" placeholder="codigo">			
				<option>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
			</select>				
		
		<select class="cmbArticulo" placeholder="Articulo" itemId='cmbArticulo'>			
		</select>				
		<input readonly="true" placeholder="Presentacion"  class="txtPresentacion" style="text-align:center;"/>
		<div class="divNumerosStock divLabel" >
			<ul>
				
			</ul>
			
		</div>
		
		<input readonly="true" type="hidden" placeholder="maximo" class="txtMaximo"/>
		<input type="hidden" type="hidden" readonly="true" placeholder="minimo" class="txtMinimo"/>
		<input type="hidden" type="hidden" readonly="true" placeholder="reorden" class="txtPuntoReorden"/>
		<input placeholder="existencia" class="txtExistencia" value="0" />
		<input readonly="true" placeholder="sugerido" class="txtSugerido"/>
		<input placeholder="cantidad pedida" class="txtPedido"/>
		<input readonly="true" placeholder="pendiente" class="txtPendiente"/>		
		<input type="hidden" class="txtFkArticulo" />
		<input type="hidden" class="txtIdArticuloPre" />
		<input type="hidden" class="txtIdTmp" />
		<input type="hidden" class="txtDataItemIndex" style="min-width:200px !important;" />
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