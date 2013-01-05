var EdicionArticulo={	
	init:function(tabId){
		tabId = '#'+tabId;		
		this.configurarFormulario(tabId);		
	},	
	configurarFormulario:function(tabId){
		 $(tabId+" .txtCantidad").wijinputnumber( 
        {
            type: 'numeric',
            minValue: -100,
            maxValue: 1000,
            decimalPlaces: 4,
            showSpinner: true
        });		
		this.configurarComboArticulos(tabId);
		this.configurarComboUM(tabId);
	},
	configurarComboArticulos:function(tabId){		
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
			url: "/pedidoi/getArticulos",
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
		var combo=$(tabId+' .cmbArticulo').wijcombobox({
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
				//$('#tabs '+tabId+' .txtFkAlmacen').val(item.id);				
			}
		});
		
		
		var animationOptions = {
			 animated: "Drop",
			 duration: 1000
		};
		combo.wijcombobox("option", "showingAnimation", animationOptions);		
		combo.wijcombobox("option", "hidingAnimation", animationOptions);
	}
	,configurarComboUM:function(tabId){		
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
			url: "/pedidoi/getUnidadesMedida",
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
		var combo=$(tabId+' .cmbUM').wijcombobox({
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
				//$('#tabs '+tabId+' .txtFkAlmacen').val(item.id);				
			}
		});
		
		
		var animationOptions = {
			 animated: "Drop",
			 duration: 1000
		};
		combo.wijcombobox("option", "showingAnimation", animationOptions);		
		combo.wijcombobox("option", "hidingAnimation", animationOptions);
	}
}