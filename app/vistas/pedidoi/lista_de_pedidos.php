<style type="text/css">
	.colFecha{
		text-align:right;
	}
</style>
<script>
	
	$( function(){
		
		var tabId="<?php echo $_REQUEST['tabId']; ?>";		
		$('div'+tabId).css('padding','0px 0 0 0');
		$('div'+tabId).css('margin-top','0px');
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
		newH=parseInt(newH/altoHeaderGrid);
		pageSize=newH-2;		
		
		//var totalRows=<?php //echo isset($this->total)?$this->total: 0 ?>;
		var dataReader = new wijarrayreader([
			{ name: "id"  },
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
		
		// gridPedidos.wijgrid();
		
		gridPedidos.wijgrid({
			dynamic: true,
			allowColSizing:true,
			//allowEditing:false,
			allowKeyboardNavigation:true,
			allowPaging: true,
			pageSize:pageSize,
			selectionMode:'singleRow',
			data:dataSource,
			columns: [ { dataKey: "id", hidden:true, visible:false, headerText: "ID" },{dataKey: "nombreAlmacen", headerText: "Almacén",width:'80%' }, {dataKey: "fecha", headerText: "Fecha",width:'20%' } ],
			rowStyleFormatter: function(args) {
				if (args.dataRowIndex>-1)
					args.$rows.attr('pedidoId',args.data.id);
			},
			cellStyleFormatter: function(args) { 
			 if (args.column._originalDataKey=='fecha'){
				// console.log(args);		
				 args.$cell.addClass("colFecha");
				
			 }
			
			} 
		});
		gridPedidos.wijgrid({ loaded: function (e) { 
			$('#lista_pedidos_internos tr').bind('click', function (e) { 			
				var pedidoId=$(e.currentTarget).attr('pedidoId');
				if (pedidoId==undefined || pedidoId=='' || pedidoId==0) return false;				
				TabManager.add('/pedidoi/getPedido','Editar Pedido',pedidoId);				
			});			
		} });
		
		
	});
</script>
<?php include_once('../app/vistas/pedidoi/lista_toolbar.php') ?>
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