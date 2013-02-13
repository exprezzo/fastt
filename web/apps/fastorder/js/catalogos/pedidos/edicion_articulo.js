
var EdicionArticulo=function (tabId){
	
		
	this.init=function(tabId, padre, articulos){							
		this.tabId=tabId;
		this.padre=padre;
		//this.configurarFormulario(tabId);	
		this.configurarGrid(tabId, articulos);		
		return true;
		
		this.configurarComboDestino(tabId);
		this.configurarComboCodigo();
		this.configurarToolbar(tabId);		
		var me=this;
		
		$(this.tabId+' .frmEditInlinePedido .btnCancel').click(function(){			
			$(me.tabId+' .frmEditInlinePedido').css('visibility','hidden');				
		});				
		
		$(this.tabId+' .frmEditInlinePedido .btnGuardar').click(function(){						
			$(me.tabId+' .frmEditInlinePedido .txtDataItemIndex').val(-2);
			me.guardar();
		});
					
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
				
		$(me.tabId+' .frmEditInlinePedido input').bind('keyup', function(e) {
			var code = e.keyCode || e.which;
			code=parseInt(code);	
			if(e.keyCode==13){				
				me.guardar();
			}
		});		
		
		$(me.tabId+' .frmEditInlinePedido .txtPendiente').bind('keydown', function(e) {
			e.preventDefault();
			var code = e.keyCode || e.which;
			code=parseInt(code);
			if (code == 9) {								
				 var inputs=$(me.tabId+' .cmbCodigo + div[role="combobox"] input');
				 $(inputs[0]).focus();
				 me.guardar();
			}
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
		//alert("asd");
		var tabId=this.tabId;
		 
		var fields=[			
			{name: 'presentacion'},
			{name: 'idarticulopre'},
			{name: 'codigo'},
			{name: 'existencia'},
			{name: 'minimo'},
			{name: 'maximo'},
			{name: 'puntoreorden'},
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
			url: '/'+kore.modulo+'/pedidoi/getArticulos',
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
		
		// datasource.proxy.options.data={
			// id		:$(this.tabId+' .frmPedidoi .txtId').val(),
			// IdTmp	:$(this.tabId+' .frmPedidoi .txtIdTmp').val()
		// };
		
		// datasource.proxy.options.data={
			// id		:5,
			// IdTmp	:6
		// };
		
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
				return true;
				
				$('#tabs '+tabId+' .txtFkArticulo').val(item.value);
				$('#tabs '+tabId+' .txtIdArticuloPre').val(item.idarticulopre);
				$('#tabs '+tabId+' .txtPresentacion').val(item.presentacion);
				
				var testArray = [
					{value:item.value,label:item.codigo}
				];
				 var data=$('#tabs '+tabId+' .cmbCodigo').wijcombobox('option','data');				
				 data.data=testArray;
				 data.items=testArray;
				
				 $('#tabs '+tabId+' .cmbCodigo').wijcombobox('option','data',data);
				 $('#tabs '+tabId+' .cmbCodigo').wijcombobox('option','selectedIndex',0);				
				$('#tabs '+tabId+' .cmbCodigo').wijcombobox('option','text',item.codigo);
				
				$('#tabs '+tabId+' .txtMaximo').val(item.maximo);
				$('#tabs '+tabId+' .txtMinimo').val(item.minimo);
				$('#tabs '+tabId+' .txtPuntoReorden').val(item.puntoreorden);
				$('#tabs '+tabId+' .txtExistencia').val(item.existencia);
				
				var sugerido=0;
				
				sugerido= parseInt(item.puntoreorden) -  parseInt(item.existencia);				
				$('#tabs '+tabId+' .txtSugerido').val(sugerido);
				
				$('#tabs '+tabId+' .frmEditInlinePedido .txtPedido').val(sugerido); 
				$('#tabs '+tabId+' .frmEditInlinePedido .txtPendiente').val(0); 
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
			data: {datos:datos}
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
		/*var fields=[			
			{ name: "codigo"},			
			{ name: "nombre"},
			{ name: "presentacion"},
			{ name: "maximo"},
			{ name: "minimo"},
			{ name: "puntoreorden"},
			{ name: "existencia"},
			{ name: "nombreGpo"},
			{ name: "grupoposicion"},
			{ name: "sugerido"},
			{ name: "pedido"},
			{ name: "pendiente"},			
			{ name: "fk_articulo"},
			{ name: "id_tmp"  },
			{ name: "idarticulopre"},
			{ name: "id"  }
		];
		var dataReader = new wijarrayreader(fields);
		var me=this;
		var dataSource = new wijdatasource({
			proxy: new wijhttpproxy({
				url: '/'+kore.modulo+'/pedidoi/getListaArticulos',
				dataType: "json"				
			}),
			
			dynamic:false,			
			reader:new wijarrayreader(fields),
			loading: function(e, data) { 
				var id=$(me.tabId+' .frmPedidoi .txtId').val();					
				var fk_tmp=$(me.tabId+' .frmPedidoi .txtIdTmp').val();					
				var idalmacen=$(me.tabId+' .txtFkAlmacen').val();					
				
                me.dataSource.proxy.options.data.id=id;
				me.dataSource.proxy.options.data.fk_tmp=fk_tmp;
				me.dataSource.proxy.options.data.idalmacen=idalmacen;
				
				
			}
		});
		me.dataSource=dataSource;
		dataSource.reader.read= function (datasource) {		
			var totalRows=datasource.data.totalRows;			
			datasource.data = datasource.data.rows;
			datasource.data.totalRows = totalRows;
			dataReader.read(datasource);
		};				
		*/
		
		var gridPedidos=$('#tabs '+tabId+" .grid_articulos");				
		
		gridPedidos.bind('keydown', function(e) {
			var code = e.keyCode || e.which;
			code=parseInt(code);	
			if(e.keyCode==13){				
				alert("Enter");
				//me.guardar();
			}else if(e.keyCode==9){	
				e.preventDefault();
				var current = $(".grid_articulos").wijgrid("currentCell");
				console.log("current");  console.log(current); 
				
				//alert("ri: "+current.rowIndex()+" ci:"+current.cellIndex());
				
				var cellIdx=current.cellIndex();
				var rowIndex = current.rowIndex();
				switch(cellIdx){
					case 0:
						cellIdx=1;
					break;
					case 1:
						cellIdx=4;
					break;
					case 4:
						cellIdx=6;
					break;
					case 6:
						cellIdx=0;
						rowIndex=3;
					break;
				}
				
				var cellInfo= $(".grid_articulos").wijgrid("currentCell",cellIdx, rowIndex );
				console.log("cellInfo"); console.log(cellInfo); 
				$(".grid_articulos").wijgrid("beginEdit");
				
				
				// console.log("e"); console.log(e);
				// console.log("e.target"); console.log(e.target);
				
				// var parent=$(e.target).parent();
				// console.log("parent"); console.log(parent);
				
				// var sig = parent.next();
				// console.log("sig"); console.log(sig);
				// sig.focus();
				// gridPedidos.wijgrid("beginEdit");
				//me.editarSiguiente();
			}
		});
		
		
		gridPedidos.wijgrid({
			// dynamic: true,
			allowColSizing:true,
			allowPaging: true,
			pageSize:2,
			allowEditing:true,
			allowColMoving: true,
			//showGroupArea: true,
			allowKeyboardNavigation:true,			
			selectionMode:'singleRow',
			// data:dataSource,
			beforeCellEdit: function(e, args) { 
				
				console.log("args"); console.log(args);
				console.log(me);
				var positions=new Array();
				if (args.cell.column().editable === false){											
					//return false;
				}
				
				switch (args.cell.column().dataKey) { 
					case "codigo": 
						var combo=
						$("<input />")
							.val(args.cell.value()) 
							.appendTo(args.cell.container().empty());   
						args.handled = true;   
						me.configurarComboCodigo(combo);
					break; 
					case "nombre": 
						var combo=
						$("<input />")
							.val(args.cell.value()) 
							.appendTo(args.cell.container().empty());   
						args.handled = true;   
						me.configurarComboArticulo(combo);
					break; 
				} 
			}, 			
			data:articulos,
			columns: [ 
				{ dataKey: "codigo", headerText: "Codigo",width:"300px"},
				{dataKey: "nombre", headerText: "Art&iacute;culo",width:"300px"},
				{dataKey: "presentacion", headerText: "Presentacion", editable:false},
				{dataKey: "maximo", headerText: "L&iacute;mites",editable:false,
					cellFormatter: function (args) {
						if (args.row.type & $.wijmo.wijgrid.rowType.data) {
							args.$container
								.css("text-align", "center")
								.empty()
								.append($("<ul style='margin:0;padding:0;'><li>"+args.row.data.maximo+"</li><li>"+args.row.data.puntoreorden+"</li><li>"+args.row.data.minimo+"</li></ul>") 
								.addClass('stock_numbers')); 
							//args.row.data.Cover
							return true; 
						} 
					}
				},
				{dataKey: "minimo",  visible:false, headerText: "M&iacute;nimo",editable:false},
				{dataKey: "puntoreorden",visible:false,  headerText: "P Reorden",editable:false},
				{dataKey: "existencia", headerText: "I. Inicial"},
				{dataKey: "sugerido", headerText: "Sugerido",editable:false},
				{dataKey: "pedido", headerText: "Pedido"},
				{dataKey: "pendiente", headerText: "Pendiente",editable:false},						
				{ dataKey: "id", visible:false, headerText: "ID" },
				{ dataKey: "id_tmp", hidden:true, visible:false, headerText: "ID_TMP" },			
				{dataKey: "fk_articulo", headerText: "fk_articulo", visible:false},
				{dataKey: "fk_pedido", headerText: "fk_pedido", visible:false},
				{dataKey: "cantidad", headerText: "cantidad", visible:false},
				{dataKey: "idarticulopre", headerText: "idarticulopre", visible:false},
				{ visible:false, dataKey: "nombreGpo", groupInfo:{groupSingleRow: true,
					 position: "header", 
					outlineMode: "startExpanded", 
					headerText: "{0}"
				} },
				
				{ visible:false,dataKey: "grupoposicion"}
			],
			rowStyleFormatter: function(args) {
				if (args.dataRowIndex>-1)
					args.$rows.attr('rowId',args.data.id_tmp);
			},
			cellStyleFormatter: function(args) { 
			 if (args.column._originalDataKey=='fecha'){				
				 args.$cell.addClass("colFecha");				
			 }
			
			} 
		});		
		var me=this;
		gridPedidos.wijgrid({ beforeCellUpdate:function(e, args) { 
            switch (args.cell.column().dataKey) { 
                case "Position": 
                    args.value = args.cell.container().find("input").val(); 
                    break; 
  
                case "Acquired": 
                    var $editor = args.cell.container().find("input"), 
                        value = $editor.wijinputnumber("getValue"), 
                        curYear = new Date().getFullYear(); 
  
                    if (value < 1990 || value > curYear) { 
                        $editor.addClass("ui-state-error") 
  
                        alert("value must be between 1990 and " + curYear); 
  
                        $editor.focus(); 
  
                        return false; 
                    } 
                      
                    args.value = value; 
                    break; 
            } 
        } });
		
		gridPedidos.wijgrid({ selectionChanged: function (e, args) { 					
			
			
			var item=args.addedCells.item(0);
			
			var row=item.row();			
			var data=row.data;			
			me.selected=data;			
			me.selected.dataItemIndex=row.dataItemIndex;
			
		} });
		
		gridPedidos.wijgrid({ loaded: function (e) {
			// $(me.tabId+' .grid_articulos tbody tr:first-child div').focus();			
			if (me.selected != undefined && me.selected.editandoId != undefined){
				var position = $(me.tabId + ' tr[rowId="'+me.selected.editandoId+'"]').position();				
				$(me.tabId+' .frmEditInlinePedido').css('top',position.top+'px');	
			}			
		
			$(tabId+' .grid_articulos tbody tr').bind('dblclick', function (e) { 																											                
				
				
				console.log("e"); console.log(e);
				// var w=$(me.tabId+' table.grid_articulos th:eq(0)').width();
				// $(me.tabId+' .frmEditInlinePedido form  > input.txtCodigo').css('width',w-5);			
				
				// var w=$(me.tabId+' table.grid_articulos th:eq(1)').width();
				// $(me.tabId+' .frmEditInlinePedido form  > div:eq(0)').css('width',w-5);				
				
				 // w=$(me.tabId+' table.grid_articulos th:eq(1)').width();
				// $(me.tabId+' .frmEditInlinePedido form  > div:eq(2)').css('width',w);				
				// $(me.tabId+' .frmEditInlinePedido form  .txtCantidad').css('width',w-25);				
				
				// var w=$(me.tabId+' table.grid_articulos th:eq(2)').width();
				// $(me.tabId+' .frmEditInlinePedido form  > div:eq(3)').css('width',w-5);				
				
				me.editar(e.currentTarget);
			});			
		} });
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
				//me.articuloSeleccionado=item;
				
				$('#tabs '+tabId+' .txtFkArticulo').val(item.value);
				$('#tabs '+tabId+' .txtIdArticuloPre').val(item.idarticulopre);
				$('#tabs '+tabId+' .txtPresentacion').val(item.presentacion);
				
				var testArray = [
					{value:item.value, label:item.nombre}
				];
				var data=$('#tabs '+tabId+' .cmbArticulo').wijcombobox('option','data');				
				
				data.data=testArray;
				data.items=testArray;
				
				$('#tabs '+tabId+' .cmbArticulo').wijcombobox('option','data',data);
				$('#tabs '+tabId+' .cmbArticulo').wijcombobox('option','selectedIndex',0);
				$('#tabs '+tabId+' .cmbArticulo').wijcombobox('option','text',item.nombre);				
				
				//$('#tabs '+tabId+' .txtFkArticulo').val(item.value);
				$('#tabs '+tabId+' .txtMaximo').val(item.maximo);
				$('#tabs '+tabId+' .txtMinimo').val(item.minimo);
				$('#tabs '+tabId+' .txtPuntoReorden').val(item.puntoreorden);
				$('#tabs '+tabId+' .txtExistencia').val(item.existencia);
				
				var sugerido=0;
				
				sugerido= parseInt(item.puntoreorden) -  parseInt(item.existencia);				
				$('#tabs '+tabId+' .txtSugerido').val(sugerido);
				
				$('#tabs '+tabId+' .frmEditInlinePedido .txtPedido').val(sugerido); 
				$('#tabs '+tabId+' .frmEditInlinePedido .txtPendiente').val(0); 
			}
		});
		combo.focus();			
	};
	this.configurarComboUM=function(){		
		var tabId=this.tabId;
		var fields=[{
			name: 'label',
			mapping: 'nombre'
		}, {
			name: 'value',
			mapping: 'id'
		}, {
			name: 'selected',
			defaultValue: false
		}];
		
		var myReader = new wijarrayreader(fields);
		
		var proxy = new wijhttpproxy({
			url: '/'+kore.modulo+'/pedidoi/getUnidadesMedida',
			dataType:"json"			
		});
		
		var datasource = new wijdatasource({
			reader:  new wijarrayreader(fields),
			proxy: proxy,
			loaded: function (data) {	
				//Seleccionar elemento
				// var val=$('#tabs '+tabId+' .txtFkAlmacen').val();
				// $.each(data.items, function(index, datos) {					
					// if (parseInt(val)==parseInt(datos.id) ){						
						// $('#tabs '+tabId+' .cmbAlmacen').wijcombobox({selectedIndex:index});
					// }
				// });				
			}
		});
		
		datasource.reader.read= function (datasource) {			
			var totalRows=datasource.data.totalRows;			
			datasource.data = datasource.data.rows;
			datasource.data.totalRows = totalRows;
			myReader.read(datasource);
		};			
		
		datasource.load();	
		var combo=$(tabId+' .cmbUm').wijcombobox({
			data: datasource,
			showTrigger: true,
			minLength: 1,
			autoFilter: false,
			animationOptions: {
				animated: "Drop",
				duration: 1000
			},
			
			search: function (e, obj) {
				//obj.datasrc.proxy.options.data.name_startsWith = obj.term.value;
			},
			select: function (e, item) {				
				
				$('#tabs '+tabId+' .txtFkUm').val(item.value);
			}
		});
						
	};
	this.configurarComboDestino=function(tabId){		
		var fields=[{
			name: 'label',
			mapping: function (item) {
				return item.nombre;
			}
		}, {
			name: 'value',
			mapping: 'id'
		}, {
			name: 'selected',
			defaultValue: false
		}];
		
		var myReader = new wijarrayreader(fields);
		
		var proxy = new wijhttpproxy({
			url: '/'+kore.modulo+'/pedidoi/getArticulos',
			dataType:"json"			
		});
		
		var datasource = new wijdatasource({
			reader:  new wijarrayreader(fields),
			proxy: proxy,
			loaded: function (data) {	
				//Seleccionar elemento
				// var val=$('#tabs '+tabId+' .txtFkAlmacen').val();
				// $.each(data.items, function(index, datos) {					
					// if (parseInt(val)==parseInt(datos.id) ){						
						// $('#tabs '+tabId+' .cmbAlmacen').wijcombobox({selectedIndex:index});
					// }
				// });				
			}
		});
		
		datasource.reader.read= function (datasource) {			
			var totalRows=datasource.data.totalRows;			
			datasource.data = datasource.data.rows;
			datasource.data.totalRows = totalRows;
			myReader.read(datasource);
		};			
		
		datasource.load();	
		var combo=$(tabId+' .cmbDestino').wijcombobox({
			data: datasource,
			showTrigger: true,
			minLength: 1,
			// animationOptions: {
				// animated: "Drop",
				// duration: 1000
			// },
			forceSelectionText: false,
			search: function (e, obj) {
				//obj.datasrc.proxy.options.data.name_startsWith = obj.term.value;
			},
			select: function (e, item) {				
				//$('#tabs '+tabId+' .txtFkAlmacen').val(item.id);				
			}
		});
		
		
		// var animationOptions = {
			 // animated: "Drop",
			 // duration: 1000
		// };
		// combo.wijcombobox("option", "showingAnimation", animationOptions);		
		// combo.wijcombobox("option", "hidingAnimation", animationOptions);
	};
	this.mostrarTabArticulos=function(){
		//Posicionar tab Edicion articulo
		this.mostrarTab(0);
	};
	this.nuevo=function(){		
		var me=this;
		
		$(me.tabId+' .frmEditInlinePedido .txtIdTmp').val(0);
		// $(me.tabId+' .frmEditInlinePedido .txtMaximo').val(0);
		// $(me.tabId+' .frmEditInlinePedido .txtMinimo').val(0);
		// $(me.tabId+' .frmEditInlinePedido .txtPuntoReorden').val(0);
		 $(me.tabId+' .frmEditInlinePedido .divNumerosStock ').html(0);
		$(me.tabId+' .frmEditInlinePedido .txtExistencia').val(0);
		$(me.tabId+' .frmEditInlinePedido .txtPedido').val(0);
		$(me.tabId+' .frmEditInlinePedido .txtSugerido').val(0);
		$(me.tabId+' .frmEditInlinePedido .txtPendiente').val(0);				
		$(me.tabId+' .frmEditInlinePedido').css('top','38px');
		$(me.tabId+' .frmEditInlinePedido .txtId').val(0);		
		$(me.tabId+' .frmEditInlinePedido .txtFkArticulo').val(0);				
		$(me.tabId+' .frmEditInlinePedido .cmbArticulo').wijcombobox("option", "text", '');			
		$(me.tabId+' .frmEditInlinePedido .cmbCodigo').wijcombobox("option", "text", '');					
		$(me.tabId+' .frmEditInlinePedido .txtIdArticuloPre').val(0);
		$(me.tabId+' .frmEditInlinePedido .txtPresentacion').val(''); 		
		$(this.tabId+' .frmEditInlinePedido .txtDataItemIndex').val(-1);
		
		
		var position = $(me.tabId+' table.grid_articulos thead > tr').position();				
		var h = $(me.tabId+' table.grid_articulos thead > tr').height();
		$(me.tabId+' .frmEditInlinePedido').css('visibility','visible');				
		$(me.tabId+' .frmEditInlinePedido').css('top',position.top+h);	
		
		me.mostrarEditor();
		
	};
	this.editar=function(target){		
		//Cargar los datos en el editor
		
		if (this.selected ==undefined) return false;
		
			
		$(this.tabId+' .frmEditInlinePedido .txtId').val(this.selected.id);
		$(this.tabId+' .frmEditInlinePedido .txtIdTmp').val(this.selected.id_tmp);
		$(this.tabId+' .frmEditInlinePedido .txtPedido').val(this.selected.pedido);
		// $(this.tabId+' .frmEditInlinePedido .txtMaximo').val(this.selected.maximo);
		// $(this.tabId+' .frmEditInlinePedido .txtMinimo').val(this.selected.minimo);
		// $(this.tabId+' .frmEditInlinePedido .txtPuntoReorden').val(this.selected.puntoreorden);
		
		var ul="<ul> <li>";
		ul+=this.selected.maximo+"</li><li>"+this.selected.puntoreorden+"</li><li>";
		ul+=this.selected.minimo+"</li></ul>";
		$(this.tabId+' .frmEditInlinePedido .divNumerosStock').html(ul);
		
		
		
		
		$(this.tabId+' .frmEditInlinePedido .txtExistencia').val(this.selected.existencia);
		
		//$(this.tabId+' .frmEditInlinePedido .txtCantidad').wijinputnumber('setText',this.selected.cantidad);
		
		$(this.tabId+' .frmEditInlinePedido .txtFkArticulo').val(this.selected.fk_articulo);				
		$(this.tabId+' .frmEditInlinePedido .cmbArticulo').wijcombobox("option", "text", this.selected.nombre);			
		$(this.tabId+' .frmEditInlinePedido .cmbCodigo').wijcombobox("option", "text", this.selected.codigo);					
		$(this.tabId+' .frmEditInlinePedido .txtDataItemIndex').val(this.selected.dataItemIndex);
		
		// var testArray = [
			// {value:this.selected.fk_articulo,label:this.selected.nombre, id:this.selected.fk_articulo,nombre:this.selected.nombre}
		// ];
		// var data=$('#tabs '+this.tabId+' .cmbArticulo').wijcombobox('option','data');				
		// data.data=testArray;
		// data.items=testArray;
		// $('#tabs '+this.tabId+' .cmbArticulo').wijcombobox('option','data',data);
		// $('#tabs '+this.tabId+' .cmbArticulo').wijcombobox('option','selectedIndex',0);
		
		var focused = $(':focus');
		$(focused).select();
		
		$(this.tabId+' .frmEditInlinePedido .txtIdArticuloPre').val(this.selected.idarticulopre);
		$(this.tabId+' .frmEditInlinePedido .txtPresentacion').val(this.selected.presentacion); //
		//$(this.tabId+' .frmEditInlinePedido .txtCodigo').val(this.selected.codigo); 
		
		var sugerido = parseInt(this.selected.puntoreorden) - parseInt(this.selected.existencia);
		$(this.tabId+' .frmEditInlinePedido .txtSugerido').val(sugerido); 
		//$(this.tabId+' .frmEditInlinePedido .txtPedido').val(sugerido); 
		$(this.tabId+' .frmEditInlinePedido .txtPendiente').val(sugerido - this.selected.pedido); 
		
		this.calcularSugerencia();
		
		
		target=$(this.tabId + ' tr[rowId="'+this.selected.id_tmp+'"]');
		console.log("target"); console.log(target);
		 var position = $(this.tabId + ' tr[rowId="'+this.selected.id_tmp+'"]').position();						
		  $(this.tabId+' .frmEditInlinePedido').css('top',position.top+'px');	
		 $(this.tabId+' .frmEditInlinePedido').css('visibility','visible');				
		
				
		this.mostrarEditor(target[0]);
		
	};
	this.mostrarEditor=function(target){		
		//$(this.tabId+' .frmEditInlinePedido').css('visibility','visible');				
		
		var me=this;
		var todos = $(me.tabId+' .frmEditInlinePedido form > *');								
		var styles,w;
		var found;
		var editores=new Array();				
		for (var i=0; i<todos.length; i++){
			if ( $(todos[i]).attr("type")=='hidden' ){
				continue;
			}					
			styles = $(todos[i]).attr("style");
			if (styles==undefined){
				editores.push( $(todos[i]) );
				continue;					
			}															
			styles = $(todos[i]).attr("style").split(";");					
			found = false;					
			for (var ixS = 0; ixS < styles.length; ixS++) {					
				if ( styles[ixS].trim().replace(' ','')==='display:none') {							
					found = true;
					break;
				}
			}
			if (found == false){						
				editores.push( $(todos[i]) );						
			}
		}
		var cel,w,h;
		
		for(var i=0; i<editores.length; i++){				
			cel=$(target).find('td:eq('+i+')');
			w=cel.width();
			h=cel.height();
		
			// w=$(me.tabId+' table.grid_articulos tbody tr td:eq('+i+')').width();					
			
			$(editores[i]).css('width',w-3);				
			$(editores[i]).css('height',h);				
			
			position=cel.position();
			$(editores[i]).position(position);				
		}
		
		$(this.tabId+' .frmEditInlinePedido div[role="combobox"] input').height(h-8);
		$(this.tabId+' .frmEditInlinePedido .cmbArticulo').wijcombobox('repaint');						
		$(this.tabId+' .frmEditInlinePedido .cmbCodigo').wijcombobox('repaint');				
		
		
	};
	// this.mostrarTabEdicionArticulo=function(){
		// var data=this.selected;
		// this.mostrarTab(1, data);
	// };
	this.mostrarTab=function(tabIndex, data){
		
		var tabId = this.tabId;
		var elJQ=$(tabId+' .pnlArticulos');
		var alto= elJQ.height();
		var ancho= elJQ.width();
		var position = elJQ.position();		
		
		var pnlArt=$(tabId+' .pnlEdicionArticulo');		
		pnlArt.width(ancho);
		pnlArt.height(alto);
		pnlArt.css('top',position.top);
		pnlArt.css('left',position.left);
		//pnlArt.css('z-index',10);
		if (tabIndex==0){
			pnlArt.css('visibility','hidden');
			$(tabId+' .pnlArticulos').css('visibility','visible');
		}else if (tabIndex==1){
			pnlArt.css('visibility','visible');
			$(tabId+' .pnlArticulos').css('visibility','hidden');
			
		}		
	};
	this.configurarToolbar=function(tabId){
		var me=this;
		$(this.tabId+ ' .btnAgregar').click(function(){		
			me.nuevo();
		});
	}
}