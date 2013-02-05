var EdicionPedido = function(){
	this.init=function(tabId, pedidoId, almacen){		
		
		tabId = '#'+tabId;
		this.tabId=tabId;
		var tab=$('div'+tabId);
		$('div'+tabId).css('padding','0');
		$('div'+tabId).css('border','0 1px 1px 1px');
		
		tab.addClass('frmPedido');
		var tab=$('a[href="'+tabId+'"]');		
		tab.addClass('frmPedido');
		
		//Para identificar el contenido del tab
		//var objId='pedidoi_id_'+pedidoId;								
		//$('#tabs '+tabId).attr('objId',objId);
		
		//Establecer titulo e icono
		if (pedidoId>0){
			$('a[href="'+tabId+'"]').html('Pedido-'+almacen+' ID: '+pedidoId);		
		}else{
			$('a[href="'+tabId+'"]').html('Nuevo Pedido');
		}
		
		this.configurarFormulario(tabId);
		this.configurarToolbar(tabId);
		// this.configurarListaArticulos(tabId);
		
		//al cerrar notificar al servidor 
		 $('#tabs > ul a[href="'+tabId+'"] + span').click(function(){
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
				
				
	};
	this.nuevo=function(){
		var tabId=this.tabId;
		var tab = $('#tabs '+tabId);
		$('a[href="'+tabId+'"]').html('Nuevo Pedido');
		tab.find('.txtId').val(0);
	};	
	this.guardar=function(){
		var tabId=this.tabId;
		var tab = $('#tabs '+tabId);
		var me=this;
		var pedido={
			id		: tab.find('.txtId').val(),
			IdTmp		: tab.find('.txtIdTmp').val(),
			almacen	: tab.find('.txtFkAlmacen').val(),
			fecha	: tab.find('.txtFecha').val(),
			fk_serie: tab.find('.txtFkSerie').val(),
			vencimiento	: tab.find('.txtVencimiento').val(),
			folio	: tab.find('.txtFolio').val()
			
		};
		
		//Envia los datos al servidor, el servidor responde success true o false.
		
		$.ajax({
			type: "POST",
			url: '/'+kore.modulo+'/pedidoi/guardar',
			data: { pedido: pedido}
		}).done(function( response ) {
			
			var resp = eval('(' + response + ')');
			var msg= (resp.msg)? resp.msg : '';
			var title;
			if ( resp.success == true	){
				icon='/web/apps/fastorder/images/yes.png';
				title= 'Success';				
				tab.find('.txtId').val(resp.datos.id);
				tab.find('.txtIdTmp').val(resp.datos.id_tmp);				
				tab.find('.txtFkAlmacen').val(resp.datos.fk_almacen);
				tab.find('.txtFecha').wijinputdate('option','date', resp.datos.fecha); 
				$('a[href="'+me.tabId+'"]').html('Pedido-'+resp.datos.nombreAlmacen+' ID: '+resp.datos.id);				
				var objId = '/'+kore.modulo+'/pedidoi/getPedido?id='+resp.datos.id;
				objId = objId.toLowerCase();
				$(me.tabId ).attr('objId',objId);
				
				var gridPedidos=$(me.tabId+" .grid_articulos");
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
			url: '/'+kore.modulo+'/pedidoi/getSeries',
			dataType:"json"			
		});
		var me=this;
		var datasource = new wijdatasource({
			reader:  new wijarrayreader(fields),
			proxy: proxy,
			loaded: function (data) {				
				var val=parseInt( $('#tabs '+tabId+' .txtFkSerie').val() );								
				$.each(data.items, function(index, datos) {					
					// console.log(datos);
					// alert(tabId);
					if (val !=0 ){
						if (val==parseInt(datos.value) ){
							$(tabId+' .cmbSerie').wijcombobox({selectedIndex:index});														
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
				//console.log('item'); console.log(item); 
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
				
				
				me.dataSerie.load();
			}
		});
	};
	this.configurarFormulario=function(tabId){
		$('#tabs '+tabId+' .txtFecha').wijinputdate({ dateFormat: 'd/M/yyyy', showTrigger: true});		
		$('#tabs '+tabId+' .txtVencimiento').wijinputdate({ dateFormat: 'd/M/yyyy', showTrigger: true});		
		//COMBO
		
		
		
		
		// var animationOptions = {
			 // animated: "Drop",
			 // duration: 1000
		// };
		// combo.wijcombobox("option", "showingAnimation", animationOptions);		
		// combo.wijcombobox("option", "hidingAnimation", animationOptions);
		this.configCmbAlmacen();
		this.configurarComboSerie();
		
	};
	this.configurarToolbar=function(tabId){		
			
			var me=this;
			
			$(this.tabId + ' .toolbarFormPedido .btnGuardar').click( function(){
				me.guardar();
			} );
			
			$(this.tabId + ' .toolbarFormPedido .btnEliminar').click( function(){
				var r=confirm("¿Eliminar el elemento?");
				if (r==true){
				  me.eliminar();
				}
			} );
			
			
			// $(tabId+ "> .tbPedido").wijribbon({
				// click: function (e, cmd) {
					// switch(cmd.commandName){
						// case 'nuevo':
							// TabManager.add('/admin/pedidoi/nuevo','Nuevo Pedido');				
						// break;
						// case 'guardar':
							// me.guardar();
						// break;
						// case 'eliminar':
							// me.nuevo();
						// break;
						
						// default:						
							// $.gritter.add({
								// position: 'bottom-left',
								// title:"Informaci&oacute;n",
								// text: "Acciones del toolbar en construcci&oacute;n",
								// image: '/images/info.png',
								// class_name: 'my-sticky-class'
							// });
						// break;
					// }
					
				// }
			// });
			
			
			
	};
		
	
}
