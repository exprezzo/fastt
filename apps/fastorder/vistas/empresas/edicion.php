
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
				nombre:'Empresa'
			}
			
		};				
		 var editor=new Edicionempresas();
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
			<label style="">nombre:</label>
			<input type="text" name="nombre" class="txt_nombre" value="<?php echo $this->datos['nombre']; ?>" style="width:500px;" />
		</div>
		<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;" autoFocus >
			<label style="vertical-align:top;">telefonos:</label>			
			<textarea type="text" name="telefonos" class="txt_telefonos" value="" style="width:500px;" ><?php echo $this->datos['telefonos']; ?></textarea>
		</div>
		<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;" autoFocus >
			<label style="vertical-align:top;">direccion:</label>
			<textarea type="text" name="direccion" class="txt_direccion" value="" style="width:500px;" ><?php echo htmlentities($this->datos['direccion']); ?></textarea>
		</div>
		<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;" autoFocus >
			<label style="">sitio_web:</label>
			<input type="text" name="sitio_web" class="txt_sitio_web" value="<?php echo $this->datos['sitio_web']; ?>" style="width:500px;" />
		</div><div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;" autoFocus >
			<label style="">mas:</label>
			<input type="text" name="mas" class="txt_mas" value="<?php echo $this->datos['mas']; ?>" style="width:500px;" />
		</div>
	</div>
</div>
