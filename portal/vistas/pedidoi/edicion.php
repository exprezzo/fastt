
<script src="/web/<?php echo $_PETICION->modulo; ?>/js/catalogos/<?php echo $_PETICION->controlador; ?>/edicion.js"></script>

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
				nombre:'pedido_model'
			}
			
		};				
		 var editor=new Edicionpedidoi();
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
			<label style="">fk_almacen:</label>
			<input type="text" name="fk_almacen" class="txt_fk_almacen" value="<?php echo $this->datos['fk_almacen']; ?>" style="width:500px;" />
		</div><div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;" autoFocus >
			<label style="">fecha:</label>
			<input type="text" name="fecha" class="txt_fecha" value="<?php echo $this->datos['fecha']; ?>" style="width:500px;" />
		</div><div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;" autoFocus >
			<label style="">vencimiento:</label>
			<input type="text" name="vencimiento" class="txt_vencimiento" value="<?php echo $this->datos['vencimiento']; ?>" style="width:500px;" />
		</div><div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;" autoFocus >
			<label style="">idestado:</label>
			<input type="text" name="idestado" class="txt_idestado" value="<?php echo $this->datos['idestado']; ?>" style="width:500px;" />
		</div><div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;" autoFocus >
			<label style="">fk_serie:</label>
			<input type="text" name="fk_serie" class="txt_fk_serie" value="<?php echo $this->datos['fk_serie']; ?>" style="width:500px;" />
		</div><div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;" autoFocus >
			<label style="">folio:</label>
			<input type="text" name="folio" class="txt_folio" value="<?php echo $this->datos['folio']; ?>" style="width:500px;" />
		</div>
		</form>
	</div>
</div>
