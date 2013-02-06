<script type="text/javascript">
	$(function () {
	
		
	});	
</script>
<style type="text/css">	
	.cmbAlmacenW .ui-icon, .cmbEstadoW .ui-icon{
		background-position:-65px -16px !important;
		background-image:url('http://cdn.wijmo.com/themes/rocket/images/ui-icons_00a6dd_256x240.png') !important;
	}
	
	.cmbAlmacenW .wijmo-wijinput-trigger, .cmbEstadoW .wijmo-wijinput-trigger{
		background: transparent;
		border: 0;
	}
</style>

<?php $tabId=$_REQUEST['tabId']; ?>

<div class="ribbon tbPedidos">
	<ul>
		 <li><a href="#tbPedido_<?php echo $tabId; ?>">Format</a></li>		 
	</ul>
	<div id="tbPedido_<?php echo $tabId; ?>" class="tbPedido">
		<div style="display:inline-block;vertical-align:top;"> 
			<button title="Nuevo" class="" name="nuevo">
					<span class="btnNuevo"></span>
					<span>Nuevo</span>
				</button>				
				<button title="Editar" class="" name="editar">
					<span class="btnEditar"></span>
					<span>Editar</span>
				</button>
				<button title="Eliminar" class="" name="eliminar">
					<span class="btnEliminar"></span>
					<span>Eliminar</span>
				</button>
				<button title="Imprimir" class="" name="imprimir">
					<div class="btnImprimir"></div>
					<span>Imprimir</span>
				</button>				
		</div>
		<ul style="display:inline-block;">
			<li></li>			
				
				
			 
			 <li>				
				<span class="tbFecha">										
					<input type='text' name='fecha' class="txtFechaI"  />
					<span class="ui-button-text">Fecha Inicial</span>
					<input type="checkbox" id="<?php echo $tabId; ?>_chkOmitirFI"></input><label for="<?php echo $tabId; ?>_chkOmitirFI" name="omitirFI" title="Bold" class="">Omitir</label>
					<br/>
				</span>
				
				<span class="tbFecha">										
					<input type='text' name='fecha' class="txtFechaF"  />
					<span class="ui-button-text">Fecha Final</span>
					<input type="checkbox" id="<?php echo $tabId; ?>_chkOmitirFF"></input><label for="<?php echo $tabId; ?>_chkOmitirFF" name="omitirFF" title="Bold" class="">Omitir</label>
					<br/>
				</span>
			
				<span class="tbFecha">										
					<input type='text' name='vencimiento' class="txtVencimiento"  />
					<span class="ui-button-text">Vencimiento</span>
					<input type="checkbox" id="<?php echo $tabId; ?>_chkOmitirFV"></input><label for="<?php echo $tabId; ?>_chkOmitirFV" name="omitirFV" title="Bold" class="">Omitir</label>
					<br/>
				</span>	
			</li>
			<li>
				<span class="cmbAlmacenW">
					<select class="cmbAlmacen">
						<?php 
						echo '<option value="0">--todos--</option>';
						foreach($this->almacenes as $almacen){
							echo '<option value="'.$almacen['id'].'">'.$almacen['nombre'].'</option>';
						}
						?>						
						
						
					</select>
					<br />
					<span class="ui-button-text">Almac&eacute;n</span><br/>
				</span>
			</li>
			<li>
				<span class="cmbEstadoW">
					<select class="cmbEstado">
						<?php 
						echo '<option value="0">--todos--</option>';
						foreach($this->estados as $estado){
							echo '<option value="'.$estado['id'].'">'.$estado['nombre'].'</option>';
						}
						?>													
					</select>
					<br>
					<span class="ui-button-text">Estado</span><br/>
				</span>				
			</li>			
			 
			
			
				
			
				<button title="Refresh" class="" name="refresh" style="float:right;">
					<span class="btnRefresh"></span>
					<span>Actualizar</span>
				</button>		
			
		</ul>
	</div>
</div>
