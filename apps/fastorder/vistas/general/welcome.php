<script>
	$(function(){
		var tabId="<?php echo $_REQUEST['tabId']; ?>";
		tabId = '#' + tabId;		
		$(tabId).addClass('ui-widget-content');		
		var tab=$('a[href="'+tabId+'"]');
		tab.html('Bienvenido');
		tab.addClass('welcome');		
	});
	
</script>
<div style="margin-top:-29px;">
<h1>Bienvenido</h1>
Hola, para una mejor experiencia te recomendamos resoluciones mayores a 1024px.