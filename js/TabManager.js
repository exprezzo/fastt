var tab_counter = 2;
// close icon: removes the tab on click
 
 var TabManager={
	init:function(){
		$tabs = $('#tabs').wijtabs({
		   tabTemplate: '<li><a  href="#{href}">#{label}</a> <span class="ui-icon ui-icon-close">Remove Tab</span></li>'
		});
		this.tabs=$tabs;
		// addTab button: opens the Add tab dialog box
			
		$('#tabs span.ui-icon-close').live('click', function () {
			var index = $('li', $tabs).index($(this).parent());
			$tabs.wijtabs('remove', index);
		});		
	},
	add:function(url,titulo,id){
		id = id || 0;
		var tabId = '#tabs-' + tab_counter;
		
		var objId = url+'?id='+id;		
		if ( this.seleccionarTab(objId) == true) 
			return true;		
		tab_counter++;
		$.ajax({
			type: "POST",
			url: url,
			data: { tabId:tabId,pedidoId:id }
		}).done(function( response ) {
			$tabs.wijtabs('add', tabId, 'Nuevo Tab');
			$( tabId ).html(response);
			$( tabId ).attr('objId',objId);			
			$tabs.wijtabs('select',tabId);
			
		});
	},
	seleccionarTab:function(objId){
		//¿ Que pasa con los tabs dentro de tabs ?
		
		var tabListaPedidos = $('div[objId="'+objId+'"]'); //role="tabPanel", 
		
		if (tabListaPedidos.length == 0){
			return false;
		}else if (tabListaPedidos.length > 0){ //Seleccionar el tab		
			var tabs = $('div[role="tabpanel"]');
			$.each(tabs, function(index, element) {
				var jElement = $(element);
				//si el elemento tiene el atributo == objId, seleccionar
				if ( jElement.attr ){
					if ( jElement.attr('objId')==objId ){
						//Quita seleccion al anterior
						var jAnt = $('div[aria-hidden="false"]');
						jAnt.addClass('ui-tabs-hide');
						jElement.attr('aria-hidden',true);
						
						var linkAnt = $('li[aria-selected="true"]');		
						linkAnt.attr('aria-selected',false);
						linkAnt.removeClass('ui-tabs-selected');
						linkAnt.removeClass('ui-state-active');						 
						
						
						var selector='a[href="#'+jElement.attr('id')+'"]';						
						var activeTab = $(selector).parent();
						activeTab.attr('aria-selected',true);
						activeTab.addClass('ui-tabs-selected');
						activeTab.addClass('ui-state-active');						 
						//activeTab
						
						//Selecciona el nuevo
						jElement.addClass('ui-tabs-selected ui-state-active');
						jElement.removeClass('ui-tabs-hide');
						jElement.attr('aria-hidden',false);
						
						
						//TabManager.tabs.wijtabs('select', index);
						
						//alert("seleccionado: "+objId);
						return true;
					}
				}
				
			});	
			return true;
		}
	}
};