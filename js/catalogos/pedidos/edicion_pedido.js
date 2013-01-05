var EdicionPedido={	
	init:function(tabId, pedidoId, almacen){		
		tabId = '#'+tabId;
		var tab=$('div'+tabId);
		$('div'+tabId).css('padding','0');
		$('div'+tabId).css('border','0 1px 1px 1px');
		
		var tab=$('a[href="'+tabId+'"]');		
		tab.addClass('frmPedido');
		
		//Para identificar el contenido del tab
		//var objId='pedidoi_id_'+pedidoId;								
		//$('#tabs '+tabId).attr('objId',objId);
		
		//Establecer titulo e icono
		if (pedidoId>0){
			$('a[href="'+tabId+'"]').html('Pedido '+almacen+' ID: '+pedidoId);		
		}else{
			$('a[href="'+tabId+'"]').html('Nuevo Pedido');
		}
		
		this.configurarFormulario(tabId);
		this.configurarToolbar(tabId);
		this.configurarListaArticulos(tabId);
	},
	// cargarValoresIniciales:function(){
	// },
	guardar:function(tabId){
		var tab = $('#tabs '+tabId);
		
		var pedido={
			id		: tab.find('.txtId').val(),
			almacen	: tab.find('.txtFkAlmacen').val(),
			fecha	: tab.find('.txtFecha').val()
		};
		
		//Envia los datos al servidor, el servidor responde success true o false.
		
		$.ajax({
			type: "POST",
			url: '/pedidoi/guardar',
			data: { pedido: pedido}
		}).done(function( response ) {
			
			var resp = eval('(' + response + ')');
			var msg= (resp.msg)? resp.msg : '';
			var title;
			if ( resp.success == true	){
				icon='/images/yes.png';
				title= 'Success';
				
				tab.find('.txtId').val(resp.datos.id),
				tab.find('.txtFkAlmacen').val(resp.datos.fk_almacen),
				tab.find('.txtFecha').wijinputdate('option','date', resp.datos.fecha); 
				
				
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
	},
	editar:function(){
		alert("editar");
	},
	eliminar:function(){
		alert("editar");
	},
	configurarToolbar:function(tabId){
		$('#tabs '+tabId+' .btnGuardar')
		.button()
		.click(function () {			
			this.guardar(tabId);
			//Obtiene los datos de las cajas de texto.			
		}); 
		
		$('#tabs '+tabId+' .btnNuevo')
		.button()
		.click(function () {				
			TabManager.add('/pedidoi/nuevoPedido', 'Nuevo Pedido');
		});
		
		$('#tabs '+tabId+' .btnEliminar')
		.button()
		.click(function () {							
			$.gritter.add({				
				title:'Error',
				text: 'Todavia no se implementa',
				image: '/images/error.png',
				class_name: 'my-sticky-class'
			});
		});
	},
	configurarFormulario:function(tabId){
		$('#tabs '+tabId+' .txtFecha').wijinputdate({ dateFormat: 'd/M/yyyy', showTrigger: true});		
		
		//COMBO
		
		var fields=[{
			name: 'label',
			mapping: function (item) {
				return item.label;
			}
		}, {
			name: 'value',
			mapping: 'label'
		}, {
			name: 'selected',
			defaultValue: false
		},{name:'id'}];
		
		var myReader = new wijarrayreader(fields);
		
		var proxy = new wijhttpproxy({
			url: "/pedidoi/getAlmacenes",
			dataType:"json"			
		});
		
		var datasource = new wijdatasource({
			reader:  new wijarrayreader(fields),
			proxy: proxy,
			loaded: function (data) {				
				var val=$('#tabs '+tabId+' .txtFkAlmacen').val();
				$.each(data.items, function(index, datos) {					
					if (parseInt(val)==parseInt(datos.id) ){						
						$('#tabs '+tabId+' .cmbAlmacen').wijcombobox({selectedIndex:index});
					}
				});				
			}
		});
		
		datasource.reader.read= function (datasource) {			
			var totalRows=datasource.data.totalRows;			
			datasource.data = datasource.data.rows;
			datasource.data.totalRows = totalRows;
			myReader.read(datasource);
		};			
		
		datasource.load();	
		var combo=$('#tabs '+tabId+' .cmbAlmacen').wijcombobox({
			data: datasource,
			showTrigger: true,
			minLength: 1,
			animationOptions: {
				animated: "Drop",
				duration: 1000
			},
			forceSelectionText: true,
			search: function (e, obj) {
				//obj.datasrc.proxy.options.data.name_startsWith = obj.term.value;
			},
			select: function (e, item) {				
				$('#tabs '+tabId+' .txtFkAlmacen').val(item.id);				
			}
		});
		
		
		var animationOptions = {
			 animated: "Drop",
			 duration: 1000
		};
		combo.wijcombobox("option", "showingAnimation", animationOptions);		
		combo.wijcombobox("option", "hidingAnimation", animationOptions);
		
		
		
	},
	configurarListaArticulos:function(tabId){		
	
		var dataReader = new wijarrayreader([
			{ name: "id"  },
			{ name: "nombre"}
		]);

		var dataSource = new wijdatasource({
			proxy: new wijhttpproxy({
				url: "/pedidoi/getArticulos",
				dataType: "json"				
			}),
			dynamic:true,			
			reader:new wijarrayreader([
				 { name: "id"},
				 { name: "nombre"}
			])							
		});
		
		dataSource.reader.read= function (datasource) {		
			var totalRows=datasource.data.totalRows;			
			datasource.data = datasource.data.rows;
			datasource.data.totalRows = totalRows;
			dataReader.read(datasource);
		};				
			
		var gridPedidos=$('#tabs '+tabId+" .grid_articulos");
		
		// gridPedidos.wijgrid();
		
		gridPedidos.wijgrid({
			dynamic: true,
			allowColSizing:true,
			//allowEditing:false,
			allowKeyboardNavigation:true,
			allowPaging: true,
			pageSize:6,
			selectionMode:'singleRow',
			data:dataSource,
			beforeCellEdit: this.beforeCellEdit, 
			columns: [ { dataKey: "id", hidden:true, visible:false, headerText: "ID" },{dataKey: "nombre", headerText: "Articulo"},{dataKey: "c", headerText: "Cantidad"}],
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

	},
	configurarToolbar:function(tabId){		
		$(tabId+ "> .tbPedido").wijribbon({
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
				}
				
			}
		});
		
		$(tabId+ " div > .ribbon").wijribbon({
			click: function (e, cmd) {
				switch(cmd.commandName){
					case 'nuevo':
						alert("Nuevo Articulo");
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
				}
				
			}
		});
	}
	
}