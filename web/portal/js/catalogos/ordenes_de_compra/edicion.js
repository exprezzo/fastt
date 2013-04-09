var Edicionordenes_de_compra = function(){
	this.editado=false;
	this.saveAndClose=false;
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
				var val=parseInt( $('#tabs '+tabId+' [name="fk_serie"]').val() );												
				val= ( isNaN(val) )? 0 : val;
				
				$.each(data.items, function(index, datos) {										
					
					if (val !=0 ){						
						if (val==parseInt(datos.value) ){
							$(me.tabId+' select[name="cmb_serie"]').wijcombobox({selectedIndex:index});							
							// me.actualizarTitulo();
						}
					}else{
						if (parseInt(datos.es_default) == 1 ){									
							$(me.tabId+' select[name="cmb_serie"]').wijcombobox({selectedIndex:index});							
							$(me.tabId+' select[name="cmb_serie"]').wijcombobox('option','text',datos.label);							
							$(me.tabId+' [name="fk_serie"]').val(datos.value);
							$(me.tabId+' [name="folio"]').val(datos.sig_folio);							
						}
					}
					
				});				
			},
			loading: function (dataSource, userData) {				
				// var idalmacen = $(me.tabId+' select[name="fk_almacen"]').val();
				var idalmacen = me.almacen_seleccionado;
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
		
		
		
		
		var combo=$(this.tabId+' select[name="cmb_serie"]').wijcombobox({
			data: datasource,
			showTrigger: true,
			minLength: 1,
			autoFilter: false,
			width:50,
			animationOptions: {
				animated: "Drop",
				duration: 1000
			},
			forceSelectionText: false,
			search: function (e, obj) {
				//obj.datasrc.proxy.options.data.name_startsWith = obj.term.value;
			},
			select: function (e, item) {
				me.editado=true;				
				$(me.tabId+' select[name="fk_serie"]').val(item.value);
				 $(tabId+' [name="folio"]').val(item.sig_folio);
			}
		});
	};
	this.activate=function(){
		var tabId=this.tabId;
		var w=$(tabId+' .lblAlmacen').width();		
		$(tabId+' .lblSerie').width(w);
	}
	this.configCmbAlmacen=function(){
		var tabId=this.tabId;
		var me=this;
		// var fields=[{
			// name: 'label',
			// mapping: function (item) {
				// return item.label;
			// }
		// }, {
			// name: 'value',
			// mapping: 'label'
		// }, {
			// name: 'selected',
			// defaultValue: false
		// },{name:'id'}];
		
		// var myReader = new wijarrayreader(fields);
		
		// var proxy = new wijhttpproxy({
			// url: '/'+kore.modulo+'/'+this.controlador.nombre+'/getAlmacenes',
			// dataType:"json"			
		// });
		
		$(this.tabId+' select[name="fk_almacen"]').wijcombobox({select:function(e, item){			
			me.almacen_seleccionado = item.value;
			
			// $(me.tabId+" [name='cmb_serie']").wijcombobox({
				// data: []
			// });
			
			$(me.tabId+" [name='fk_serie']").val(0);
			me.editado=true;		
			
			setTimeout(me.dataSerie.load(), 100);

			// alert();
		}});
		
		
		return true;
		// var datasource = new wijdatasource({
			// reader:  new wijarrayreader(fields),
			// proxy: proxy,
			// loaded: function (data) {				
				// var val=$('#tabs '+tabId+' select[name="fk_almacen"]').val();
				// $.each(data.items, function(index, datos) {					
					// if (parseInt(val)==parseInt(datos.id) ){						
						  // $('#tabs '+tabId+' .cmbAlmacen').wijcombobox({selectedIndex:index});
					// }
				// });				
			// }
		// });
		
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
	this.init=function(params){
		// var defaults={		
			// guardar:this.guardar
		// }
		 // $.extend(this, defaults, new ComportamientoEdicion() );
		 
		this.controlador=params.controlador;
		this.catalogo=params.catalogo;
		
		var tabId='#'+params.tab.id;
		var objId=params.objId;
		
		this.tabId= tabId;		
		
		this.almacen_seleccionado = $(this.tabId + ' [name="fk_almacen"]').val();
		
		var tab=$('div'+this.tabId);
		//estas dos linas deben estar en la hoja de estilos
		tab.css('padding','0');
		tab.css('border','0 1px 1px 1px');
		
		
		this.agregarClase('frm'+this.controlador.nombre);
		this.agregarClase('tab_'+this.controlador.nombre);
		
		this.configurarFormulario(this.tabId);
		this.configurarToolbar(this.tabId);		
		// this.notificarAlCerrar();			
		this.actualizarTitulo();				
		
		var me=this;
		$(this.tabId + ' .frmEdicion input').change(function(){
			me.editado=true;		
		});
		
		$(tabId+' .toolbarEdicion .boton:not(.btnPrint, .btnEmail)').mouseenter(function(){
			$(this).addClass("ui-state-hover");
		});
		
		$(tabId+' .toolbarEdicion .boton *').mouseenter(function(){						
			 $(this).parent('.boton').addClass("ui-state-hover");						
		});
		
		$(tabId+' .toolbarEdicion .boton').mouseleave(function(e){			 
				$(this).removeClass("ui-state-hover");			
		});
		
		 // tab.data('tabObj',this); //Este para que?		
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
		var me=this;
		 $('#tabs > ul a[href="'+tabId+'"] + span').click(function(e){
			e.preventDefault();
			 var tmp=$(me.tabId+' .txtIdTmp');				
			if (tmp.length==1){
				var id=$(tmp[0]).val();				
				$.ajax({
					type: "POST",
					url: '/'+kore.modulo+'/'+me.controlador.nombre+'/cerrar',
					data: { id:id }
				}).done(function( response ) {
					
				});
			}	
		 });
	}
	this.actualizarTitulo=function(){
		var tabId = this.tabId;		
		var id = $(tabId + ' .txtId').val();		
		if (id>0){
			
		}else{
			// $('a[href="'+tabId+'"]').html('Nuevo');
		}
	}
	this.nuevo=function(){
		var tabId=this.tabId;
		var tab = $('#tabs '+tabId);
		$('a[href="'+tabId+'"]').html('Nuevo');
		tab.find('.txtId').val(0);
		me.editado=false;
	};	
	this.guardar=function(){
		var tabId=this.tabId;
		var tab = $('#tabs '+tabId);
		var me=this;
		
		
		var articulos=$(this.tabId+' .grid_busqueda').wijgrid('data');		
		
		//-----------------------------------
		// http://stackoverflow.com/questions/2403179/how-to-get-form-data-as-a-object-in-jquery
		var paramObj = {};
		$.each($(tabId + ' .frmEdicion').serializeArray(), function(_, kv) {
		  if (paramObj.hasOwnProperty(kv.name)) {
			paramObj[kv.name] = $.makeArray(paramObj[kv.name]);
			paramObj[kv.name].push(kv.value);
		  }
		  else {
			paramObj[kv.name] = kv.value;
		  }
		});
		//-----------------------------------
		var datos=paramObj;
		datos.articulos=articulos;
		//Envia los datos al servidor, el servidor responde success true o false.
		
		$.ajax({
			type: "POST",
			url: '/'+kore.modulo+'/'+this.controlador.nombre+'/guardar',
			data: { datos: datos}
		}).done(function( response ) {
			
			var resp = eval('(' + response + ')');
			var msg= (resp.msg)? resp.msg : '';
			var title;
			
			if ( resp.success == true	){
				if (resp.msgType!=undefined && resp.msgType == 'info'){
					icon= '/web/'+kore.modulo+'/images/yes.png';
				}else{
					icon= '/web/'+kore.modulo+'/images/info.png';
				}
				
				title= 'Success';
				tab.find('.txtId').val(resp.datos.id);
				
				
				me.actualizarTitulo();
				me.editado=false;
				var objId = '/'+kore.modulo+'/'+me.controlador.nombre+'/editar?id='+resp.datos.id;
				objId = objId.toLowerCase();
				$(me.tabId ).attr('objId',objId);				
				
				var articulos=resp.articulos || new Array();
				 var gridPedidos=$(me.tabId+" .grid_busqueda");
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
				icon= '/web/'+kore.modulo+'/images/error.png';
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
		var id = $('.txtId').val();
		var me=this;
		$.ajax({
				type: "POST",
				url: '/'+kore.modulo+'/'+me.controlador.nombre+'/eliminar',
				data: { id: id}
			}).done(function( response ) {		
				var resp = eval('(' + response + ')');
				var msg= (resp.msg)? resp.msg : '';
				var title;
				if ( resp.success == true	){					
					icon= '/web/'+kore.modulo+'/images/yes.png';
					title= 'Success';									
				}else{
					icon= '/web/'+kore.modulo+'/images/error.png';
					title= 'Error';
				}
				
				//cuando es true, envia tambien los datos guardados.
				//actualiza los valores del formulario.
				var idTab=$(me.tabId).attr('id');
				var tabs=$('#tabs > div');
				me.editado=false;
				for(var i=0; i<tabs.length; i++){
					if ( $(tabs[i]).attr('id') == idTab ){
						$('#tabs').wijtabs('remove', i);
					}
				}
					
				$.gritter.add({
					position: 'bottom-left',
					title:title,
					text: msg,
					image: icon,
					class_name: 'my-sticky-class'
				});
			});
	},
	

	
	
	this.configurarFormulario=function(tabId){		
		var me=this;
		
		// $(this.tabId+' select[name="cmb_serie"]').wijcombobox({select:function(){			
			// me.editado=true;			
		// }});
		
		this.configurarComboSerie();
		$(this.tabId+' select[name="idproveedor"]').wijcombobox({
			width:120,
			select:function(){
				me.editado=true;			
			}
		});
		
		this.configCmbAlmacen();
		
		$(this.tabId+' select[name="idestado"]').wijcombobox({
			width:120,
			select:function(){
				me.editado=true;
			}
		});
		$(this.tabId+' input[name="folio"]').wijtextbox();
		
		 $(this.tabId+ " .btnPrecargar" )			
			.click(function( event ) {
				event.preventDefault();
				// alert("precargar");
				var params={					 
					 idalmacen:$(me.tabId+' select[name="fk_almacen"]').val()					 
				};
				$.ajax({
					type: "POST",
					url: '/'+kore.modulo+'/'+me.controlador.nombre+'/precargar',
					data: params
				}).done(function( response ) {				
					var resp = eval('(' + response + ')');
					
					if ( resp.success == true	){
						me.editado=true;
						
						var data= $(me.tabId+" .grid_busqueda").wijgrid('data');
						data.length=0;
						for(var i=0; i<resp.rows.length; i++){
							data.push(resp.rows[i]);
						}
						
						//gridPedidos.wijgrid('data',resp.articulos);					
						
						$(me.tabId+" .grid_busqueda").wijgrid('ensureControl', true);					
					}
				
				});
				
			});
	  
		$(this.tabId+' input[name="fecha"]').wijinputdate({ 
			dateFormat: 'd/M/yyyy', showTrigger: true,
			dateChanged: function(e, arg){
				me.editado=true;
			}
		});		
				
		$(this.tabId+' input[name="vencimiento"]').wijinputdate({ 
			width:100,
			dateFormat: 'd/M/yyyy', showTrigger: true,
			dateChanged: function(e, arg){
				me.editado=true;
			}
		});							
	};
	this.configurarToolbar=function(tabId){		
			
			var me=this;
			
			$(this.tabId + ' .toolbarEdicion .btnGuardar').click( function(){
				me.guardar();
				me.editado=true;
			});
			
			$(this.tabId + ' .toolbarEdicion .btnDelete').click( function(){
				var r=confirm("¿Eliminar?");
				if (r==true){
				  me.eliminar();
				  me.editado=true;
				}
			});
	};	
}
