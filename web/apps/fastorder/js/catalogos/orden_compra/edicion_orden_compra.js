var EdicionOrdenCompra = function(){
	this.editado=false;
	this.saveAndClose=false;
	
	this.activate=function(){
		var tabId=this.tabId;
		var w=$(tabId+' .lblAlmacen').width();		
		$(tabId+' .lblSerie').width(w);
	}
	this.close=function(){
		
		if (this.editado){
			var res=confirm('¿Guardar antes de salir?');
			if (res===true){
				this.saveAndClose=true;
				this.guardar();
				return false;
			}else{
				return true
			}
		}else{
			return true;
		}
	};
	this.init=function(tabId, pedidoId, almacen, articulos){
		this.controlador={
			nombre:'orden_compra'
		}
		
		this.tabId= '#'+tabId;		
		
		
		var tab=$('div'+this.tabId);
		//estas dos linas deben estar en la hoja de estilos
		tab.css('padding','0');
		tab.css('border','0 1px 1px 1px');
		
		this.agregarClase('frmPedido');
		this.agregarClase('frmOrdenCompra');		
		
		this.configurarFormulario(this.tabId);
		this.configurarToolbar(this.tabId);		
		// this.notificarAlCerrar();			
		this.actualizarTitulo();
		
		//http://www.openjs.com/scripts/events/keyboard_shortcuts/
		
		var me=this;
		$(this.tabId + '.frmPedidoi input').change(function(){
			me.editado=true;		
		});
		tab.data('tabObj',this);
		 
		
		
		var frmEdicionArticulo = new EdicionArticulo();
		frmEdicionArticulo.init(this.tabId, this, articulos);
		
	};
	//esta funcion pasara al plugin
	//agrega una clase al panel del contenido y a la pestaña relacionada.
	
	this.agregarClase=function(clase){
		var tabId=this.tabId;		
		var tab=$('div'+this.tabId);						
		tab.addClass(clase);		
		tab=$('a[href="'+tabId+'"]');
		tab.addClass(clase);
	}
	this.notificarAlCerrar=function(){
		var tabId = this.tabId;
		 $('#tabs > ul a[href="'+tabId+'"] + span').click(function(e){
			//e.preventDefault();
			 var tmp=$('.frmPedidoi .txtIdTmp');				
			if (tmp.length==1){
				var id=$(tmp[0]).val();				
				$.ajax({
					type: "POST",
					url: '/'+kore.modulo+'/pedidoi/cerrar',
					data: { id:id }
				}).done(function( response ) {
					
				});
			}	
		 });
	}
	this.actualizarTitulo=function(){
		var tabId = this.tabId;		
		var pedidoId = $(tabId + ' .txtId').val();
		
		if (pedidoId>0){
			var serie = $(tabId+' .cmbSerie').wijcombobox( 'option', 'text');						
			var folio = $(tabId+' .txtFolio').val();			
			$('a[href="'+tabId+'"]').html('OC:'+serie+' '+folio);		
			$(tabId+' .cmbAlmacen').wijcombobox( 'option', 'disabled', true );
			$(tabId+' .cmbSerie').wijcombobox( 'option', 'disabled', true );
		}else{
			$('a[href="'+tabId+'"]').html('Nueva Orden de Compra');
		}
	}
	this.nuevo=function(){
		var tabId=this.tabId;
		var tab = $('#tabs '+tabId);
		$('a[href="'+tabId+'"]').html('Nuevo Pedido');
		tab.find('.txtId').val(0);
		me.editado=false;
	};	
	this.guardar=function(){
		var tabId=this.tabId;
		var tab = $('#tabs '+tabId);
		var me=this;
		var articulos=$(tabId+' .grid_articulos').wijgrid('data');
		 console.log('articulos'); console.log(articulos);
		// return false;
		
		var pedido={
			id			: tab.find('.txtId').val(),
			IdTmp		: tab.find('.txtIdTmp').val(),
			almacen		: tab.find('.txtFkAlmacen').val(),
			fecha		: tab.find('.txtFecha').val(),
			fk_serie	: tab.find('.txtFkSerie').val(),
			vencimiento	: tab.find('.txtVencimiento').val(),
			folio		: tab.find('.txtFolio').val(),
			proveedor	: tab.find('.txtFkProveedor').val(),
			articulos	: articulos
		};
		
		//Envia los datos al servidor, el servidor responde success true o false.
		
		$.ajax({
			type: "POST",
			url: '/'+kore.modulo+'/'+this.controlador.nombre+'/guardar',
			data: { pedido: pedido}
		}).done(function( response ) {
			
			var resp = eval('(' + response + ')');
			var msg= (resp.msg)? resp.msg : '';
			var title;
			
			if ( resp.success == true	){
				if (resp.msgType!=undefined && resp.msgType == 'info'){
					icon='/web/apps/fastorder/images/yes.png';
				}else{
					icon='/web/apps/fastorder/images/info.png';
				}
				
				title= 'Success';
				tab.find('.txtId').val(resp.datos.id);
				tab.find('.txtIdTmp').val(resp.datos.id_tmp);
				tab.find('.txtFkAlmacen').val(resp.datos.fk_almacen);
				tab.find('.txtFolio').val(resp.datos.folio);
				tab.find('.txtFecha').wijinputdate('option','date', resp.datos.fecha); 
				tab.find('.cmbAlmacen').wijcombobox( 'option', 'disabled', true );
				tab.find('.cmbSerie').wijcombobox( 'option', 'disabled', true );
				
				me.actualizarTitulo();
				me.editado=false;
				var objId = '/'+kore.modulo+'/pedidoi/getPedido?id='+resp.datos.id;
				objId = objId.toLowerCase();
				$(me.tabId ).attr('objId',objId);
				
				
				 var articulos=resp.datos.articulos;
				 var gridPedidos=$(me.tabId+" .grid_articulos");
				 var data=gridPedidos.wijgrid('data');
				 data.length=0;
				 for(var i=0; i<articulos.length; i++){
					 data.push(articulos[i]);
				 }
				
				gridPedidos.wijgrid('ensureControl', true);
				
				$.gritter.add({
					position: 'bottom-left',
					title:title,
					text: msg,
					image: icon,
					class_name: 'my-sticky-class'
				});
				
				if (me.saveAndClose===true){
					//busca el indice del tab
					var idTab=$(me.tabId).attr('id');
					var tabs=$('#tabs > div');
					for(var i=0; i<tabs.length; i++){
						if ( $(tabs[i]).attr('id') == idTab ){
							$('#tabs').wijtabs('remove', i);
						}
					}
				}
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
			
			//cuando es true, envia tambien los datos guardados.
			//actualiza los valores del formulario.
			
		});
	};	
	this.eliminar=function(){
		var id = this.selected.id;
		var me=this;
		$.ajax({
				type: "POST",
				url: '/'+kore.modulo+'/pedidos/eliminar',
				data: { id: id}
			}).done(function( response ) {		
				var resp = eval('(' + response + ')');
				var msg= (resp.msg)? resp.msg : '';
				var title;
				if ( resp.success == true	){					
					icon='/web/apps/fastorder/images/yes.png';
					title= 'Success';				
					var gridPedidos=$(me.tabId+" #lista_de_vuelos");				
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
	},
	
	this.configurarComboSerie=function(){
		var tabId=this.tabId;
		var fields=[{
			name: 'label',
			mapping:'serie'
		},{
			name: 'value',
			mapping: 'id'
		},{
			name:'es_default'
		},{
			name:'sig_folio'
		}];
		
		var myReader = new wijarrayreader(fields);
		
		var proxy = new wijhttpproxy({
			url: '/'+kore.modulo+'/'+this.controlador.nombre+'/getSeries',
			dataType:"json"			
		});
		var me=this;
		var datasource = new wijdatasource({
			reader:  new wijarrayreader(fields),
			proxy: proxy,
			loaded: function (data) {				
				var val=parseInt( $('#tabs '+tabId+' .txtFkSerie').val() );								
				
				
				
				$.each(data.items, function(index, datos) {					
					
					 
					 
					if (val !=0 ){
						if (val==parseInt(datos.value) ){
							$(tabId+' .cmbSerie').wijcombobox({selectedIndex:index});
							me.actualizarTitulo();
						}
					}else{
						if (parseInt(datos.es_default) == 1 ){							
							$(tabId+' .cmbSerie').wijcombobox({selectedIndex:index});
							$(tabId+' .txtFkSerie').val(datos.value);
							$(tabId+' .txtFolio').val(datos.sig_folio);
						}
					}
					
				});				
			},
			loading: function (dataSource, userData) {
				var idalmacen = $('#tabs '+me.tabId+' .txtFkAlmacen').val();
                dataSource.proxy.options.data={idalmacen:idalmacen};
            }
			
		});
		this.dataSerie=datasource;
		datasource.reader.read= function (datasource) {			
			var totalRows=datasource.data.totalRows;			
			datasource.data = datasource.data.rows;
			datasource.data.totalRows = totalRows;
			myReader.read(datasource);
		};			
		
		datasource.load();	
		var combo=$('#tabs '+tabId+' .cmbSerie').wijcombobox({
			data: datasource,
			showTrigger: true,
			minLength: 1,
			autoFilter: false,
			animationOptions: {
				animated: "Drop",
				duration: 1000
			},
			forceSelectionText: true,
			search: function (e, obj) {
				//obj.datasrc.proxy.options.data.name_startsWith = obj.term.value;
			},
			select: function (e, item) {
				me.editado=true;
				$(tabId+' .txtFkSerie').val(item.value);
				$(tabId+' .txtFolio').val(item.sig_folio);
			}
		});
	};
	this.configCmbAlmacen=function(){
		var tabId=this.tabId;
		var me=this;
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
			url: '/'+kore.modulo+'/pedidoi/getAlmacenes',
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
			autoFilter: false,
			animationOptions: {
				animated: "Drop",
				duration: 1000
			},
			forceSelectionText: true,
			search: function (e, obj) {
				//obj.datasrc.proxy.options.data.name_startsWith = obj.term.value;
			},
			select: function (e, item) {				
				$('#tabs '+me.tabId+' .txtFkAlmacen').val(item.id);				
				$('#tabs '+me.tabId+' .txtFkSerie').val(0);	
				
				$(me.tabId +' .cmbSerie').wijcombobox('option', 'selectedIndex',-1)
				//$(me.tabId +' .cmbSerie + div input').val('')
				
				me.editado=true;
				me.dataSerie.load();
			}
		});
	};
	this.configCmbProveedor=function(){
		var tabId=this.tabId;
		var me=this;
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
			url: '/'+kore.modulo+'/orden_compra/getProveedores',
			dataType:"json"			
		});
		
		var datasource = new wijdatasource({
			reader:  new wijarrayreader(fields),
			proxy: proxy,
			loaded: function (data) {				
				 var val=$('#tabs '+tabId+' .txtFkProveedor').val();
				$.each(data.items, function(index, datos) {					
					if (parseInt(val)==parseInt(datos.id) ){						
						$('#tabs '+tabId+' .cmbProveedor').wijcombobox({selectedIndex:index});
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
		var combo=$('#tabs '+tabId+' .cmbProveedor').wijcombobox({
			data: datasource,
			showTrigger: true,
			minLength: 1,
			autoFilter: false,
			animationOptions: {
				animated: "Drop",
				duration: 1000
			},
			forceSelectionText: true,
			search: function (e, obj) {
				//obj.datasrc.proxy.options.data.name_startsWith = obj.term.value;
			},
			select: function (e, item) {				
				$('#tabs '+me.tabId+' .txtFkProveedor').val(item.id);				
				// $('#tabs '+me.tabId+' .txtFkSerie').val(0);	
				
				$(me.tabId +' .cmbSerie').wijcombobox('option', 'selectedIndex',-1)
				//$(me.tabId +' .cmbSerie + div input').val('')
				
				me.editado=true;
				me.dataSerie.load();
			}
		});
	};
	this.configurarFormulario=function(tabId){		
		var me=this;
		
		$('#tabs '+tabId+' .txtFecha').wijinputdate({ 
			dateFormat: 'd/M/yyyy', showTrigger: true,
			dateChanged: function(e, arg){
				me.editado=true;
			}
		});		
		
		
		$('#tabs '+tabId+' .txtVencimiento').wijinputdate({ 
			dateFormat: 'd/M/yyyy', showTrigger: true,
			dateChanged: function(e, arg){
				me.editado=true;
			}
		});		
		
		$( ".btnCargarArticulos" )
		  .button()
		  .click(function( e ) {			
			e.preventDefault();			
			var params={
				 idtmp:$(me.tabId+' .txtIdTmp').val(),
				 idalmacen:$(me.tabId+' .txtFkAlmacen').val(),
				 pedidoid:$(me.tabId+' .txtId').val()
			};
			$.ajax({
				type: "POST",
				url: '/'+kore.modulo+'/pedidoi/precargar',
				data: params
			}).done(function( response ) {				
				var resp = eval('(' + response + ')');
				if ( resp.success == true	){
					me.editado=true;
					var gridPedidos=$(me.tabId+" .grid_articulos");
					
					var data= $(tabId+" .grid_articulos").wijgrid('data');
					data.length=0;
					for(var i=0; i<resp.articulos.length; i++){
						data.push(resp.articulos[i]);
					}
					
					//gridPedidos.wijgrid('data',resp.articulos);					
					
					gridPedidos.wijgrid('ensureControl', true);					
				}
			
			});
		  });
	  		
		this.configCmbAlmacen();
		this.configurarComboSerie();
		this.configCmbProveedor();
	};
	this.configurarToolbar=function(tabId){		
			
			var me=this;
			
			$(this.tabId + ' .toolbarFormPedido .btnGuardar').click( function(){
				me.guardar();
				me.editado=true;
			});
			
			$(this.tabId + ' .toolbarFormPedido .btnEliminar').click( function(){
				var r=confirm("¿Eliminar Orden de compra?");
				if (r==true){
				  me.eliminar();
				  me.editado=true;
				}
			});
	};	
}
