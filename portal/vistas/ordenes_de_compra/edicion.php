
<script src="/web/<?php echo $_PETICION->modulo; ?>/js/catalogos/<?php echo $_PETICION->controlador; ?>/edicion.js"></script>
<script src="/web/<?php echo $_PETICION->modulo; ?>/js/catalogos/<?php echo $_PETICION->controlador; ?>/detalles.js"></script>
<style type="text/css">
	.frmPedido .inputBox{display:inline-block !important; }
	.frmOrdenCompra .wijmo-wijgrid-innercell{
		padding-left:0 !important;
	}
	
	.tabOrdenCompra .pnlIzq > div{
		float:right;		
	}
	
	.tabOrdenCompra .pnlIzq > form{
		float:left;
		padding-top:0;
	}
	
	
	tr[grupo_editable="true"] td{
		background-color:black;
		color:white;
	}
	
	tr[singrupo="true"] td, tr[nuevo="true"] td{
		/*background-color:blue;
		color:white;*/
		font-weight:bold !important;
	}
	
	tr[singrupo="true"] td:nth-child(2), tr[singrupo="true"] td:nth-child(3), tr[singrupo="true"] td:nth-child(4), tr[singrupo="true"] td:nth-child(5), tr[singrupo="true"] td:nth-child(6), tr[singrupo="true"] td:nth-child(7), tr[singrupo="true"] td:nth-child(8){
		color:transparent; 
	}
	
	/* tr[arial-level="1"] td:nth-child(2),tr[arial-level="1"] td:nth-child(3), tr[arial-level="1"] td:nth-child(4), tr[arial-level="1"] td:nth-child(5){		
		color:white !important;
	}
	*/
	
	 tr[arial-level="1"] td{		
		color:white !important;
		border:none !important;
	}
	
	
	.divLabel {vertical-align:bottom;text-alignt:right; text-align:right; display:inline-block;}
.divNumerosStock ul{padding:0;margin:0;}
.divNumerosStock li{display:inline ;padding:0;margin:0;}
.stock_numbers li{display:inline;}

	.frmEditInlinePedido input[readonly="true"]{
		border:none !important;
		text-align:right;
	}
	.frmEditInlinePedido input{
		text-align:right;
	}
	@media screen and (max-width:1280px) { 
		
	}
	
	@media screen and (min-width:1250px) { 
		/* .divNumerosStock li:not(:first-child):before, .stock_numbers li:not(:first-child):before
		{ 
		content:", ";
		} */
		
		.stock_numbers li
		{ 
			border:1px solid;
			border-left:0;
			border-color:gray;
			padding:10px 8px 10px 8px;
		}		
		.stock_numbers li:last-child{
			border-right:0;
		}
		
		.divNumerosStock ul{margin-top:5px;}
		.divNumerosStock li{
			border:1px solid;
			border-left:0;
			border-color:gray;
			padding:10px 8px 10px 8px;
			
		}
		
		.divNumerosStock li:first-child{
			border-left:1px solid;
		}
		
	}
	@media screen and (max-width:1250px) { 
		.divNumerosStock li{display:block;padding:0;margin-right:10px;}
		.stock_numbers li{display:block;}

	}
	.txt_fecha{
		padding:5px;
	}
	.txt_vencimiento {
		padding:3px;
	}
</style>

<script>
	<?php if ( !isset($this->detalles) ) $this->detalles=array(); ?>
			
	$( function(){	
		
		
		var articulos=<?php echo json_encode($this->detalles); ?>;		
		
		var config={
			tab:{
				id:'<?php echo $_REQUEST['tabId']; ?>'
			},
			controlador:{
				nombre:'<?php echo $_PETICION->controlador; ?>'
			},
			catalogo:{
				nombre:'Orden_de_compra'
			},
			articulos:articulos,
			id:'<?php echo $_REQUEST['id']; ?>'
			
		};				
		
		// console.log(config);
		var editor=new Edicionordenes_de_compra();
		editor.init(config);	

		var lista=new Busquedadetalle_de_la_orden();
		lista.init(config);
	});
</script>

	<div class="pnlIzq">
		<?php 	
			global $_PETICION;
			$this->mostrar('/'.$_PETICION->controlador.'/toolbar_edicion');	
			if (!isset($this->datos)){		
				$this->datos=array();		
			}
		?>
		
		<form class="frmEdicion" style="padding-top:10px;">	
			<input type="hidden" name="id" class="txtId" value="<?php echo $this->datos['id']; ?>" />				
			<div style="display:inline-block;">
				<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
					<label style="">Almac&eacute;n:</label>
					<select name="fk_almacen" style="width:95px;">
						<?php foreach($this->almacenes as $obj){
							$selected= ($obj['id'] == $this->datos['fk_almacen'])? 'selected' : '';
							echo '<option '.$selected.' value="'.$obj['id'].'">'.$obj['nombre'].'</option>';
						}
						?>					
					</select>			
				</div>
				<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
					<label style="">Serie:</label>
					<input type="hidden" name="fk_serie" value="<?php echo $this->datos['fk_serie']; ?>" />
					<select name="cmb_serie" style="width:95px;">
						<?php 
						if ( empty($this->datos['fk_serie']) ) {
							$this->series=array();
							$this->datos['folio']='';
						}						
						foreach($this->series as $obj){
							$selected= ($obj['id'] == $this->datos['fk_serie'])? 'selected' : '';
							echo '<option '.$selected.' value="'.$obj['id'].'">'.$obj['serie'].'</option>';
						}
						?>					
					</select>			
				</div>
				<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
					<label style="">folio:</label>
					<input type="text" name="folio" class="txt_folio" value="<?php echo $this->datos['folio']; ?>" style="width:20px;" />
				</div>
								
			</div>
			<div style="display:inline-block;vertical-align:top;">
				<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
					<label style="">Proveedor:</label>
					<select name="idproveedor">
						<?php foreach($this->proveedores as $prov){
							$selected= ($prov['id'] == $this->datos['idproveedor'])? 'selected' : '';
							echo '<option '.$selected.' value="'.$prov['id'].'">'.$prov['nombre'].'</option>';
						}
						?>					
					</select>				
				</div>
				<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
					<label style="">fecha:</label>
					<input type="text" name="fecha" class="txt_fecha" value="<?php echo $this->datos['fecha']; ?>" style="width:120px;" />
				</div>
				<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
					<label style="">vencimiento:</label>
					<input type="text" name="vencimiento" class="txt_vencimiento" value="<?php echo $this->datos['vencimiento']; ?>" style="width:120px;" />
				</div>
				<!--div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
					<label style="">Estado:</label>					
					<select name="idestado">
						<?php 
							// foreach($this->estados as $obj){
								// $selected= ($obj['id'] == $this->datos['idestado'])? 'selected' : '';
								// echo '<option '.$selected.' value="'.$obj['id'].'">'.$obj['nombre'].'</option>';
							// }
						?>					
					</select>
				</div-->
			</div>
		</form>
		<div >	
			<table class="grid_busqueda">
					<thead>
						<th>id</th>								
					</thead>  	 
					<tbody>			
					</tbody>
				</table>
		</div>

	</div>
</div>
