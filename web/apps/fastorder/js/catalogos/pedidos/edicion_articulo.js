
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
		var fields=[			
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
		
		var rec={};
		
		$.each( fields, function(indexInArray, valueOfElement){
			var campo=valueOfElement.name;
			rec[campo]='';
		
		} );
		this.rec=rec;
		/*
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
		
		var me=this;
		gridPedidos.bind('keydown', function(e) {
			var code = e.keyCode || e.which;
			code=parseInt(code);	
			if(e.keyCode==13){	
				 var cellInfo= $(tabId+" .grid_articulos").wijgrid("currentCell");				
				 cellIndex=cellInfo.cellIndex();							
				 rowIndex = cellInfo.rowIndex();							
				 // me.seleccionarSiguiente(true, rowIndex+1);
				 // me.guardar();
			}else if(e.keyCode==9  && e.shiftKey){	
				e.preventDefault();								
				me.seleccionarSiguiente(true);				
			}else if(e.keyCode==9 ){	
				e.preventDefault();								
				me.seleccionarSiguiente();				
			}
		});
		
		
		gridPedidos.wijgrid({
			// dynamic: true,
			allowColSizing:true,
			allowPaging: true,
			pageSize:9,
			allowEditing:true,
			allowColMoving: true,
			//showGroupArea: true,
			allowKeyboardNavigation:true,
			selectionMode:'singleRow',
			// data:dataSource,
			beforeCellEdit: function(e, args) {
				var row = args.cell.row() ;
				
				if (args.cell.column().editable === false){
					return false;
				}				

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
					case "nombre": 
						var combo=
						$("<input />")
							.val(args.cell.value()) 
							.appendTo(args.cell.container().empty());   
						
						var domCel = args.cell.tableCell();
						combo.css('width',	$(domCel).width()-10 );
						combo.css('height',	$(domCel).height()-10 );
						
						args.handled = true;   
						me.configurarComboArticulo(combo);
					break; 
					default:
						var input=$("<input />")
							.val(args.cell.value()) 
							.appendTo(args.cell.container().empty()).focus();   							
							
						var domCel = args.cell.tableCell();						
						input.css('width',	$(domCel).width()-10 );
						input.css('height',	$(domCel).height()-10 );
						args.handled = true;   
						return true;
					break;						
				} 
			}, 			
			data:articulos,
			columns: [ 
				{ dataKey: "codigo", headerText: "Codigo",width:"300px"},
				{dataKey: "nombre", headerText: "Art&iacute;culo",width:"300px"},
				{dataKey: "presentacion", headerText: "Presentacion", editable:false},
				// {dataKey: "maximo", headerText: "L&iacute;mites",editable:false,
					// cellFormatter: function (args) {
						// if (args.row.type & $.wijmo.wijgrid.rowType.data) {
							// args.$container
								// .css("text-align", "center")
								// .empty()
								// .append($("<ul style='margin:0;padding:0;'><li>"+args.row.data.maximo+"</li><li>"+args.row.data.puntoreorden+"</li><li>"+args.row.data.minimo+"</li></ul>") 
								// .addClass('stock_numbers')); 							
							// return true; 
						// } 
					// }
				// },
				{dataKey: "maximo",  visible:true, headerText: "M&aacute;ximo",editable:false},
				{dataKey: "minimo",  visible:true, headerText: "M&iacute;nimo",editable:false},
				{dataKey: "puntoreorden",visible:true,  headerText: "Reorden",editable:false},
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
                        $editor.addClass("ui-state-error");  
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
				// me.editar(e.currentTarget);
			});			
		} });
				
		this.numCols=$(tabId+' .grid_articulos thead th').length;
		
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
	this.seleccionarSiguienteOld = function(saltoLinea,nextRow ){
		//Obtengo la celda seleccionada					
		var idxNuevo, tabId, cellInfo, cellIndex, rowIndex, todoBien;
		tabId=this.tabId;
		cellInfo= $(tabId+" .grid_articulos").wijgrid("currentCell");		
		
		if (cellInfo.cellIndex){
			cellIndex=cellInfo.cellIndex();							
			rowIndex = cellInfo.rowIndex();					
			idxNuevo=cellIndex+1;					
		}			
		
		if (saltoLinea===true){			
			rowIndex=nextRow;
			idxNuevo=0;
		}
		var nuevo= $(tabId+" .grid_articulos").wijgrid("currentCell", idxNuevo, rowIndex );				
		
		if ( nuevo.column == undefined ||  cellIndex == nuevo.cellIndex()   ){
			//seleccionar siguiente renglon o agregar un nuevo registro.						
			this.seleccionarSiguiente(true, rowIndex + 1);
		}else if ( nuevo.column().editable===false ){									
			this.seleccionarSiguiente();
		}else if ( nextRow && nuevo.rowIndex && nuevo.rowIndex() < nextRow){				
			var data= $(tabId+" .grid_articulos").wijgrid('data');			
			//revisar si el numero de regisrtos excede el numero pageSize para cambiar a la pagina correspondiente.			
			data.push([]);
			$(tabId+" .grid_articulos").wijgrid("ensureControl", true);
			nuevo = $(tabId+" .grid_articulos").wijgrid("currentCell", 0, nextRow +1);
			$(tabId+" .grid_articulos").wijgrid("beginEdit");
			// this.seleccionarSiguiente(true, nextRow);
			// return false;
		}else{
			//todoBien=true;
			$(tabId+" .grid_articulos").wijgrid("beginEdit");
		}		
		
		
	};
	this.seleccionarSiguiente = function(alreves, saltar){
		//dos direcciones, hacia atras y hacia adelante.
		//de la ultima caja editable de la fila, pasa a la siguiente fila.
		//si se esta navegando alreves, del primer registro editable, pasa al registro anterior.
		//si no hay otra fila, agrega un nuevo elemento.
		//si est� ubicado en el ultimo elemento de la pagina, pasar a la pagina siguiente .
		//si est� nvegando alrev�s, y est� ubicado en el primer elemento de la pagina, pasar a la pagina anterior.
		
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
		} else if ( nextCell>=this.numCols ){
			nextCell=0;
			//ir al registro siguiente, cambiar de pagina o agregar nuevo registro,
			row=cellInfo.row();			
			var data = $(tabId+" .grid_articulos").wijgrid('data');			 
			var pageSize = $(tabId+" .grid_articulos").wijgrid('option','pageSize');
			var pageIndex = $(tabId+" .grid_articulos").wijgrid('option','pageIndex');			 
			//voy a ver si es el ultimo registro de la pagina
			dataItemIndex = row.dataItemIndex;
			var ip= (pageSize * pageIndex) - dataItemIndex;
			
			if ( (dataItemIndex+1) == data.length ){ 
				//esta en el ultimo registro de la ultima pagina
				//agregar nuevo, si esta al final de la pagina, despues de agregar registro, mover a la siguiente pagina
				data.push(this.rec);
				$(tabId+" .grid_articulos").wijgrid("ensureControl", true);
				$(tabId+" .grid_articulos").wijgrid('option','pageIndex',pageIndex+1);			 				
			}else if ( (ip+1) == pageSize ){
				//esta al final de la pagina, cambiar de pagina
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
					nextRow++;
				}else{						
					break;
				}
			}
			
		}
		
		var nuevo = $(tabId+" .grid_articulos").wijgrid("currentCell",nextCell, nextRow);
		
		if ( nuevo.column().editable===false ){
			this.seleccionarSiguiente(alreves);
		}else{
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
				return true;
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
	
	
	this.nuevo=function(){	
		
		var tabId=this.padre.tabId;
		var data= $(tabId+" .grid_articulos").wijgrid('data');							
		var nuevo=new Array(this.rec);
		this.tmp_id++;
		nuevo[0].tmp_id=this.tmp_id;
		var array3 = nuevo.concat(data); // Merges both arrays
		data.length=0;
		for(var i=0; i<array3.length; i++){
			data.push( array3[i] );
		}

		data.slice([]);
		
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