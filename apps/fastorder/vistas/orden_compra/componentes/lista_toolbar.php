<style type="text/css">	
	.cmbProveedorW .ui-icon, .cmbEstadoW .ui-icon{
		background-position:-65px -16px !important;
		background-image:url('http://cdn.wijmo.com/themes/rocket/images/ui-icons_00a6dd_256x240.png') !important;
	}
	
	.cmbProveedorW .wijmo-wijinput-trigger, .cmbEstadoW .wijmo-wijinput-trigger{
		background: transparent;
		border: 0;
	}
	.crud_tb li{
		display:inline-block !important;
	}
	.crud_tb span{
		text-align:center !important;
	}
	.cmbProveedorW input, .cmbEstadoW input{height:19px;}
</style>

<?php $tabId=$_REQUEST['tabId']; ?>

<div class="ribbon lista_toolbar ">
	<ul>
		 <li><a href="#tbPedido_<?php echo $tabId; ?>">Format</a></li>		 
	</ul>
	<div id="tbPedido_<?php echo $tabId; ?>" class="tbPedido">
		<div style="vertical-align:top;"> 
			<div  style="display:inline-block;margin-bottom:10px;">
				<div title="Acciones" class="wijmo-wijribbon-dropdownbutton">
					<button title="Font Name" name="acciones">Acciones</button>
					<ul class ="crud_tb">
						<li >
							<button title="Nuevo" class="" name="nuevo">
									<span class="btnNuevo"></span>
									<span>Nuevo</span>
							</button>				
						</li>
						<li>
							<button title="Editar" class="" name="editar">
								<span class="btnEditar"></span>
								<span>Editar</span>
							</button>
						</li>
						<li>
							<button title="Eliminar" class="" name="eliminar">
								<span class="btnEliminar"></span>
								<span>Eliminar</span>
							</button>
						</li>
						<li>
							<button title="Imprimir" class="" name="imprimir">
								<div class="btnImprimir"></div>
								<span>Imprimir</span>
							</button>				
						</li>
					</ul>
				</div>			
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
				<!--div title="Acciones" class="wijmo-wijribbon-dropdownbutton">
					<button title="Font Name" name="acciones">mas</button>
					<ul class="li_combos">
						<li>
							<span class="cmbProveedorW" style="position:relative; display:inline-block;">
								<select class="cmbProveedor">
									<?php 
									// echo '<option value="0">--todos--</option>';
									// foreach($this->almacenes as $almacen){
										// echo '<option value="'.$almacen['id'].'">'.$almacen['nombre'].'</option>';
									// }
									?>						
									
									
								</select>
								<br />
								<span class="ui-button-text">Almac&eacute;n</span><br/>
							</span>
						</li>
						<li>
							<span class="cmbEstadoW" style="display:inline-block;">
								<select class="cmbEstado">
									<?php 
									// echo '<option value="0">--todos--</option>';
									// foreach($this->estados as $estado){
										// echo '<option value="'.$estado['id'].'">'.$estado['nombre'].'</option>';
									// }
									?>													
								</select>
								<br>
								<span class="ui-button-text">Estado</span><br/>
							</span>	
						</li>
					</ul>
				</div-->
				<span class="cmbProveedorW" style="position:relative; display:inline-block;">
					<select class="cmbProveedor">
						<?php 
						echo '<option value="0">--todos--</option>';
						foreach($this->proveedores as $proveedor){
							echo '<option value="'.$proveedor['id'].'">'.$proveedor['nombre'].'</option>';
						}
						?>						
						
						
					</select>
					<br />
					<span class="ui-button-text">Proveedor</span><br/>
				</span>
				<span class="cmbEstadoW" style="display:inline-block;">
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
				
			</div>
			<button title="Refresh" class="" name="refresh" style="position:absolute;;right:0;">
				<span class="btnRefresh"></span>
				<span>Actualizar</span>
			</button>	
	</div>
</div>
