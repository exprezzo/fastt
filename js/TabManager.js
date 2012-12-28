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
	add:function(url,titulo,pedidoId){
		pedidoId = pedidoId || 0;
		var tabId = '#tabs-' + tab_counter;
		
		$.ajax({
			type: "POST",
			url: url,
			data: { tabId:tabId,pedidoId:pedidoId }
		}).done(function( response ) {						
			console.log(tabId);
			$tabs.wijtabs('add', tabId, 'Nuevo Tab');					
			$( tabId ).html(response);			
			$tabs.wijtabs('select',tabId);
			tab_counter++;
		});
	}
};