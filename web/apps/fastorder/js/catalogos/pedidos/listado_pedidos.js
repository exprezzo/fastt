var ListaPedidos=function(){
	this.concentrar=function(){		
		var me=this;
		$.ajax({
			type: "POST",
			url: '/'+kore.modulo+'/'+me.controlador.nombre+'/concentrar'			
		}).done(function( response ) {
			
			var resp = eval('(' + response + ')');
			var msg= (resp.msg)? resp.msg : '';
			var title;
			
			if ( resp.success == true	){				
				var gridPedidos=$(me.tabId+" #lista_pedidos_internos");	
				gridPedidos.wijgrid('ensureControl', true);
				TabManager.add('/'+kore.modulo+'/orden_compra/index','Ordenes de Compra',1);								
			}else{
				icon= '/web/apps/fastorder/images/error.png';
				title= 'Error';					
				$.gritter.add({
					position: 'bottom-left',
					title:title,
					text: msg,
					image: icon,
					class_name: 'my-sticky-class'
				});
			}			
		});
	};
	this.nuevo=function(){
		TabManager.add('/'+kore.modulo+'/pedidoi/nuevo','Nuevo Pedido');
	};
	this.activate=function(){
		
		// $(this.tabId+' .txtFechaI').wijinputdate();
		
		$(this.tabId+" .cmbAlmacen").wijcombobox('repaint');
		$(this.tabId+" .cmbEstado").wijcombobox('repaint');
		
		
		$(this.tabId+" .tbPedido").removeClass('ui-tabs-hide');
		$(this.tabId+" .tbPedido  ~ .wijmo-wijribbon-panel").removeClass('ui-tabs-hide');
		// alert("activar");
		$(this.tabId+" .lista_de_pedidos").wijcombobox('doRefresh');
	}
	this.borrar=function(){
		if (this.selected==undefined) return false;
		var r=confirm("¿Eliminar el pedido?");
		if (r==true){
		  this.eliminar();
		}
	}
	this.init=function(tabId){
		this.controlador={
			nombre:'pedidoi'
		};
		this.omitirFI=false;
		this.omitirFF=false;
		this.omitirFV=false;
		
		tabId = '#' + tabId;
		this.tabId = tabId;
		var tab=$('div'+tabId);		
		
		tab.data('tabObj',this);
		
		$('div'+tabId).css('padding','0px 0 0 0');
		$('div'+tabId).css('margin-top','0px');
		$('div'+tabId).css('border','0 1px 1px 1px');
		tab.addClass('listaPedidos');
		
		var tab=$('a[href="'+tabId+'"]');
		tab.html('Pedidos Internos');
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
						me.nuevo();
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
							 $(me.tabId+' input.txtFechaI').css('color','transparent');
						}else{
						    $(me.tabId+' input.txtFechaI').css('color','');
						}
					break;
					case 'omitirFF':
						if (me.omitirFF){
								me.omitirFF=false;
						} else{
							me.omitirFF=true;
						}
						if (me.omitirFF){
							 $(me.tabId+' input.txtFechaF').css('color','transparent');
						}else{
						    $(me.tabId+' input.txtFechaF').css('color','');
						}
					break;
					case 'omitirFV':
						if (me.omitirFV){
								me.omitirFV=false;
						} else{
							me.omitirFV=true;
						}
						if (me.omitirFV){
							 $(me.tabId+' input.txtVencimiento').css('color','transparent');
						}else{
						    $(me.tabId+' input.txtVencimiento').css('color','');
						}
					break;
					case 'concentrar':						
						me.concentrar();
					break;
					default:
						$.gritter.add({
							position: 'bottom-left',
							title:cmd.commandName,
							text: "Acciones del toolbar en construcci&oacute;n: "+cmd.commandName,
							image: '/web/apps/fastorder/images/info.png',
							class_name: 'my-sticky-class'
						});
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
		var wh=$(window).height();
	//	return false;
		var offset = $(tabId + ' #lista_pedidos_internos').offset();
		
		
				
		var altoHeaderGrid = $(tabId + ' #lista_pedidos_internos thead > tr').height();
		
		altoHeaderGrid=37 //TODAVIA NO ESTA RENDEREADO
		var disponible = wh - (offset.top +altoHeaderGrid);
		
		
		
		nh=parseInt(disponible/altoHeaderGrid);
		
		//alert("offset.top: "+offset.top + " wh: " + wh + ' altoHeaderGrid: ' + altoHeaderGrid + 'disponible: ' + disponible);
		pageSize=nh -1;		
		//alert(pageSize);
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
			//alert("totalRows: "+totalRows);
			datasource.data = datasource.data.rows;
			datasource.data.totalRows = totalRows;
			dataReader.read(datasource);
		};				
		this.dataSource=dataSource;
		var gridPedidos=$(this.tabId+" #lista_pedidos_internos");

		// gridPedidos.wijgrid();
		var me=this;
		//alert("pageSize: "+pageSize);
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
				{dataKey: "idestado", headerText: "Estado",width:'12%',
					cellFormatter: function (args) {
                            if (args.row.type & $.wijmo.wijgrid.rowType.data) {
                                args.$container
                                    .css("text-align", "center")
                                    .empty()
                                    .append($("<div title='"+args.row.data.estado+"'></div><span style='background:none;vertical-align:middle;margin-left:6px;'>"+args.row.data.estado+"</div>") 
                                    .addClass('estado_pedido_'+args.row.data.idestado)); 
								//args.row.data.Cover
                                return true; 
                            } 
                        }  
				}, 
				{ dataKey: "serie",  headerText: "Serie Folio" },
				{dataKey: "nombreAlmacen", headerText: "Almac&eacute;n",width:'48%' }, 				
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
				icon='/web/apps/fastorder/images/yes.png';
				title= 'Success';				
				var gridPedidos=$(me.tabId+" #lista_pedidos_internos");				
				gridPedidos.wijgrid('ensureControl', true);  
			}else{
				icon= '/web/apps/fastorder/images/error.png';
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