<script>
	$(function(){
		var tabId="<?php echo $_REQUEST['tabId']; ?>";
		var selectorTab='#'+tabId;					
	});
</script>
<style>
	.enproceso{
		color:blue;
	}
	.listo{
		color:green;
		font-weight:bold;
	}
	.scrum h3{display:inline}
</style>
<div style="margin-top:-29px;" class="scrum">
<h1>Bugs</h1>
<ul>
	<li></li>
</ul>

<h3>Tareas Sprint 1 </h3>29/Ene/2013 <br/>

<p class="pendiente">Pedido Interno - Agregar en el filtro el almac&eacute;n.</p>
<p class="pendiente">Pedido Interno - Agregar en el filtro la fecha vencimiento ( un solo campo y filtrar&aacute; de acuerdo a los pedidos internos cuya fecha de venccimiento sea mayor o igual a la fecha.)</p>
<p class="pendiente">Pedido Interno - Agregar en el filtro Estado de Documentos.</p>
<p class="pendiente">Pedido Interno - Las fechas pueden quedar vac&iacute;as en los filtros de b&uacute;squeda.</p>
<p class="enproceso">Pedido Interno - La lista de la B&uacute;squeda tiene que tener lo siguiente, Folio y serie; Almacen, Fecha, Fecha Vencimiento, Estado.</p>
<p class="pendiente">Pedido Interno - Estados: Solicitado, Concentrado, Parcialmente Surtido, Surtido, Cancelado, Caducado.</p>
<p class="enproceso">Pedido Interno - Folio y serie de acuerdo a almac&eacute;n y al dar nuevo y empezar la captura sugerir&aacute; el siguiente y si hay un cambio al momento de guardar se le avisar&aacute; al usuario.</p>
<p class="pendiente">Pedido Interno - El grid del listado de insumos se agrupa por grupo y se ordena de acuerdo a campo articulostock.grupoposicion y los que sean sugeribles.</p>
<p class="listo">Pedido Interno - El grid: Listar los campos como sigue: Codigo articulo, Nombre Articulo, Unidad Medida, M&aacute;ximo, M&iacute;nimo, P Reorden, Inventario Inicial, Sugerido x Sistema, Pedido, Pendiente.</p> 
<p class="listo">Pedido Interno - Campos a modificiar: Nombre Articulo, Inventario inicial, Pedido.</p>
<p class="pendiente">Pedido Interno - Permitir buscar articulos por codigo.</p>

<h3>Sprint 2 </h3> (##/##/####)<br/>
<ul>
	<li></li>
</ul>

<h3>Back Log</h3>
<p class="pendiente">Configuraci&oacute;n - Crear un modo de configuraci&oacute;n para jalar la serie y el folio que le sigue por almac&eacute;n.</p>
<p class="pendiente">Al Logear preguntar la sucursal y el almac&eacute;n si se puede almacenar por default el &uacute;ltimo seleccionado.</p>
<p class="pendiente">Formatos de Impresi&oacute;n para pedido interno.</p> 
<p class="pendiente">Guardar Configuraci&oacute;n de b&uacute;squedas por usuario, m&oacute;dulo y sucursal</p>
<p class="pendiente">Cambiar tama&ntilde;o de grids (todos) de acuerdo a la configuraci&oacute;n hecha por el usuario en un determinado dispositivo.</p>
<p class="pendiente">Poder en todos los grids manipular el orden de las columnas y que se almacene de acuerdo al usuario.</p>
<p class="pendiente">Historial de Mensajes del sistema al usuario por sesi&oacute;n no se necesita guardar en servidor ni en cliente.</p>
<p class="pendiente">Historial de Errores graves del sistema crear un log para supervisar y dar seguimiento.</p>

</div>
<script type="text/javascript">
$( function(){

});
</script>
<script type="text/javascript">
		/* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
		//var disqus_identifier = 'scrum';
		
		// var disqus_shortname = 'fastorder'; // required: replace example with your forum shortname		
		// var disqus_url='http://fastorder.lamona.mx/index';
		// /* * * DON'T EDIT BELOW THIS LINE * * */
		// (function() {
			// var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
			// dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
			// (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
		// })();
	</script>
<div class="">		
	<!--div id="disqus_thread"></div>		
	<noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
	<a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a-->
</div>