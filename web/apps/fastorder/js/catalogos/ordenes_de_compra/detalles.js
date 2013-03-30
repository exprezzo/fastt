var Busquedadetalle_de_la_orden=function(){
	this.tituloNuevo='Nueva';
	this.configurarComboArticulo=function(target){
		
		var tabId=this.tabId;
		 
		var fields=[			
			{name: 'presentacion'},
			{name: 'idarticulopre'},
			{name: 'codigo'},
			{name: 'existencia'},
			{name: 'minimo'},
			{name: 'maximo'},
			{name: 'puntoreorden'},
			{name: 'nombre_almacen'},
		{
			name: 'label',
			mapping: 'nombre'
		}, {
			name: 'value',
			mapping: 'id'
		}, {
			name: 'selected',
			defaultValue: false
		}];
		var me = this;
		var myReader = new wijarrayreader(fields);
		
		var proxy = new wijhttpproxy({
			url: '/'+kore.modulo+'/'+this.controlador.nombre+'/getArticulos',
			dataType:"json"			
		});
		
		var datasource = new wijdatasource({
			reader:  new wijarrayreader(fields),
			proxy: proxy,	
			loaded: function (data) {				
				// var val=$('#tabs '+tabId+' .txtFkAlmacen').val();
				// $.each(data.items, function(index, datos) {					
					// if (parseInt(val)==parseInt(datos.id) ){						
						// $('#tabs '+tabId+' .cmbAlmacen').wijcombobox({selectedIndex:index});
					// }
				// });				
			},
			loading: function (dataSource, userData) {				 
				 dataSource.proxy.options.data=dataSource.proxy.options.data || {};
				 dataSource.proxy.options.data.idalmacen = $('#tabs '+me.tabId+' .txtFkAlmacen').val();		
            }
		});		
		
		datasource.reader.read= function (datasource) {
			var totalRows=datasource.data.totalRows;
			datasource.data = datasource.data.rows;
			datasource.data.totalRows = totalRows;
			myReader.read(datasource);
		};
		
		datasource.load();
		var me=this;
		var combo=$(target).wijcombobox({
			data: datasource,
			showTrigger: true,
			autoFilter: false,
			minLength: 1,
			animationOptions: {
				animated: "Drop",
				duration: 1000
			},
			forceSelectionText: false,
			search: function (e, obj) {
				//obj.datasrc.proxy.options.data.name_startsWith = obj.term.value;
			},
			select: function (e, item)
			{
				me.articulo=item;
				var rowdom=$(me.tabId+' .grid_busqueda tbody tr:eq('+me.selected.sectionRowIndex +')');
				
				// rowdom.find('td:eq(2) div').html(item.maximo);
				// rowdom.find('td:eq(3) div').html(item.minimo);
				// rowdom.find('td:eq(4) div').html(item.puntoreorden);
				// rowdom.find('td:eq(5) div').html(item.existencia);
				
				
				// var reorden=parseInt( item.puntoreorden );
				// var existencia=parseInt( item.existencia );
				// var maximo=parseInt( item.maximo );
				// var sugerido=0;
				// var pendiente=0;
				// if (existencia<=reorden){
					// sugerido = maximo-existencia;					
				// }				
				// me.articulo.pedido=sugerido;
				// me.articulo.sugerido=sugerido;
				// me.articulo.pendiente=0;
				
				return true;
				
			}
		});
		combo.focus();
	};
	this.eliminar=function(){
		
		if (this.borrados==undefined) this.borrados = new Array();
		
		this.borrados.push( this.selected.id );			
		var me=this;
		
		var data= $(this.tabId+" .grid_busqueda").wijgrid("data");
		
		for(var i=0; i<data.lenth; i++){
			if (data[i].id==this.selected.id ){
				data[i].eliminado=true;
			}
		}
		
		
		var cellInfo= $(this.tabId+" .grid_busqueda").wijgrid("currentCell");
		var row = cellInfo.row();
		var container=cellInfo.container();
		$(this.tabId+" .grid_busqueda 	tbody tr:eq("+cellInfo.rowIndex()+")").addClass('eliminado');		
		row.data.eliminado=true;
};
	this.nuevo=function(){		
		TabManager.add('/'+kore.modulo+'/'+this.controlador.nombre+'/nuevo',this.tituloNuevo);
	};
	this.activate=function(){
		// vuelve a renderear estos elementos que presentaban problemas. (correccion de bug)		
		$(this.tabId+" .lista_toolbar").removeClass('ui-tabs-hide');
		$(this.tabId+" .lista_toolbar  ~ .wijmo-wijribbon-panel").removeClass('ui-tabs-hide');		
		
	}
	this.borrar=function(){
		if (this.selected==undefined) return false;
		var r=confirm("¿Eliminar Elemento?");
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
		this.config=config;
		//-------------------------------------------Al nucleo		*/		
		this.controlador=config.controlador;
		this.catalogo=config.catalogo;
		//-------------------------------------------
		var tab=config.tab;		
		tabId = '#' + tab.id;
		this.tabId = tabId;
		var jTab=$('div'+tabId);				
		jTab.data('tabObj',this);		
				
		var jTab=$('a[href="'+tabId+'"]');		//// this.agregarClase('busqueda_'+this.controlador.nombre);
	    jTab.html(this.catalogo.nombre);		 
		 jTab.addClass('busqueda_'+this.controlador.nombre); 
		//-------------------------------------------
		$('div'+tabId).css('padding','0px 0 0 0');
		$('div'+tabId).css('margin-top','0px');
		$('div'+tabId).css('border','0 1px 1px 1px');			
		//-------------------------------------------				
		this.configurarToolbar(tabId);		
		 this.configurarGrid(tabId);
	};
	this.configurarToolbar=function(tabId){
		var me=this;
		
		$(this.tabId+ " > .lista_toolbar").wijribbon({
			click: function (e, cmd) {
				switch(cmd.commandName){
					case 'nuevo':						
						me.nuevo();
					break;
					case 'editar':
						if (me.selected!=undefined){													
							TabManager.add('/'+kore.modulo+'/'+me.controlador.nombre+'/editar','Editar '+me.catalogo.nombre,me.selected.id);
						}
					break;
					case 'eliminar':
						if (me.selected==undefined) return false;
						var r=confirm("¿Eliminar?");
						if (r==true){
						  me.eliminar();
						}
					break;
					case 'refresh':
						
						var gridBusqueda=$(me.tabId+" .grid_busqueda");
						gridBusqueda.wijgrid('ensureControl', true);
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
		
	};
	this.configurarGrid=function(tabId){
		pageSize=10;		
		
		var gridBusqueda=$(this.tabId+" .grid_busqueda");
		
		this.columns=[ 
			     { dataKey: "id", visible:false, headerText: "ID" },
				 { dataKey: "fk_orden_compra", visible:false },
				 { dataKey: "fk_articulo", visible:false },
				 { dataKey: "idarticulopre", visible:false },
				 { dataKey: "nombreOrigen", visible:true, headerText:'Producto', editable:false, nuevoEditable:true},
				 { dataKey: "almacen", visible:true, editable:false ,headerText:'Almacén'},
				 { dataKey: "pedidoi", visible:true , dataType:'number', aggregate:"sum", editable:false},
				 { dataKey: "cantidad", visible:true, aggregate:"sum", dataType:'number', headerText:'Ordenado',grupoEditable:false }, 
				 { dataKey: "fk_pedido_detalle", visible:false },
				 { dataKey: "nombreProducto", visible:false, grupoEditable:false, 	groupInfo:{
					position: "header", 
					outlineMode: "startExpanded", 							 
					groupSingleRow: true,
					headerText:'{0}'
				 }},
				 			 
				 { dataKey: "fk_producto_origen", visible:false},
				 { dataKey: "fk_pedido", visible:false },
				 
				 { dataKey: "fk_almacen", visible:false },
				 { dataKey: "pendiente", visible:true, aggregate:"sum", dataType:'number',editable:false }
				 
			];
		
		var me=this;		 
		gridBusqueda.wijgrid({
			dynamic: true,
			allowColSizing:true,			
			allowKeyboardNavigation:true,
			allowPaging: true,
			allowEditing: true,
			pageSize:pageSize,
			imprimirId:true,
			indexId:2,
			selectionMode:'singleRow',
			// data:dataSource,
			data:me.config.articulos,
			cellStyleFormatter: function(args) {
				args.$cell.attr("dataindex",args.column._originalDataKey);				 
			},
			rowStyleFormatter: function(args) {				
				//como voy a saber que el registro no esta concentrado??
				//facil, cuando no tiene establecida una relacion con el detalle								
				if (args.dataRowIndex>-1){
					// args.$rows.attr('rowId',args.data.id_tmp);					
					// var fk= ( args.data.fk_pedido_detalle!=undefined )? parseInt(args.data.fk_pedido_detalle) : 0;					
					
					// var id= ( args.data.id!=undefined )? parseInt(args.data.id) : 0;					
					// if ( isNaN(id ) || id==0 ){
						// args.$rows.attr('nuevo','true');
					// }else{
						// if ( isNaN(fk ) || fk==0 ){
							// args.$rows.attr('singrupo','true');
						// }
					// }
				}else{					
					args.$rows.attr('grupo_editable','true');
					
				}
					
			},
			beforeGroupEditX: function(e, args) {				
			// comportamiento editable para los registros agrupadores
				var td=$(args.target).parents('td');																		
				var celda={
					col:$(td).parent().children().index( $(td) ),
					row:$(td).parent().parent().children().index( $(td).parent() )
				}
				
				if (me.z_editor.esCeldaEditable(celda)){
					me.z_editor.editarCelda(celda);
				}
				// return false;
			},
			columns: this.columns,
			beforeCellEdit: function (e, args) { 
				
				args.handled=true;
				
				
				var column=args.cell.column();				
				
				var row = args.cell.row();
			
				 if (row ==undefined) return false;
			//con los registros nuevos, la edicion es diferente 			
			//------------------------------------
				if (row.data.id==undefined || row.data.id=="" || row.data.id == 0 ){
				//En este caso, la propiedad nuevoEditable sobreEscribe a editable.					
					if (column.nuevoEditable !== undefined){
						if (column.nuevoEditable === false)  return false;
					}  else{
						if (column.editable === false)  return false;
					}
					
				}else{
					if (column.editable === false)  return false;
				}
			//------------------------------------
				switch (args.cell.column().dataKey) {
					case "nombreOrigen": 						
						var combo=
						$("<input />")
							.val(args.cell.value()) 
							.appendTo(args.cell.container().empty() );   
						args.handled = true;   
						
						var domCel = args.cell.tableCell();
						combo.css('width',	$(domCel).width()-10 );
						combo.css('height',	$(domCel).height()-10 );
						
						me.configurarComboArticulo(combo);
					break;
					default:					
						var input=$("<input />")
							.val(args.cell.value())
							.appendTo(args.cell.container().empty()).focus().select();				
						
						var domCel = args.cell.tableCell();
						input.css('width',	$(domCel).width()  -10 );
						input.css('height',	$(domCel).height() -10 );
					break;
				}
				return true;
				
			}
		});
		
		gridBusqueda.wijgrid({ rendered: function (e) { 
			// console.log("rendered");
			if (me.z_editor == undefined){
				me.z_editor = new NavegacionEnAgrupada();				
				me.z_editor.init({
					targetSelector: me.tabId+' .grid_busqueda',
					pageSize:pageSize,
					tabId:me.tabId,
					padre:me
				});
			}else{
				me.z_editor.reset();
			}
		} });
		// Supply a callback function to handle the afterCellUpdate event
		gridBusqueda.wijgrid({ afterCellUpdate: function (e, args) { 
			// console.log("afterCellUpdate");
			 $(me.tabId+' .grid_busqueda').wijgrid('doRefresh');
		} });
		gridBusqueda.wijgrid({beforeCellUpdate:function(e, args) {
				var dk=args.cell.column().dataKey;
				console.log("dk"); console.log(dk);
				switch (dk) {
					case "nombreOrigen":
						
						args.value = args.cell.container().find("input").val();
						
						if (me.articulo!=undefined){
							console.log("me.articulo"); console.log(me.articulo);
							var row=args.cell.row();
							
							row.data.fk_articulo=me.articulo.value;
							row.data.nombreProducto = me.articulo.nombre;
							// row.data.pedido=me.articulo.pedido;
							// row.data.fk_producto_origen=me.articulo.id;							
							// row.data.codigo=me.articulo.codigo;
							// row.data.maximo=me.articulo.maximo;
							// row.data.minimo=me.articulo.minimo;
							// row.data.puntoreorden=me.articulo.puntoreorden;
							// row.data.existencia=me.articulo.existencia;
							row.data.sugerido=me.articulo.sugerido;							
							row.data.pendiente=me.articulo.pendiente;
							row.data.nombreGpo=me.articulo.grupo;		
							row.data.fk_producto_origen=me.articulo.value;
						}
					break;
					case 'cantidad':
						 args.value = args.cell.container().find("input").val();					
						 
						var row=args.cell.row();						
						// row.data.cantidad = args.value;							 
						if ( row.data.fk_pedido_detalle != 0 ){
							console.log("args.value"); console.log(args.value);
							
							row.data.pendiente = row.data.pedidoi - args.value;
							
							 $(me.tabId+' .grid_busqueda').wijgrid('doRefresh');
						}
							
					break;
					
				}
				me.articulo=undefined;
			}
		});
		var me=this;
		
		gridBusqueda.wijgrid({ selectionChanged: function (e, args) { 					
			var item=args.addedCells.item(0);
			
				var row=item.row();
				var data=row.data;			
				me.selected=data;			
				me.selected.dataItemIndex=row.dataItemIndex;
				me.selected.sectionRowIndex=row.sectionRowIndex;
			
			
		} });
		
		gridBusqueda.wijgrid({ loaded: function (e) { 
			// $(me.tabId + ' .grid_busqueda tr').bind('dblclick', function (e) { 							
				// var pedidoId=me.selected.id;
				// TabManager.add('/'+kore.modulo+'/'+me.controlador.nombre+'/editar','Editar '+me.catalogo.nombre,pedidoId);				
			// });			
			if (me.z_editor == undefined){
				me.z_editor = new NavegacionEnAgrupada();				
				me.z_editor.init({
					targetSelector: me.tabId+' .grid_busqueda',
					pageSize:pageSize,
					tabId:me.tabId,
					padre:me
				});
			}else{
				me.z_editor.reset();
			}
			
		} });
	};
};
