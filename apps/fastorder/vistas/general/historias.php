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

Historias de usuario:
<ul>
	<li>Que me ayude con la operacion del dia.</li>
	<br />
	
	<li>Quiero que el sistema considere mis estrategias de venta</li>
	<li>Quiero que el sistema considere a todas las sucursales</li>
	
	
	<li>Quiero tener la existencia f&iacute;sica y del sistema en sincron&iacute;a.</li>
	<li>Quiero que el sistema registre la perdida de mercancia, ya sea por caducidad, da&ntilde;o u otros, y me ayude a reducir esa permida como sea posible</li>
	<li>que haga una estimaci&oacute;n de lo que voy a necesitar en el dia.</li>
	<li>Quiero que haga estimaciones de varios dias, tomando en cuenta la caducidad del producto</li>
	<li>Quiero saber como entr&oacute; y como sali&oacute; la mercancia.</li>
	<li>Como cajero, quiero registrar todas las comandas.</li>
	<li>Como encargado del almac&eacute;n, me gustar&iacute;a que las comandas servidas se descontaran del inventario.</li>
	<li>Quiero que el sistema registre la variaci&oacute;n diaria entre lo contado y lo supuesto.</li>
	<li>Quiero que registre la propina diaria y como fue repartida</li>
	<br/>
	<li>Como usuario, quiero que el sistema mantenga un historial de mensajes (en especial los de error).</li>		
	<li>Como usuario, quiero manipular el orden de las columnas en los grids y que asi se queden.</li>
	<li>Como usuario, cuando modifico un parametro de busqueda, quiero que asi permanezca aunque salga del sistema.</li>
	<li>Como usuario, quiero que el tama&ntilde;o de grids se adapte a los diferentes dispositivos y orientaciones de pantalla.</li>
	<li>Como usuario, quiero poder configurar el tama&ntilde;o de grids dependiendo del dispositivo y orientacion de pantalla.</li>
	<li>Como webmaster, quiero un historial de sucesos en especial de error, para supervisar y dar seguimiento.</li>
</ul>

Sprint 1 29/Ene/2013 <br/>
<ul>
	<li></li>
</ul>

Documentos:<br />
<ul>
	<li>Comanda</li>
	<li>Pedido</li>
	<li>Nota salida</li>
	<li>Nota de venta</li>	
</ul>

Tareas Sprint 1 xxx<br/>
<p class="listo">Pedido Interno - Agregar en el filtro el almac&eacute;n.</p>
<p class="listo">Pedido Interno - Agregar en el filtro la fecha vencimiento ( un solo campo y filtrar&aacute; de acuerdo a los pedidos internos cuya fecha de venccimiento sea mayor o igual a la fecha.)</p>
<p class="pendiente">Pedido Interno - Agregar en el filtro Estado de Documentos.</p>
<p class="enproceso">Pedido Interno - Las fechas pueden quedar vac&iacute;as en los filtros de b&uacute;squeda.</p>
<p class="enproceso">Pedido Interno - La lista de la B&uacute;squeda tiene que tener lo siguiente, Folio y serie; Almacen, Fecha, Fecha Vencimiento, Estado.</p>
<p class="pendiente">Pedido Interno - Estados: Solicitado, Concentrado, Parcialmente Surtido, Surtido, Cancelado, Caducado.</p>
<p class="enproceso">Pedido Interno - Folio y serie de acuerdo a almac&eacute;n y al dar nuevo y empezar la captura sugerir&aacute; el siguiente y si hay un cambio al momento de guardar se le avisar&aacute; al usuario.</p>
<p class="listo">Pedido Interno - El grid del listado de insumos se agrupa por grupo y se ordena de acuerdo a campo articulostock.grupoposicion y los que sean sugeribles.</p>
<p class="listo">Pedido Interno - El grid: Listar los campos como sigue: Codigo articulo, Nombre Articulo, Unidad Medida, M&aacute;ximo, M&iacute;nimo, P Reorden, Inventario Inicial, Sugerido x Sistema, Pedido, Pendiente.</p> 
<p class="listo">Pedido Interno - Campos a modificiar: Nombre Articulo, Inventario inicial, Pedido.</p>
<p class="enproceso">Pedido Interno - Permitir buscar articulos por codigo.</p>

<h3>Sprint 2 </h3> (##/##/####)<br/>
<ul>
	<li></li>
</ul>


<p class="pendiente">Configuraci&oacute;n - Crear un modo de configuraci&oacute;n para jalar la serie y el folio que le sigue por almac&eacute;n.</p>
<p class="pendiente">Al Logear preguntar la sucursal y el almac&eacute;n si se puede almacenar por default el &uacute;ltimo seleccionado.</p>
<p class="pendiente">Formatos de Impresi&oacute;n para pedido interno.</p> 





</div>
<script type="text/javascript">
$( function(){

});
</script>
<script type="text/javascript">
		/* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
		var disqus_shortname = 'fastorder'; // required: replace example with your forum shortname
		//var disqus_identifier = 'scrum';
		var disqus_url='http://fastorder.lamona.mx/index';
		/* * * DON'T EDIT BELOW THIS LINE * * */
		(function() {
			var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
			dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
			(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
		})();
	</script>
<div class="">		
	<div id="disqus_thread"></div>		
	<noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
	<a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
</div>