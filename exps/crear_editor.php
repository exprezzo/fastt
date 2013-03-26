<?php
function crear_editor($nombreControlador, $nombreModelo){
	$ruta='..//apps/fastorder/vistas/'.$nombreControlador.'/';	
	
$contenido='
<script src="/web/apps/<?php echo $_PETICION->modulo; ?>/js/catalogos/<?php echo $_PETICION->controlador; ?>/edicion.js"></script>

<script>			
	$( function(){		
		var config={
			tab:{
				id:\'<?php echo $_REQUEST[\'tabId\']; ?>\'
			},
			controlador:{
				nombre:\'<?php echo $_PETICION->controlador; ?>\'
			},
			catalogo:{
				nombre:\''. $nombreModelo.'\'
			}
			
		};				
		 var editor=new Edicion'. $nombreControlador.'();
		 editor.init(config);		
	});
</script>

	<div class="pnlIzq">
		<?php 	
			global $_PETICION;
			$this->mostrar(\'/componentes/toolbar\');	
			if (!isset($this->datos)){		
				$this->datos=array();		
			}
		?>
		
		<form class="frmEdicion" style="padding-top:10px;">	
			<input type="hidden" name="id" class="txtId" value="<?php echo $this->datos[\'id\']; ?>" />	
			<?php
				foreach($this->datos as $key=>$value){
					if ($key=="id") continue;
			?>
					<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;" autoFocus >
						<label style=""><?php echo $key; ?>:</label>
						<input type="text" name="<?php echo $key; ?>" class="txt_<?php echo $key; ?>" value="<?php echo $value; ?>" style="width:500px;" />
					</div>
			<?php	}
			?>
	</div>
</div>
';
	
	
	$rutaCompleta=$ruta.'edicion.php';	
	if ( file_exists($rutaCompleta) ){
		// echo 'El archivo '.$rutaCompleta.' ya existe;<br/> ';
		return array(
			'success'=>false,
			'msg'=>'El archivo '.$rutaCompleta.' ya existe;<br/> '
		);
	}else{
		file_put_contents($rutaCompleta, $contenido);
		if ( file_exists($rutaCompleta) ){
			// echo 'archivo creado: '.$rutaCompleta.' ;<br/> ';
			return array(
				'success'=>true,
				'msg'=>'archivo creado: '.$rutaCompleta.' ;<br/> '
			);
		}else{
			// echo 'el archivo no pudo crearse: '.$rutaCompleta.'<br/> ';
			return array(
				'success'=>false,
				'msg'=>'el archivo no pudo crearse: '.$rutaCompleta.'<br/> '
			);
		}
		
	}
	
}
?>