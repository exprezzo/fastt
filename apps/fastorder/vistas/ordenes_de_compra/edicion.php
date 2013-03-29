
<script src="/web/apps/<?php echo $_PETICION->modulo; ?>/js/catalogos/<?php echo $_PETICION->controlador; ?>/edicion.js"></script>
<script src="/web/apps/<?php echo $_PETICION->modulo; ?>/js/catalogos/<?php echo $_PETICION->controlador; ?>/detalles.js"></script>
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
	
</style>

<script>			
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
			$this->mostrar('/componentes/toolbar_edicion_maestro_detalle');	
			if (!isset($this->datos)){		
				$this->datos=array();		
			}
		?>
		
		<form class="frmEdicion" style="padding-top:10px;">	
			<input type="hidden" name="id" class="txtId" value="<?php echo $this->datos['id']; ?>" />	
			<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;" autoFocus >
			<label style="">idproveedor:</label>
			<input type="text" name="idproveedor" class="txt_idproveedor" value="<?php echo $this->datos['idproveedor']; ?>" style="width:500px;" />
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
		</div><div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;" autoFocus >
			<label style="">fk_almacen:</label>
			<input type="text" name="fk_almacen" class="txt_fk_almacen" value="<?php echo $this->datos['fk_almacen']; ?>" style="width:500px;" />
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
