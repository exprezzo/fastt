<style type="text/css">
	form.frmPedidoi label{
		width:100px;
		display:inline-block;
	}
</style>

<script>	
	$( function(){
		var tabId="<?php echo $_REQUEST['tabId']; ?>";
		var pedidoId=<?php echo $_REQUEST['pedidoId']; ?>;
		var almacen="<?php echo isset($this->pedido)?  $this->pedido['nombreAlmacen'] : ''; ?>";
		
		var objId='pedidoi_id_'+pedidoId;
		
		//Titulo
		if (pedidoId>0){					
			$('a[href="'+tabId+'"]').html('Pedido '+almacen+' ID: '+pedidoId);		
		}else{
			$('a[href="'+tabId+'"]').html('Nuevo Pedido');		
		}
		
		//Id, del objeto
		$('#tabs '+tabId).attr('objId',objId);		
		
		//Grid Articulos		
		$('#tabs '+tabId+" .grid_articulos").wijgrid({
			dynamic: true,
			allowColSizing:true,
			allowEditing:true,
			allowKeyboardNavigation:true,
			allowPaging: true
		});
		
		$('#tabs '+tabId+' .txtFecha').wijinputdate({ dateFormat: 'd/M/yyyy', showTrigger: true});
		
		$('#tabs '+tabId+' .btnGuardar')
		.button()
		.click(function () {				
			var tab = $('#tabs '+tabId);
			//Obtiene los datos de las cajas de texto.
			
			var pedido={
				id		: tab.find('.txtId').val(),
				almacen	: tab.find('.txtFkAlmacen').val(),
				fecha	: tab.find('.txtFecha').val()
			};
			
			//Envia los datos al servidor, el servidor responde success true o false.
			
			$.ajax({
				type: "POST",
				url: '/pedidoi/guardar',
				data: { pedido: pedido}
			}).done(function( response ) {
				
				var resp = eval('(' + response + ')');
				var msg= (resp.msg)? resp.msg : '';
				var title;
				if ( resp.success == true	){
					icon='/images/yes.png';
					title= 'Success';
					
					tab.find('.txtId').val(resp.datos.id),
					tab.find('.txtFkAlmacen').val(resp.datos.fk_almacen),
					tab.find('.txtFecha').wijinputdate('option','date', resp.datos.fecha); 
					
					
				}else{
					icon= '/images/error.png';
					title= 'Error';					
				}
				
				//cuando es true, envia tambien los datos guardados.
				//actualiza los valores del formulario.
				$.gritter.add({
					position: 'bottom-left',
					title:title,
					text: msg,
					image: icon,
					class_name: 'my-sticky-class'
				});
			});
		}); 
		$('#tabs '+tabId+' .btnNuevo')
		.button()
		.click(function () {				
			TabManager.add('/pedidoi/nuevoPedido', 'Nuevo Pedido');
		});
		
		$('#tabs '+tabId+' .btnEliminar')
		.button()
		.click(function () {				
			var msg='Todavia no se implementa';
			var icon='/images/error.png';
			var title='Error';
	
			$.gritter.add({
				position: 'bottom-left',
				title:title,
				text: msg,
				image: icon,
				class_name: 'my-sticky-class'
			});
		});
		
		//$('#tabs '+tabId+' .cmbAlmacen').wijdropdown();
		var fields=[{
			name: 'label',
			mapping: function (item) {
				return item.label;
			}
		}, {
			name: 'value',
			mapping: 'label'
		}, {
			name: 'selected',
			defaultValue: false
		},{name:'id'}];
		
		var myReader = new wijarrayreader(fields);
		
		var proxy = new wijhttpproxy({
			url: "/pedidoi/getAlmacenes",
			dataType:"json"			
		});

		var datasource = new wijdatasource({
			reader:  new wijarrayreader(fields),
			proxy: proxy,
			loaded: function (data) {				
				var val=$('#tabs '+tabId+' .txtFkAlmacen').val();
				$.each(data.items, function(index, datos) {					
					if (parseInt(val)==parseInt(datos.id) ){						
						$('#tabs '+tabId+' .cmbAlmacen').wijcombobox({selectedIndex:index});
					}
				});				
			}
		});
		
		datasource.reader.read= function (datasource) {			
			var totalRows=datasource.data.totalRows;			
			datasource.data = datasource.data.rows;
			datasource.data.totalRows = totalRows;
			myReader.read(datasource);
		};	
		
		
		
		var combo=$('#tabs '+tabId+' .cmbAlmacen').wijcombobox({
			data: datasource,
			showTrigger: true,			
			search: function (e, obj) {
				//obj.datasrc.proxy.options.data.name_startsWith = obj.term.value;
			},
			select: function (e, item) {				
				$('#tabs '+tabId+' .txtFkAlmacen').val(item.id);				
			}
		});
		datasource.load();		
	});
</script>
<div >
	<button class='btnGuardar'>Guardar</button>
	<button class='btnEliminar'>Eliminar</button>
	<button class='btnNuevo'>Nuevo</button>
</div>
<br /><br />
<?php
	$fecha= isset($this->pedido)? $this->pedido['fecha'] : ''; 
	$nombreAlmacen= isset($this->pedido)? $this->pedido['nombreAlmacen'] : ''; 
	$fk_almacen= isset($this->pedido)? $this->pedido['fk_almacen'] : ''; 	
	$id= isset($this->pedido)? $this->pedido['id'] : 0; 	
?>
<form class='frmPedidoi'>	
	<input type='hidden' name='id' class="txtId" value="<?php echo $id; ?>" />	
	<label >Fecha:</label>
	<input type='text' name='fecha' class="txtFecha" value="<?php echo $fecha; ?>" /><br/>	
	<br/>		
	<input type='hidden' name='fecha' class="txtFkAlmacen" value="<?php echo $fk_almacen; ?>" />
	<label>Almacen:</label>
	<select class="cmbAlmacen" style='width:170px;'>		
	</select>
	<!--input type='text' name='fecha' value="<?php //echo $nombreAlmacen; ?>" /-->
	<br />	
</form>
<button class="btnAdd" value="Agregar" />
<div style='background-color:white; padding:2px;'>
<table class="grid_articulos">
	<thead>
		<th>Producto</th> 
		<th>Cantidad</th>
	</thead>
  <tbody>
	<tr><td></td> <td></td></tr>
	<?php 
		if ( isset($this->pedido) )
		foreach($this->pedido['articulos'] as $articulo){			
			echo '<tr><td>'.$articulo['nombreProducto'].'</td> <td>'.$articulo['cantidad'].'</td></tr>';
		}
	?>
    
  </tbody>
</table>
</div>