var ListaPedidos=function(){
	this.init=function(tabId){
		this.omitirFI=false;
		this.omitirFF=false;
		this.omitirFV=false;
		
		tabId = '#' + tabId;
		this.tabId = tabId;
		var tab=$('div'+tabId);		
		
		$('div'+tabId).css('padding','0px 0 0 0');
		$('div'+tabId).css('margin-top','0px');
		$('div'+tabId).css('border','0 1px 1px 1px');
		tab.addClass('listaPedidos');
		
		var tab=$('a[href="'+tabId+'"]');
		tab.html('Pedidos');
		tab.parent().addClass('listaPedidos');
		tab.addClass('listaPedidos');
		
		this.configurarToolbar(tabId);		
		this.configurarGrid(tabId);
	};
	this.configurarToolbar=function(tabId){
		var me=this;
		
		$(this.tabId+' .cmbAlmacen').wijcombobox({});
		$(this.tabId+' .cmbEstado').wijcombobox({});
		
		
		
		$(tabId+ " > .tbPedidos").wijribbon({
			click: function (e, cmd) {
				switch(cmd.commandName){
					case 'nuevo':
						TabManager.add('/'+kore.modulo+'/pedidoi/nuevo','Nuevo Pedido');				
					break;
					case 'editar':
						if (me.selected!=undefined){													
							TabManager.add('/'+kore.modulo+'/pedidoi/getPedido','Editar Pedido',me.selected.id);
						}
					break;
					case 'eliminar':
						if (me.selected==undefined) return false;
						var r=confirm("¿Eliminar el pedido?");
						if (r==true){
						  me.eliminar();
						}
					break;
					case 'refresh':
						
						var gridPedidos=$(me.tabId+" #lista_pedidos_internos");
						gridPedidos.wijgrid('ensureControl', true);
					break;
					case 'omitirFI':
						if (me.omitirFI){
								me.omitirFI=false;
						} else{
							me.omitirFI=true;
						}
						if (me.omitirFI){
							 $(me.tabId+' input.txtFechaI').css('color','white');
						}else{
						    $(me.tabId+' input.txtFechaI').css('color','black');
						}
					break;
					case 'omitirFF':
						if (me.omitirFF){
								me.omitirFF=false;
						} else{
							me.omitirFF=true;
						}
						if (me.omitirFF){
							 $(me.tabId+' input.txtFechaF').css('color','white');
						}else{
						    $(me.tabId+' input.txtFechaF').css('color','black');
						}
					break;
					case 'omitirFV':
						if (me.omitirFV){
								me.omitirFV=false;
						} else{
							me.omitirFV=true;
						}
						if (me.omitirFV){
							 $(me.tabId+' input.txtVencimiento').css('color','white');
						}else{
						    $(me.tabId+' input.txtVencimiento').css('color','black');
						}
					break;
					
					
					default:
						 
						// this.omitirFI=false;
						// this.omitirFF=false;
						// this.omitirFV=false;
						$.gritter.add({
							position: 'bottom-left',
							title:cmd.commandName,
							text: "Acciones del toolbar en construcci&oacute;n",
							image: '/web/apps/fastorder/images/info.png',
							class_name: 'my-sticky-class'
						});
						console.log("cmd"	); console.log(cmd);
					break;
					case 'imprimir':
						alert("Imprimir en construcción");						
					break;
				}
				
			}
		});
		var fecha=new Date();
		$('#tabs '+tabId+' .txtFechaI').wijinputdate({ dateFormat: 'd/M/yyyy', showTrigger: true, date: new Date()});	
		$('#tabs '+tabId+' .txtFechaF').wijinputdate({ dateFormat: 'd/M/yyyy', showTrigger: true, date: new Date()}); //fecha.getFullYear()	+'-'+fecha.getMonth()+1+'-'+fecha.getUTCDate() });	
		$('#tabs '+tabId+' .txtVencimiento').wijinputdate({ dateFormat: 'd/M/yyyy', showTrigger: true, date: new Date()});	
	};
	this.configurarGrid=function(tabId){
		var pageSize=10;
		var hContainer = $('#tabs').height();

		var hNav= $('#tabs .ui-tabs-nav').height();

		var newH = hContainer-hNav;
		var altoHeaderGrid = 38;

		newH=newH - (2*altoHeaderGrid);
		newH=parseInt(newH/altoHeaderGrid);
		pageSize=newH-1;		

		//var totalRows=<?php //echo isset($this->total)?$this->total: 0 ?>;
		var campos=[
			{ name: "id"  },
			{ name: "fecha"},
			{ name: "vencimiento"},
			{ name: "nombreAlmacen"},
			{ name: 'idestado'},
			{ name: 'estado'},
			{ name: 'serie'}
		];
		var dataReader = new wijarrayreader(campos);

		var dataSource = new wijdatasource({
			proxy: new wijhttpproxy({
				url: '/'+kore.modulo+'/pedidoi/paginar',
				dataType: "json"
			}),
			dynamic:true,			
			reader:new wijarrayreader(campos)
		});
		dataSource.reader.read= function (datasource) {
			
			var totalRows=datasource.data.totalRows;			
			datasource.data = datasource.data.rows;
			datasource.data.totalRows = totalRows;
			dataReader.read(datasource);
		};				
		this.dataSource=dataSource;
		var gridPedidos=$("#lista_pedidos_internos");

		// gridPedidos.wijgrid();
		var me=this;
		gridPedidos.wijgrid({
			dynamic: true,
			allowColSizing:true,
			//allowEditing:false,
			allowKeyboardNavigation:true,
			allowPaging: true,
			pageSize:pageSize,
			selectionMode:'singleRow',
			data:dataSource,
			columns: [ 
				{ dataKey: "id", hidden:true, visible:false, headerText: "ID" },								
				{ dataKey: "estado", hidden:true, visible:false, headerText: "estado" },								
				{dataKey: "idestado", headerText: "Estado",width:'20px',
					cellFormatter: function (args) { 
                            if (args.row.type & $.wijmo.wijgrid.rowType.data) { 
                                args.$container 
                                    .css("text-align", "center") 
                                    .empty() 
                                    .append($("<div title='"+args.row.data.estado+"'/>") 
                                    .addClass('estado_pedido_'+args.row.data.idestado)); 
								//args.row.data.Cover
                                return true; 
                            } 
                        }  
				}, 
				{ dataKey: "serie",  headerText: "Serie" },
				{dataKey: "nombreAlmacen", headerText: "Almac&eacute;n",width:'60%' }, 				
				{dataKey: "fecha", headerText: "Fecha",width:'20%' },
				{dataKey: "vencimiento", headerText: "Vencimiento",width:'20%' }
				],
			rowStyleFormatter: function(args) {
				if (args.dataRowIndex>-1)
					args.$rows.attr('pedidoId',args.data.id);
			},
			loading: function (dataSource, userData) {                            
				var fi=$('#tabs '+me.tabId+' .txtFechaI').val();	
				var ff=$('#tabs '+me.tabId+' .txtFechaF').val();			
				var fv = $('#tabs '+me.tabId+' .txtVencimiento').val();			
				var idalmacen = $('#tabs '+me.tabId+' .cmbAlmacen').wijcombobox('option','selectedValue');
				var idestado = $('#tabs '+me.tabId+' .cmbEstado').wijcombobox('option','selectedValue');
                me.dataSource.proxy.options.data={idalmacen:idalmacen, idestado:idestado};
				
				if ( !me.omitirFI) me.dataSource.proxy.options.data.fechai=fi;
				if ( !me.omitirFF) me.dataSource.proxy.options.data.fechaf=ff;
				if ( !me.omitirFV) me.dataSource.proxy.options.data.vencimiento=fv;				
            },
			cellStyleFormatter: function(args) { 
				if (args.column._originalDataKey=='fecha' || args.column._originalDataKey=='vencimiento'){
					// console.log(args);		
					args.$cell.addClass("colFecha");
				}			 
			} 
		});
		
		var me=this;
		
		gridPedidos.wijgrid({ selectionChanged: function (e, args) { 					
			var item=args.addedCells.item(0);
			var row=item.row();
			var data=row.data;			
			me.selected=data;			
		} });
		
		gridPedidos.wijgrid({ loaded: function (e) { 
			$('#lista_pedidos_internos tr').bind('dblclick', function (e) { 			
				var pedidoId=$(e.currentTarget).attr('pedidoId');
				if (pedidoId==undefined || pedidoId=='' || pedidoId==0) return false;				
				TabManager.add('/'+kore.modulo+'/pedidoi/getPedido','Editar Pedido',pedidoId);				
			});			
		} });
	};
}
ListaPedidos.prototype.eliminar=function(){
	
	var id = this.selected.id;
	var me=this;
	$.ajax({
			type: "POST",
			url: '/'+kore.modulo+'/pedidoi/eliminar',
			data: { id: id}
		}).done(function( response ) {		
			var resp = eval('(' + response + ')');
			var msg= (resp.msg)? resp.msg : '';
			var title;
			if ( resp.success == true	){
				icon='/images/yes.png';
				title= 'Success';				
				var gridPedidos=$(me.tabId+" #lista_pedidos_internos");				
				gridPedidos.wijgrid('ensureControl', true);  
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
}