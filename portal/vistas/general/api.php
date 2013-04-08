<script>
	$(function(){
		var tabId="<?php echo $_REQUEST['tabId']; ?>";
		tabId='#'+tabId;			
		$('#tab > div'+tabId).addClass('ui-widget-content');				
		var tab=$('a[href="'+tabId+'"]');
		tab.html('Api');
		tab.addClass('api');		
	});	
</script>
<div style="margin-top:-29px;">
</div>

<h3>Tab Manager</h3>
<ul>
	<li>Agregar(json)
	<span>Params</span>
	<ul>
		<li>url: </li>
		<li>html: </li>
		<li>iconCls: </li>
		<li>titulo: </li>		
	</ul>
	
	</li>
</ul>