var ListaOrdenCompra=function(){
	
	this.eliminar=function(){
	
	var id = this.selected.id;
	var me=this;
	$.ajax({
			type: "POST",
			url: '/'+kore.modulo+'/'+this.controlador.nombre+'/eliminar',
			data: { id: id}
		}).done(function( response ) {		
			var resp = eval('(' + response + ')');
			var msg= (resp.msg)? resp.msg : '';
			var title;
			if ( resp.success == true	){
				icon='/web/apps/fastorder/images/yes.png';
				title= 'Success';				
				var gridPedidos=$(me.tabId+" .lista_orden_de_compra");				
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
	this.nuevo=function(){		
		TabManager.add('/'+kore.modulo+'/orden_compra/nuevo','Nueva Orden de Compra');
	};
	this.activate=function(){
		// vuelve a renderear estos elementos que presentaban problemas. (correccion de bug)
		$(this.tabId+" .cmbProveedor").wijcombobox('repaint');
		$(this.tabId+" .cmbEstado").wijcombobox('repaint');		
		$(this.tabId+" .tbPedido").removeClass('ui-tabs-hide');
		$(this.tabId+" .tbPedido  ~ .wijmo-wijribbon-panel").removeClass('ui-tabs-hide');		
		$(this.tabId+" .lista_de_pedidos").wijcombobox('doRefresh');
	}
	this.borrar=function(){
		if (this.selected==undefined) return false;
		var r=confirm("¿Eliminar Orden de Compra?");
		if (r==true){
		  this.eliminar();
		}
	}
	this.agregarClase=function(clase){
		var tabId=this.tabId;		
		var tab=$('div'+this.tabId);						
		tab.addClass(clase);		
		tab=$('a[href="'+tabId+'"]');
		tab.addClass(clase);
	}
	this.init=function(config){
		//-------------------------------------------Al nucleo		*/		
		this.controlador=config.controlador;
		this.catalogo=config.catalogo;
		//-------------------------------------------
		var tab=config.tab;		
		tabId = '#' + tab.id;
		this.tabId = tabId;
		var jTab=$('div'+tabId);				
		jTab.data('tabObj',this);		
		
		 // this.agregarClase('lista_'+this.controlador.nombre);
		var jTab=$('a[href="'+tabId+'"]');
	    jTab.html(this.catalogo.nombre);		 
		 jTab.addClass('lista_'+this.controlador.nombre);
		//-------------------------------------------
		$('div'+tabId).css('padding','0px 0 0 0');
		$('div'+tabId).css('margin-top','0px');
		$('div'+tabId).css('border','0 1px 1px 1px');
		//-------------------------------------------
		//Comportamiendo de los filtros de fecha
		this.omitirFI=false;
		this.omitirFF=false;
		this.omitirFV=false;
		//-------------------------------------------		
		this.configurarToolbar(tabId);		
		this.configurarGrid(tabId);
	};
	this.configurarToolbar=function(tabId){
		var me=this;
		
		$(this.tabId+' .cmbProveedor').wijcombobox({});
		$(this.tabId+' .cmbEstado').wijcombobox({});
		
		
		$(tabId+ " > .lista_toolbar").wijribbon({
			click: function (e, cmd) {
				switch(cmd.commandName){
					case 'nuevo':						
						me.nuevo();
					break;
					case 'editar':
						if (me.selected!=undefined){													
							TabManager.add('/'+kore.modulo+'/'+me.controlador.nombre+'/editar','Editar Orden de Compra', me.selected.id);
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
						
						var gridPedidos=$(me.tabId+" .lista_orden_de_compra");
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
					default:						 
						$.gritter.add({
							position: 'bottom-left',
							title:cmd.commandName,
							text: "Acciones del toolbar en construcci&oacute;n",
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
		//						Al nucleo
		var wh=$(window).height();	
		var offset = $(tabId + ' .lista_orden_de_compra').offset();		
		var altoHeaderGrid = $(tabId + ' .lista_orden_de_compra thead > tr').height();		
		altoHeaderGrid=37 //TODAVIA NO ESTA RENDEREADO
		var disponible = wh - (offset.top +altoHeaderGrid);		
		nh=parseInt(disponible/altoHeaderGrid);		
		pageSize=nh -1;		
		//-----------------------------------
		
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
	
		// console.log('this.controlador'); console.log(this.controlador);
		var dataSource = new wijdatasource({
			proxy: new wijhttpproxy({
				url: '/'+kore.modulo+'/'+this.controlador.nombre+'/paginar',
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
		var gridPedidos=$(".lista_orden_de_compra");

		// gridPedidos.wijgrid();
		var me=this;
		// alert("pageSize: "+pageSize);
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
				{dataKey: "nombreAlmacen", headerText: "Proveedor",width:'48%' },
				{dataKey: "fecha", headerText: "Fecha",width:'20%' },
				{dataKey: "vencimiento", headerText: "Vencimiento",width:'20%' }
			],
			rowStyleFormatter: function(args) {
				// console.log('args.$rows'); console.log(args.$rows);
				// if (args.dataRowIndex>-1)
					// args.$rows.attr('pedidoId',args.data.id);
			},
			loading: function (dataSource, userData) {
				var fi=$('#tabs '+me.tabId+' .txtFechaI').val();
				var ff=$('#tabs '+me.tabId+' .txtFechaF').val();
				var fv = $('#tabs '+me.tabId+' .txtVencimiento').val();
				var idproveedor = $('#tabs '+me.tabId+' .cmbProveedor').wijcombobox('option','selectedValue');
				var idestado = $('#tabs '+me.tabId+' .cmbEstado').wijcombobox('option','selectedValue');
                me.dataSource.proxy.options.data={idproveedor:idproveedor, idestado:idestado};
				
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
			$('.lista_orden_de_compra tr').bind('dblclick', function (e) { 			
				// var pedidoId=$(e.currentTarget).attr('pedidoId');
				// if (pedidoId==undefined || pedidoId=='' || pedidoId==0) return false;				
				console.log('me.selected'); console.log(me.selected);
				var pedidoId=me.selected.id;
				TabManager.add('/'+kore.modulo+'/'+me.controlador.nombre+'/editar','Editar '+me.catalogo.nombre,pedidoId);				
			});			
		} });
	};
}