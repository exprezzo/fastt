
var EdicionArticulo=function (tabId){
		
	
	this.init=function(tabId, padre, articulos){									
		this.tmp_id=0;
		this.tabId=tabId;
		this.padre=padre;
		//this.configurarFormulario(tabId);	
		this.configurarGrid(tabId, articulos);		
		this.configurarToolbar(tabId);		
		return true;
				
		var me=this;
								
		this.configurarComboArticulo();
		$(me.tabId+' .frmEditInlinePedido .txtCantidad').wijinputnumber({
            type: 'numeric',           
            decimalPlaces: 2,
            showSpinner: true			
        });
				
		this.configurarComboUM();
		$(me.tabId+' .frmEditInlinePedido .txtExistencia').change(function(){
			me.calcularSugerencia();
		});
		
		$(me.tabId+' .frmEditInlinePedido .txtPedido').change(function(){
			me.calcularSugerencia();
		});		

		
	};
	this.calcularSugerencia=function(){
		var me=this;
		var reorden=parseInt( $(me.tabId+' .frmEditInlinePedido .txtPuntoReorden').val() );
		var existencia=parseInt( $(me.tabId+' .frmEditInlinePedido .txtExistencia').val() );
		var maximo=parseInt( $(me.tabId+' .frmEditInlinePedido .txtMaximo').val() );
		var sugerido=0;
		var pendiente=0;
		if (existencia<=reorden){
			sugerido = maximo-existencia;
			var pedido=$(me.tabId+' .frmEditInlinePedido .txtPedido').val();
			pendiente= sugerido - pedido;
		}
		$(me.tabId+' .frmEditInlinePedido .txtSugerido').val(sugerido);
		$(me.tabId+' .frmEditInlinePedido .txtPendiente').val(pendiente);
	};
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
			url: '/'+kore.modulo+'/orden_compra/getArticulos',
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
				var rowdom=$(me.tabId+' .grid_articulos tbody tr:eq('+me.selected.sectionRowIndex +')');
				me.articulo=item;				
				
				// var numCel=0;
				// var dataKey;
				// for(var $i=0; $i<me.columns.length; $i++ ){
					// if (me.columns[$i].visible===false) continue;
					// dataKey=me.columns[$i].dataKey;
					// rowdom.find('td:eq('+numCel+') div').html(item[dataKey]);
					// numCel++;
				// }
				
				rowdom.find('td:eq(0) div').html(item.codigo);
				// rowdom.find('td:eq(2) div').html(item.presentacion);
				rowdom.find('td:eq(2) div').html(item.maximo);
				rowdom.find('td:eq(3) div').html(item.minimo);
				rowdom.find('td:eq(4) div').html(item.puntoreorden);
				rowdom.find('td:eq(5) div').html(item.existencia);
				
				
				var reorden=parseInt( item.puntoreorden );
				var existencia=parseInt( item.existencia );
				var maximo=parseInt( item.maximo );
				var sugerido=0;
				var pendiente=0;
				if (existencia<=reorden){
					sugerido = maximo-existencia;					
				}
			
				rowdom.find('td:eq(6) div').html(sugerido);
				rowdom.find('td:eq(7) div').html(sugerido);
				rowdom.find('td:eq(8) div').html(sugerido);
				rowdom.find('td:eq(9) div').html(0);
				me.articulo.pedido=sugerido;
				me.articulo.sugerido=sugerido;
				me.articulo.pendiente=0;
				
				return true;
				
			}
		});
		combo.focus();
	}
	this.guardar=function(){
		
		//Obtener todos los datos del formulario inline, obtener el id_temp del pedido
		//Enviar datos al servidor
		//En la respuesta, refrescar el grid
			
		var datos={
			id			:$(this.tabId+' .frmEditInlinePedido .txtId').val(),
			id_tmp		:$(this.tabId+' .frmEditInlinePedido .txtIdTmp').val(),
			pedido		:$(this.tabId+' .frmEditInlinePedido .txtPedido').val(),
			IdTmp		: $(this.tabId+' .frmEditInlinePedido .txtIdTmp').val(),
			idarticulopre	:$(this.tabId+' .frmEditInlinePedido .txtIdArticuloPre').val(),
			//um			:$(this.tabId+' .frmEditInlinePedido .txtUm').val(),
			maximo		:$(this.tabId+' .frmEditInlinePedido .txtMaximo').val(),
			minimo		: $(this.tabId+' .frmEditInlinePedido .txtMinimo').val(),
			puntoreorden		: $(this.tabId+' .frmEditInlinePedido .txtPuntoReorden').val(),
			existencia		: $(this.tabId+' .frmEditInlinePedido .txtExistencia').val(),
			minimo		: $(this.tabId+' .frmEditInlinePedido .txtMinimo').val(),			
			idarticulopre	:$(this.tabId+' .frmEditInlinePedido .txtIdArticuloPre').val(),
			fk_articulo	:$(this.tabId+' .frmEditInlinePedido .txtFkArticulo').val(),
			fk_pedido	:$(this.tabId+' .frmPedidoi .txtId').val(),
			fk_tmp		:$(this.tabId+' .frmPedidoi .txtIdTmp').val()
		}
		
		var iActual=$(this.tabId+' .frmEditInlinePedido .txtDataItemIndex').val();
		
		var iActual=parseInt(iActual);
		
		var me=this;
		
		
		$.ajax({
			type: "POST",
			url: '/'+kore.modulo+'/pedidoi/guardarArticulo',
			data: {datos:datos,stock:me.prods}
		}).done(function( response ) {
									
			var resp = eval('(' + response + ')');
			var msg= (resp.msg)? resp.msg : '';
			var title;
			if ( resp.success == true	){				
				icon='/web/apps/fastorder/images/yes.png';
				title= 'Success';
				
				
				me.padre.editado=true;
				var siguiente=parseInt(iActual)+1;				
				if (siguiente>-1){					
					var data = $(me.tabId+" .grid_articulos").wijgrid("data");										
					var siguiente=parseInt(iActual)+1;
					if (data[siguiente] != undefined){
						me.selected=data[siguiente];
						me.selected.dataItemIndex=siguiente;						
						me.selected.editandoId=me.selected.id_tmp;
						me.editar();
					}else{
						me.selected=data[0];
						me.selected.dataItemIndex=0;						
						me.selected.editandoId=me.selected.id_tmp;
						me.editar();
					}
				}else{
					$(me.tabId+' .frmEditInlinePedido').css('visibility','hidden');								
				}
				$(me.tabId+' .grid_articulos').wijgrid('ensureControl', true);				
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
	},
	this.configurarGrid=function(tabId, articulos){			
		var gridPedidos=$('#tabs '+tabId+" .grid_articulos");				
		
		var me=this;
		gridPedidos.delegate('td','keydown', function(e) {		
			var code = e.keyCode || e.which;
			code=parseInt(code);	
			
			
			
			// alert(e.keyCode);
			if(e.keyCode==46){
				me.eliminar();
			}else if(e.keyCode==13){	
				//Saltar al siguiente registro
				me.navegarEnter(true);			 
			}else if(e.keyCode==9  && e.shiftKey){	
				e.preventDefault();								
				me.seleccionarSiguiente(this,true);				
			}else if(e.keyCode==9 ){				
				e.preventDefault();
				me.seleccionarSiguiente(this);
			}
		});
		var formatMoney='n'+kore.decimalPlacesMoney;
		var columns=[				
			/* {  dataKey: "nombreGpo", groupInfo:{position: "header", outlineMode: "startExpanded", headerText: "custom"},visible:false },			*/
			{dataKey: "producto", headerText: "Art&iacute;culo",width:100,cellFormatter: function(args) { args.formattedValue='';},
				groupInfo:{
					position: "header", 
					outlineMode: "startExpanded", 
					headerText: "{0}",					  
					groupSingleRow: false
			},visible:false, editable:false, aggregate:'custom'},				
			{dataKey: "producto_pi",width:200,  headerText: "Origen", aggregate:'custom', editable:true},
			{dataKey: "almacen_pi",  headerText: "Almacen", aggregate:'custom', editable:false},				
			{dataKey: "maximo_pi",   headerText: "M&aacute;ximo",editable:false, dataType: "number", dataFormatString: formatMoney, aggregate: "custom"},
			{dataKey: "minimo_pi",   headerText: "Minimo",editable:false, dataType: "number", dataFormatString: formatMoney, aggregate: "custom"},
			{dataKey: "reorden_pi",  headerText: "Reorden",editable:false, dataType: "number", dataFormatString: formatMoney, aggregate: "custom"},
			{dataKey: "inicial_pi",  headerText: "Existencia", dataType: "number", dataFormatString: formatMoney,  aggregate: "custom"},
			{dataKey: "cantidad_pi", headerText: "Ped. Int.", dataType: "number", dataFormatString: formatMoney,  aggregate: "sum"},
			{dataKey: "sugerido_pi", headerText: "Sugerido",dataType: 'number', aggregate:'custom'},			
			{dataKey: "cantidad",  headerText: "Ordenado", dataType: "number", dataFormatString: formatMoney,  aggregate: "sum"},				
			{dataKey: "pendiente",headerText:'Pendiente', width:190,dataType: 'number'},
			{dataKey: "productoJson",visible:true, width:0,  aggregate: "custom"},				
			{dataKey: "codigo", visible:false, headerText: "Codigo",width:'100',aggregate:'custom', editable:false, cellFormatter: function(args) { args.formattedValue='';}},
			{dataKey: "maximo",  visible:false, headerText: "M&aacute;ximo",editable:false, dataType: "number", dataFormatString: formatMoney, aggregate: "average"},
			{dataKey: "minimo",  visible:false, headerText: "M&iacute;nimo",editable:false, dataType: "number", dataFormatString: formatMoney, aggregate: "average"},
			{dataKey: "puntoreorden",visible:false,  headerText: "Reorden",editable:false, dataType: "number", dataFormatString: formatMoney, aggregate: "average"},
			{dataKey: "existencia",visible:false , headerText: "Existencia", dataType: "number", dataFormatString: formatMoney,  aggregate: "average"},
			{dataKey: "idproducto",visible:false},				
			{dataKey: "idalmacen_pi",visible:false},
			{dataKey: "id", visible:false, headerText: "ID" },
			{dataKey: "pro_pi", visible:false },
			{dataKey: "fk_pedido_detalle", visible:false }						
		];
		this.columns=columns;
		gridPedidos.wijgrid({
			allowColSizing:true,
			allowPaging: true,
			pageSize:9,
			allowEditing:true,
			allowColMoving: false,
			allowKeyboardNavigation:true,
			selectionMode:'singleRow',
			data:articulos,
			ensureColumnsPxWidth:true,
			columns:columns,			
			groupText:function(e,args){					},	
			groupAggregate: function (e, args, f, g) {
				switch( args.column.dataKey ){
					case 'sugerido_pi':																		
						var prodId=args.data[ args.groupingStart][17].value;;
						var index=prodId.toString();
				
						if ( me.padre.prods==undefined ){
							me.padre.prods={};
						}
						if ( me.padre.prods[index] == undefined ){
							me.padre.prods[index]={};
						}
														
						me.padre.prods[index]['idalmacen']=$(me.tabId+ ' .txtFkAlmacen').val();												
						
						if ( me.padre.prods[index]['maximo_pi'] == undefined )												
							me.padre.prods[index]['maximo_pi']= args.data[ args.groupingStart][13].value;
							
						if ( me.padre.prods[index]['minimo_pi'] == undefined )												
							me.padre.prods[index]['minimo_pi']=args.data[ args.groupingStart][14].value;
							
						if ( me.padre.prods[index]['reorden_pi'] == undefined )												
							me.padre.prods[index]['reorden_pi']=args.data[ args.groupingStart][15].value;
							
						if ( me.padre.prods[index]['inicial_pi'] == undefined )												
							me.padre.prods[index]['inicial_pi']=args.data[ args.groupingStart][16].value;
							
						var maximo =me.padre.prods[index]['maximo_pi']*1,
							minimo =me.padre.prods[index]['minimo_pi']*1,
							reorden=me.padre.prods[index]['reorden_pi']*1, 
							existencia =me.padre.prods[index]['inicial_pi'] *1,
							pi=args.data[ args.groupingStart][18].value, 
							sugerido=0;
						
						console.log("existencia");console.log(existencia);
						console.log("reorden");console.log(reorden);
						if (existencia <= reorden){
							
							sugerido=maximo-existencia;
							
						}
						args.data[ args.groupingStart][18].value=sugerido;
						args.text=sugerido;
						
					//---------------------------------
					break;
					case 'productoJson':						
						args.text=args.data[args.groupingStart][17].value;						
					break;
					case 'maximo_pi':
						var prodId=args.data[ args.groupingStart][17].value;;						
						var index=prodId.toString();
						// alert(index);
						if (me.padre.prods && me.padre.prods[index]!=undefined && me.padre.prods[index]['maximo_pi']!=undefined ){
							args.text=me.padre.prods[index]['maximo_pi'];
						}else{
							args.text=args.data[args.groupingStart][13].value;
						}						
					break;
					case 'minimo_pi':
						var prodId=args.data[ args.groupingStart][17].value;;						
						var index=prodId.toString();
						if (me.padre.prods && me.padre.prods[index]!=undefined && me.padre.prods[index]['minimo_pi']!=undefined ){
							args.text=me.padre.prods[index]['minimo_pi'];
						}else{
							args.text=args.data[args.groupingStart][14].value;
						}
						
					break;
					case 'reorden_pi':
						var prodId=args.data[ args.groupingStart][17].value;;						
						var index=prodId.toString();
						if (me.padre.prods && me.padre.prods[index]!=undefined && me.padre.prods[index]['reorden_pi']!=undefined ){
							args.text=me.padre.prods[index]['reorden_pi'];
						}else{
							args.text=args.data[args.groupingStart][15].value;
						}						
					break;
					case 'inicial_pi':
						var prodId=args.data[ args.groupingStart][17].value;;						
						var index=prodId.toString();
						if (me.padre.prods && me.padre.prods[index]!=undefined && me.padre.prods[index]['inicial_pi']!=undefined ){
							args.text=me.padre.prods[index]['inicial_pi'];
						}else{
							args.text=args.data[args.groupingStart][16].value;
						}												
					break;
				}
			},
			rowStyleFormatter: function(args) {				
				//como voy a saber que el registro no esta concentrado??
				//facil, cuando no tiene establecida una relacion con el detalle								
				if (args.dataRowIndex>-1){
					args.$rows.attr('rowId',args.data.id_tmp);					
					var fk= ( args.data.fk_pedido_detalle!=undefined )? parseInt(args.data.fk_pedido_detalle) : 0;					
					if ( isNaN(fk ) || fk==0 ){
						args.$rows.attr('singrupo','true');
					}					
				}else{					
					args.$rows.attr('grupo_editable','true');
					
				}
					
			},
			cellStyleFormatter: function(args) {
				args.$cell.attr("dataindex",args.column._originalDataKey);				 
			}
		});
		var me=this;
		
		gridPedidos.wijgrid({ groupText: function (e, args) { 			
		}} );
		
		gridPedidos.wijgrid({ beforeGroupEdit: function(e, args) { //agregada al nucleo de Wijmo el 11-03-2013					
			var tr=$(args.target).parents('tr');			
			
			var tds= tr.find('td');			
			var size=tds.length;			
			var last=tds[size-1];			
			var div = $(last).find('div');
								
			var input=$("<input style='text-align:right;' />");
				input.val( args.target.innerText ) 
				.appendTo( $(args.target ).empty() ); 				
				
			// jQuery.data( input, 'celda', args.target )
			input.focus();
			
			
			input.bind('change',function(){
				
				var prodId=div[0].innerHTML;
				var index=prodId.toString();
				
				if ( me.padre.prods==undefined ){
					me.padre.prods={};
				}
				if ( me.padre.prods[index] == undefined ){
					me.padre.prods[index]={};
				}
								
				var di=$(args.target).parent().attr('dataIndex');
				console.log("di"); console.log(di);
				
				me.padre.prods[index][di]= $(this).val();				
				
				$(me.tabId+' .grid_articulos').wijgrid('doRefresh');
			});
			
			
			input.bind('blur',function(){
				// alert('blur');
				var input=$(this);				
				
				
				// celda=jQuery.data(this,'celda');					
				// var di=$(args.target).parent().attr('dataIndex');				
				
				 // var div=$('<div class="swijmo-wijgrid-innercell">'+input.val()+'</div>');									
				// input.remove();
				// var di = input.parent().attr('dataIndex');
				
				 input.parent().empty().html( input.val() );
							
				
			});
		}});
		
		gridPedidos.wijgrid({ beforeCellEdit: function(e, args) {
				var row = args.cell.row();								
				var index = args.cell.rowIndex();								
				var column=args.cell.column();
				
				if (column.editable === false){
					return false;
				}
				
				var sel=gridPedidos.wijgrid('selection');
				sel.addRows(index);

				// alert(args.cell.column().dataKey);
				switch (args.cell.column().dataKey) {
					case "codigo":
						var combo=
						$("<input />")
							.val(args.cell.value())
							.appendTo(args.cell.container().empty());
						args.handled = true;
						
						var domCel = args.cell.tableCell();
						combo.css('width',	$(domCel).width()-10 );
						combo.css('height',	$(domCel).height()-10 );
						
						me.configurarComboCodigo(combo);
					break;
					case "producto_pi": 
						
						var combo=
						$("<input />")
							.val(args.cell.value()) 
							.appendTo(args.cell.container().empty());   
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
						args.handled = true;
						
						var domCel = args.cell.tableCell();
						input.css('width',	$(domCel).width()  -10 );
						input.css('height',	$(domCel).height() -10 );
						
						
					break;						
				} 
			}
		});
		gridPedidos.wijgrid({beforeCellUpdate:function(e, args) {
			
				switch (args.cell.column().dataKey) {
					case "producto_pi":
						alert("producto_pi");
						args.value = args.cell.container().find("input").val();
						
						if (me.articulo!=undefined){
							alert("producto definido");
							var row=args.cell.row();
							console.log(me.articulo);
							row.data.idproducto=me.articulo.value;
							row.data.producto = me.articulo.nombre;
							row.data.pedido=me.articulo.pedido;
							// row.data.fk_producto_origen=me.articulo.id;							
							row.data.codigo=me.articulo.codigo;
							row.data.maximo=me.articulo.maximo;
							row.data.minimo=me.articulo.minimo;
							row.data.puntoreorden=me.articulo.puntoreorden;
							row.data.existencia=me.articulo.existencia;
							row.data.sugerido=me.articulo.sugerido;							
							row.data.pendiente=me.articulo.pendiente;
							row.data.nombreGpo=me.articulo.grupo;		
							// gridPedidos.wijgrid('ensureControl');
							
							
			
			// {dataKey: "almacen_pi",  headerText: "Almacen", aggregate:'custom', editable:false},				
			// {dataKey: "maximo_pi",   headerText: "M&aacute;ximo",editable:false, dataType: "number", dataFormatString: formatMoney, aggregate: "custom"},
			// {dataKey: "minimo_pi",   headerText: "Minimo",editable:false, dataType: "number", dataFormatString: formatMoney, aggregate: "custom"},
			// {dataKey: "reorden_pi",  headerText: "Reorden",editable:false, dataType: "number", dataFormatString: formatMoney, aggregate: "custom"},
			// {dataKey: "inicial_pi",  headerText: "Existencia", dataType: "number", dataFormatString: formatMoney,  aggregate: "custom"},
			// {dataKey: "sugerido_pi", headerText: "Sugerido",dataType: 'number'},
			// {dataKey: "cantidad_pi", headerText: "Ped. Int.", dataType: "number", dataFormatString: formatMoney,  aggregate: "sum"},
			// {dataKey: "cantidad",  headerText: "Ordenado", dataType: "number", dataFormatString: formatMoney,  aggregate: "sum"},				
			// {dataKey: "pendiente",headerText:'Pendiente', width:190,dataType: 'number'},
			// {dataKey: "productoJson",visible:true, width:0,  aggregate: "custom"},				
			// {dataKey: "codigo", visible:false, headerText: "Codigo",width:'100',aggregate:'custom', editable:false, cellFormatter: function(args) { args.formattedValue='';}},
			// {dataKey: "maximo",  visible:false, headerText: "M&aacute;ximo",editable:false, dataType: "number", dataFormatString: formatMoney, aggregate: "average"},
			// {dataKey: "minimo",  visible:false, headerText: "M&iacute;nimo",editable:false, dataType: "number", dataFormatString: formatMoney, aggregate: "average"},
			// {dataKey: "puntoreorden",visible:false,  headerText: "Reorden",editable:false, dataType: "number", dataFormatString: formatMoney, aggregate: "average"},
			// {dataKey: "existencia",visible:false , headerText: "Existencia", dataType: "number", dataFormatString: formatMoney,  aggregate: "average"},
			// {dataKey: "idproducto",visible:false},				
			// {dataKey: "idalmacen_pi",visible:false},
			// {dataKey: "id", visible:false, headerText: "ID" },
			// {dataKey: "pro_pi", visible:false },
			// {dataKey: "fk_pedido_detalle", visible:false }		
							//actualizar el stock;
							
						}
						break;
					case "codigo":
						args.value = args.cell.container().find("input").val();
						if (me.articulo!=undefined){
							var row=args.cell.row();
							row.data.presentacion=me.articulo.presentacion;
							row.data.nombre=me.articulo.nombre;
							row.data.fk_articulo=me.articulo.value;
							row.data.maximo=me.articulo.maximo;
							row.data.minimo=me.articulo.minimo;
							row.data.puntoreorden=me.articulo.puntoreorden;
							row.data.existencia=me.articulo.existencia;
							row.data.sugerido=me.articulo.sugerido;
							row.data.pedido=me.articulo.pedido;
							row.data.pendiente=me.articulo.pendiente;							
							row.data.nombreGpo=me.articulo.grupo;
							gridPedidos.wijgrid('ensureControl',true);
							
						}
						break;
					case "existencia":
						args.value=args.cell.container().find("input").val();						
						var row=args.cell.row();
						
						if (args.value <= row.data.puntoreorden){
							row.data.sugerido = row.data.maximo - args.value;
							row.data.pendiente=row.data.sugerido-row.data.pedido
						}else{
							row.data.sugerido = 0;
							row.data.pendiente=row.data.sugerido;
						}
						$(row.$rows).find('td:eq(7) div').html(row.data.sugerido);
						$(row.$rows).find('td:eq(9) div').html(row.data.pendiente);
						
						// var gridPedidos=$('#tabs '+tabId+" .grid_articulos");						
						break;
				}
				me.articulo=undefined;
			}
		});
		
		$(me.tabId+' .grid_articulos').wijgrid({ afterCellUpdateX: function (e, args) {
			$(me.tabId+' .grid_articulos').wijgrid('doRefresh');
		} });
		
		gridPedidos.wijgrid({cancelEdit:function(){		
				$(me.tabId+' .grid_articulos').wijgrid('doRefresh');
			}
		});
		
		gridPedidos.wijgrid({ selectionChanged: function (e, args) {
			// alert('selectionChanged');
			var item=args.addedCells.item(0);
			var row=item.row();
			var data=row.data;
			me.selected=data;
			me.selected.dataItemIndex=row.dataItemIndex;
			me.selected.sectionRowIndex=row.sectionRowIndex;
			
		} });
		
		//en los grids agrupados, para corregir bug al expandir/colapsar
		gridPedidos.click(function(){
			
                if($(this).hasClass("ui-icon-triangle-1-e"))
                {
					gridPedidos.wijgrid('endEdit');
					var selectionObj = gridPedidos.wijgrid("selection");
					selectionObj.clear();
					gridPedidos.wijgrid('doRefresh');
				   
                }
				
                else if($(this).hasClass("ui-icon-triangle-1-se"))
                {
					gridPedidos.wijgrid('endEdit');
					var selectionObj = gridPedidos.wijgrid("selection");
					selectionObj.clear();
                   gridPedidos.wijgrid('doRefresh');                   
                }
            });	
		this.numCols=$(tabId+' .grid_articulos thead th').length;
		
		gridPedidos.find('td').bind('mousedown',function(e){ 
			// alert("editar");
		});
	};
	
	this.configurarFormulario=function(tabId){
		 // $(tabId+" .txtCantidad").wijinputnumber( 
        // {
            // type: 'numeric',
            // minValue: -100,
            // maxValue: 1000,
            // decimalPlaces: 4,
            // showSpinner: true
        // });		
		// this.configurarComboArticulos(tabId);
		// this.configurarComboUM(tabId);
	};
	this.eliminar=function(){
		
		var cellInfo= $(this.tabId+" .grid_articulos").wijgrid("currentCell");
		var row = cellInfo.row();
		var container=cellInfo.container();
		$(this.tabId+" .grid_articulos 	tbody tr:eq("+cellInfo.rowIndex()+")").addClass('eliminado');		
		row.data.eliminado=true;
		
	}
	this.navegarEnter=function(){		
		this.seleccionarSiguiente(false, true, true);		
	}
	this.seleccionarSiguiente = function(target, alreves, saltar,mantenerColumna){
		//dos direcciones, hacia atras y hacia adelante.
		//de la ultima caja editable de la fila, pasa a la siguiente fila.
		//si se esta navegando alreves, del primer registro editable, pasa al registro anterior.
		//si no hay otra fila, agrega un nuevo elemento.
		//si está ubicado en el ultimo elemento de la pagina, pasar a la pagina siguiente .
		//si está nvegando alrevés, y está ubicado en el primer elemento de la pagina, pasar a la pagina anterior.
		
		
		 var col = $(target).parent().children().index($(target));
        var row = $(target).parent().parent().children().index($(target).parent());
        alert('Row: ' + row + ', Column: ' + col);
		
		return true;
		//Obtengo la celda seleccionada
		var tabId, cellInfo, cellIndex, rowIndex,  row, nextCell, nextRow; 
		tabId=this.tabId;
		
		
		cellInfo= $(tabId+" .grid_articulos").wijgrid("currentCell");
		
		var direccion=	(alreves)? -1 : 1;
		cellIndex=cellInfo.cellIndex();
		rowIndex = cellInfo.rowIndex();
		nextRow=rowIndex;
		nextCell = cellIndex + direccion;
		
		
		if (saltar){
			nextCell=(alreves)? -1 : this.numCols + 1			
		}
		
		
		
		
		if ( nextCell<0 ){
			//ir al registro anterior, cambiar de pagina
			row=cellInfo.row();
			var data = $(tabId+" .grid_articulos").wijgrid('data');
			var pageSize = $(tabId+" .grid_articulos").wijgrid('option','pageSize');
			var pageIndex = $(tabId+" .grid_articulos").wijgrid('option','pageIndex');
			
			dataItemIndex = row.dataItemIndex;
			var fi= (pageSize * pageIndex);
						
			if ( dataItemIndex == fi){
				if (pageIndex==0){
					return false;
				}
				$(tabId+" .grid_articulos").wijgrid('option','pageIndex',pageIndex-1);
				nextCell=0;
				nextRow=pageSize*2;
			}
			
			nextCell=this.numCols-1;
			nextRow	= nextRow - 1;
			
			var cell;

			if (nextCell>-1 && nextRow>-1){
				while (true)
				 {
					cell = $(tabId+" .grid_articulos").wijgrid('currentCell',nextCell, nextRow);
					if (cell.column == undefined ){
						nextRow--;
					}else{					
						break;
					}
				}			
			}else{
				return false;
			}
		} else if ( nextCell>=this.numCols || saltar){
			nextCell=0;
			if (mantenerColumna){
				// alert(' mantenerColumna: '+ cellIndex);
				nextCell=cellIndex;
			}
			//ir al registro siguiente, cambiar de pagina o agregar nuevo registro,
			row=cellInfo.row();			
			var data = $(tabId+" .grid_articulos").wijgrid('data');			 
			var pageSize = $(tabId+" .grid_articulos").wijgrid('option','pageSize');
			var pageIndex = $(tabId+" .grid_articulos").wijgrid('option','pageIndex');			 
			//voy a ver si es el ultimo registro de la pagina
			dataItemIndex = row.dataItemIndex;
			var ip= (pageSize * (pageIndex+1) )-1;
			// var index = collection.indexOf(0, 0);			
			// alert(index);
			
			//alert("pageSize: "+pageSize+" pageIndex:" + pageIndex + " dataItemIndex: " + dataItemIndex + ' ip:' + ip);
			
			if ( (dataItemIndex+1) == data.length ){
				//esta en el ultimo registro de la ultima pagina
				//agregar nuevo, si esta al final de la pagina, despues de agregar registro, mover a la siguiente pagina
				
				//
				var rec={};		
				$.each( this.fields, function(indexInArray, valueOfElement){
					var campo=valueOfElement.name;
					rec[campo]='';
				
				} );
				data.push(rec);
				//
				
				$(tabId+" .grid_articulos").wijgrid("ensureControl", true);
				$(tabId+" .grid_articulos").wijgrid('option','pageIndex',pageIndex+1);			 								
			}else if ( ip==dataItemIndex ){
				//esta al final de la pagina, cambiar de página				
				nextCell=0;
				nextRow=-1;				
				$(tabId+" .grid_articulos").wijgrid('option','pageIndex',pageIndex+1);			 
				
			}
						
			nextRow	= nextRow + 1;			
			var cell;
			
			while (true)
			 {
				cell = $(tabId+" .grid_articulos").wijgrid('currentCell',nextCell, nextRow);
				if (cell.column == undefined ){					
					break;
					nextRow++;					 
				}else{						
					break;
				}
			}
			
		}
		
		
		var nuevo = $(tabId+" .grid_articulos").wijgrid("currentCell",nextCell, nextRow);
		
		if ( nuevo.column().editable===false ){			
			this.seleccionarSiguiente(e, alreves);
		}else{
			$(tabId+' .grid_articulos').wijgrid('doRefresh');
			$(tabId+" .grid_articulos").wijgrid("beginEdit");			
		}
		
		
		
	};
	this.configurarComboCodigo=function(target){		
		var tabId=this.tabId;
		var me=this;
		var fields=[			
			{name: 'presentacion'},
			{name: 'idarticulopre'},
			{name: 'nombre'},
			{name: 'existencia'},
			{name: 'minimo'},
			{name: 'maximo'},
			{name: 'grupo'},
			{name: 'puntoreorden'},
		{
			name: 'label',
			mapping: 'codigo'
		}, {
			name: 'value',
			mapping: 'id'
		}, {
			name: 'selected',
			defaultValue: false
		}];
		
		var myReader = new wijarrayreader(fields);
		
		var proxy = new wijhttpproxy({
			url: '/'+kore.modulo+'/pedidoi/getCodigos',
			dataType:"json"			
		});
		
		var datasource = new wijdatasource({
			reader:  new wijarrayreader(fields),
			proxy: proxy,
			loaded: function (data) {	
							
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
		
		var combo=target.wijcombobox({
			data: datasource,
			showTrigger: true,
			minLength: 1,
			forceSelectionText: false,
			autoFilter: true,
			// animationOptions: {
				// animated: "Drop",
				// duration: 1000
			// },
			
			search: function (e, obj) {
				
			},
			select: function (e, item) 
			{			
				var rowdom=$(me.tabId+' .grid_articulos tbody tr:eq('+me.selected.sectionRowIndex +')');				
				me.articulo=item;
				
				rowdom.find('td:eq(1) div').html(item.nombre);
				rowdom.find('td:eq(2) div').html(item.presentacion);
				rowdom.find('td:eq(3) div').html(item.maximo);
				rowdom.find('td:eq(4) div').html(item.minimo);
				rowdom.find('td:eq(5) div').html(item.puntoreorden);
				rowdom.find('td:eq(6) div').html(item.existencia);
				
				
				var reorden=parseInt( item.puntoreorden );
				var existencia=parseInt( item.existencia );
				var maximo=parseInt( item.maximo );
				var sugerido=0;
				var pendiente=0;
				if (existencia<=reorden){
					sugerido = maximo-existencia;					
				}
			
				rowdom.find('td:eq(7) div').html(sugerido);
				rowdom.find('td:eq(8) div').html(sugerido);
				rowdom.find('td:eq(9) div').html(0);
				me.articulo.pedido=sugerido;
				me.articulo.sugerido=sugerido;
				
				return true;
			}
		});
		combo.focus();			
	};
	
	
	this.nuevo=function(){	
		var rec={};
		
		$.each( this.columns, function(indexInArray, valueOfElement){			
			var campo=valueOfElement.dataKey;
			rec[campo]='';
		
		} );
		
		var nuevo=new Array(rec);
		
		var tabId=this.padre.tabId;
		var data= $(tabId+" .grid_articulos").wijgrid('data');									
		this.tmp_id++;
		nuevo[0].tmp_id=this.tmp_id;
		var array3 = nuevo.concat(data); // Merges both arrays
		data.length=0;
		for(var i=0; i<array3.length; i++){
			data.push( array3[i] );
		}

		//data.slice([]);
		
		$(tabId+" .grid_articulos").wijgrid("ensureControl", true);
		$(tabId+" .grid_articulos").wijgrid('option','pageIndex',0);			 
		nuevo = $(tabId+" .grid_articulos").wijgrid("currentCell", 0, 0);
		$(tabId+" .grid_articulos").wijgrid("beginEdit");
		
	};
	
	
	
	this.configurarToolbar=function(tabId){
		var me=this;
		
		$(this.tabId+ ' .btnAgregar').click(function(){		
			
			me.nuevo();
			
		});
	}
}