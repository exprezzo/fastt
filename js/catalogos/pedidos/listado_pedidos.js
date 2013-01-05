var ListaPedidos={
	init:function(tabId){
		tabId = '#' + tabId;
		$('div'+tabId).css('padding','0px 0 0 0');
		$('div'+tabId).css('margin-top','0px');
		$('div'+tabId).css('border','0 1px 1px 1px');

		var tab=$('a[href="'+tabId+'"]');
		tab.html('Pedidos');
		tab.addClass('listaPedidos');
		this.configurarGrid(tabId);
		this.configurarToolbar(tabId);
		
	},
	configurarToolbar:function(tabId){
		$(tabId+ " > .tbPedidos").wijribbon({
			click: function (e, cmd) {
				switch(cmd.commandName){
					case 'nuevo':
						TabManager.add('/pedidoi/nuevo','Nuevo Pedido');				
					break;
					default:						
						$.gritter.add({
							position: 'bottom-left',
							title:"Informaci&oacute;n",
							text: "Acciones del toolbar en construcci&oacute;n",
							image: '/images/info.png',
							class_name: 'my-sticky-class'
						});
					break;
					case 'imprimir':
						alert("Imprimir");
					break;
				}
				
			}
		})
	},
	configurarGrid:function(tabId){
		var pageSize=10;
		var hContainer = $('#tabs').height();

		var hNav= $('#tabs .ui-tabs-nav').height();

		var newH = hContainer-hNav;
		var altoHeaderGrid = 38;

		newH=newH - (2*altoHeaderGrid);
		newH=parseInt(newH/altoHeaderGrid);
		pageSize=newH-1;		

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
			columns: [ { dataKey: "id", hidden:true, visible:false, headerText: "ID" },{dataKey: "nombreAlmacen", headerText: "Almac&eacute;n",width:'80%' }, {dataKey: "fecha", headerText: "Fecha",width:'20%' } ],
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
			$('#lista_pedidos_internos tr').bind('dblclick', function (e) { 			
				var pedidoId=$(e.currentTarget).attr('pedidoId');
				if (pedidoId==undefined || pedidoId=='' || pedidoId==0) return false;				
				TabManager.add('/pedidoi/getPedido','Editar Pedido',pedidoId);				
			});			
		} });
	}
}


