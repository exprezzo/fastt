<script type="text/javascript">
	$(function () {
	
		
	});	
</script>
<style type="text/css">	
	.cmbAlmacenW .ui-icon{
		background-position:-65px -16px !important;
		background-image:url('http://cdn.wijmo.com/themes/rocket/images/ui-icons_00a6dd_256x240.png') !important;
	}
	
	.cmbAlmacenW .wijmo-wijinput-trigger {
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
		<ul>
			<li id="actiongroup">				
				<button title="Nuevo" class="" name="nuevo">
					<div class="btnNuevo"></div>
					<span>Nuevo</span>
				</button>				
				<button title="Editar" class="" name="editar">
					<div class="btnEditar"></div>
					<span>Editar</span>
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
			 <li>				
				<span class="tbFecha">										
					<input type='text' name='fecha' class="txtFechaI"  />
					<span class="ui-button-text">Fecha Inicial</span><br/>
				</span>
				<span class="tbFecha">										
					<input type='text' name='fecha' class="txtFechaF"  />
					<span class="ui-button-text">Fecha Final</span><br/>
				</span>
			</li>
			<li>
				<span class="cmbAlmacenW">
					<select class="cmbAlmacen">
						<?php 
						echo '<option value="0">--ninguno--</option>';
						foreach($this->almacenes as $almacen){
							echo '<option value="'.$almacen['id'].'">'.$almacen['nombre'].'</option>';
						}
						?>						
						<span class="ui-button-text">Almac&eacute;n</span><br/>
					</select>
				</span>
			</li>
			 <li>				
				<span class="tbFecha">										
					<input type='text' name='vencimiento' class="txtVencimiento"  />
					<span class="ui-button-text">Vencimiento</span><br/>
				</span>				
			</li>
			<li>			
				
			
				<button title="Refresh" class="" name="refresh">
					<div class="btnRefresh"></div>
					<span>Actualizar</span>
				</button>		
			 </li>
		</ul>
	</div>
</div>
