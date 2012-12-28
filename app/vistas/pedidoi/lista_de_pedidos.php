<style type="text/css">
	
</style>
<script>
	
	$( function(){
		
		
		var tabId="<?php echo $_REQUEST['tabId']; ?>";		
		$('div'+tabId).css('padding','4px 0 0 0');
		$('div'+tabId).css('border','0 1px 1px 1px');
		
		var tab=$('a[href="'+tabId+'"]');
		tab.html('Pedidos');
		tab.addClass('listaPedidos');		
		
		var pageSize=10;
		var hContainer = $('#tabs').height();
		
		var hNav= $('#tabs .ui-tabs-nav').height();
		
		var newH = hContainer-hNav;
		var altoHeaderGrid = 38;
		
		newH=newH - (2*altoHeaderGrid);
		newH=newH/altoHeaderGrid;
		pageSize=newH;		
		
		var totalRows=<?php echo isset($this->total)?$this->total: 0 ?>;
		var dataReader = new wijarrayreader([
			{ name: "id"},
			{ name: "fecha"},
			{ name: "nombreAlmacen"}
		]);

		var dataSource = new wijdatasource({
			proxy: new wijhttpproxy({
				url: "/pedidoi/paginar",
				dataType: "json"				
			}),
			dynamic:true,			
			reader:new wijarrayreader([
				 { name: "id"},
				 { name: "fecha"},
				 { name: "nombreAlmacen"}
			])							
		});
		dataSource.reader.read= function (datasource) {
			
			var totalRows=datasource.data.totalRows;			
			datasource.data = datasource.data.rows;
			datasource.data.totalRows = totalRows;
			dataReader.read(datasource);
		};				
			
		var gridPedidos=$("#lista_pedidos_internos");
		gridPedidos.wijgrid({
			dynamic: true,
			allowColSizing:true,
			//allowEditing:false,
			allowKeyboardNavigation:true,
			allowPaging: true,
			pageSize:pageSize,
			selectionMode:'singleRow',
			data:dataSource,
			columns: [ { dataKey: "id", hidden:true, visible:false, headerText: "ID" },{dataKey: "nombreAlmacen", headerText: "Almacén" }, {dataKey: "fecha", headerText: "Fecha" } ],
			rowStyleFormatter: function(args) {
				if (args.dataRowIndex>-1)
					args.$rows.attr('pedidoId',args.data.id);
			}
		});
		gridPedidos.wijgrid({ loaded: function (e) { 
			$('#lista_pedidos_internos tr').bind('click', function (e) { 
			
				var pedidoId=$(e.currentTarget).attr('pedidoId');
				var objId='pedidoi_id_'+pedidoId;
				
				var tab=$("div[objId="+objId+"]");		
							
				 if (tab.length>0){
					 var id=tab.attr('id');			
					 
					
					 TabManager.tabs.wijtabs('select',id);
					 return false;
				 }
				 
				if (pedidoId==undefined || pedidoId=='' || pedidoId==0) return false;
				var url='/pedidoi/getPedido';
				var titulo='Editar Pedido';
				TabManager.add(url,titulo,pedidoId);
				
				
				
			});
			// var h=$(window).height();		
				// var h2=$('.btnNuevoPedido').height();			
				// var newH = h;			
				// alert(newH);
				//$('.listaPedidos').css('min-height',newH);
		} });
		
		
	});
</script>

<div style="">	
	<table id="lista_pedidos_internos">
		<thead>
			<th>id</th>		
			<th>Almacén</th>		
			<th>Fecha</th> 		
		</thead>  	 
		<tbody>
			<?php foreach($this->pedidos as $pedido ){
			//	echo '<tr><td>'.$pedido['id'].'</td><td>'.$pedido['nombreAlmacen'].'</td> <td>'.$pedido['fecha'].'</td></tr>';
			}
			?>		
		</tbody>
	</table>
</div>
</div>