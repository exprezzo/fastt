var Busquedadetalle_de_la_orden=function(){
	this.tituloNuevo='Nueva';
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
				var gridBusqueda=$(me.tabId+" .grid_busqueda");				
				gridBusqueda.wijgrid('ensureControl', true);
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
		TabManager.add('/'+kore.modulo+'/'+this.controlador.nombre+'/nuevo',this.tituloNuevo);
	};
	this.activate=function(){
		// vuelve a renderear estos elementos que presentaban problemas. (correccion de bug)		
		$(this.tabId+" .lista_toolbar").removeClass('ui-tabs-hide');
		$(this.tabId+" .lista_toolbar  ~ .wijmo-wijribbon-panel").removeClass('ui-tabs-hide');		
		
	}
	this.borrar=function(){
		if (this.selected==undefined) return false;
		var r=confirm("Â¿Eliminar Elemento?");
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
		
		var campos=[
			// { name: "id"  }
		];
		// var dataReader = new wijarrayreader(campos);
			
		// var dataSource = new wijdatasource({
			// proxy: new wijhttpproxy({
				// url: '/'+kore.modulo+'/'+this.controlador.nombre+'/getDetalles',
				// dataType: "json",
				// data: { id: this.config.id }
			// }),
			// dynamic:true,
			// reader:new wijarrayreader(campos)
		// });
				
		// dataSource.reader.read= function (datasource) {						
			// var totalRows=datasource.data.totalRows;						
			// datasource.data = datasource.data.rows;
			// datasource.data.totalRows = totalRows;
			// dataReader.read(datasource);
		// };				
		// this.dataSource=dataSource;
		var gridBusqueda=$(this.tabId+" .grid_busqueda");
		
		// if (this.z_editor == undefined){
			// this.z_editor = new NavegacionEnAgrupada();				
			// this.z_editor.init({
				// targetSelector: this.tabId+' .grid_busqueda',
				// pageSize:pageSize,
				// tabId:this.tabId,
				// padre:this
			// });
		// }else{
			// this.z_editor.reset();
		// }
		
		this.columns=[ 
			     { dataKey: "id", visible:false, headerText: "ID" },
				 { dataKey: "fk_orden_compra", visible:false },
				 { dataKey: "fk_articulo", visible:false },
				 { dataKey: "idarticulopre", visible:false },
				 { dataKey: "nombreOrigen", visible:true, headerText:'Producto', editable:false, nuevoEditable:true },	
				 { dataKey: "almacen", visible:true, editable:false ,headerText:'AlmacÃ©n'},
				 { dataKey: "pedidoi", visible:true , dataType:'number', aggregate:"sum", editable:false},
				 { dataKey: "cantidad", visible:true, aggregate:"sum", dataType:'number', headerText:'Ordenado',grupoEditable:true },				 
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
			beforeGroupEdit: function(e, args) {
				
				// obtengo la celda que intenta editarse, y sus indices en la tabla
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
				// console.log("row"); console.log(row);
				
				//con los registros nuevos, la edicion es diferente 
				
				//------------------------------------
				if (row.data.id==undefined || row.data.id=="" || row.data.id == 0 ){
					//En este caso, la propiedad nuevoEditable sobreEscribe readOnly.
					// console.log("nuevoEditable? column"); console.log(column);
					if (column.nuevoEditable !== undefined){
						if (column.nuevoEditable === false)  return false;
					}  else{
						if (column.editable === false)  return false;
					}
					
				}else{
					if (column.editable === false)  return false;
				}
				//------------------------------------
				
				var input=$("<input />")
					.val(args.cell.value())
					.appendTo(args.cell.container().empty()).focus().select();				
				
				var domCel = args.cell.tableCell();
				input.css('width',	$(domCel).width()  -10 );
				input.css('height',	$(domCel).height() -10 );
						
				return true;
				
			}
		});
		
		var me=this;
		
		gridBusqueda.wijgrid({ selectionChanged: function (e, args) { 					
			var item=args.addedCells.item(0);
			var row=item.row();
			var data=row.data;			
			me.selected=data;			
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
