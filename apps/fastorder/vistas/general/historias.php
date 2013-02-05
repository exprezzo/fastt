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
<br>
Backlog:
<ul>	
	<li>Quiero poder entrar al sistema, usando mi cuenta de twiter, facebook, gmail, o con la contraseña del sitio.</li>
	<li>Como desarrollador, quiero documentacion que me ayude a desarrollar en el framework</li>
	<li>Como usuario, quiero que el sistema mantenga un historial de mensajes (en especial los de error).</li>
	<li>Como usuario, quiero manipular el orden de las columnas en los grids y que asi se queden.</li>
	<li>Como usuario, cuando modifico un parametro de busqueda, quiero que asi permanezca aunque salga del sistema.</li>
	<li>Como usuario, quiero que el tama&ntilde;o de grids se adapte a los diferentes dispositivos y orientaciones de pantalla.</li>
	<li>Como usuario, quiero poder configurar el tama&ntilde;o de grids dependiendo del dispositivo y orientacion de pantalla.</li>
	<li>Como webmaster, quiero un historial de sucesos en especial de error, para supervisar y dar seguimiento.</li>
</ul>

Sprint 1<br/>
<ul>
	<li class="listo">Pedido Interno - Agregar en el filtro el almac&eacute;n.</li>
	<li class="listo">Pedido Interno - Agregar en el filtro la fecha vencimiento ( un solo campo y filtrar&aacute; de acuerdo a los pedidos internos cuya fecha de venccimiento sea mayor o igual a la fecha.)</li>
	<li class="listo">Pedido Interno - Las fechas pueden quedar vac&iacute;as en los filtros de b&uacute;squeda.(12:00-2:20pm, 2hrs 20min)</li>
	<li class="listo">Pedido Interno - El grid del listado de insumos se agrupa por grupo y se ordena de acuerdo a campo articulostock.grupoposicion y los que sean sugeribles.</li>
	<li class="listo">Pedido Interno - El grid: Listar los campos como sigue: Codigo articulo, Nombre Articulo, Unidad Medida, M&aacute;ximo, M&iacute;nimo, P Reorden, Inventario Inicial, Sugerido x Sistema, Pedido, Pendiente.</li> 
	<li class="listo">Pedido Interno - Campos a modificiar: Nombre Articulo, Inventario inicial, Pedido.</li>
	<li class="listo">Pedido Interno - Agregar en el filtro Estado de Documentos. (3:30pm - 5:19pm, 1:49)</li>
	<li class="listo">Pedido Interno - Estados: Solicitado, Concentrado, Parcialmente Surtido, Surtido, Cancelado, Caducado.</li>
	<li class="enproceso">Pedido Interno - La lista de la B&uacute;squeda tiene que tener lo siguiente, Folio y serie; Almacen, Fecha, Fecha Vencimiento, Estado.</li>
	<li class="enproceso">Pedido Interno - Folio y serie
		<ul>			
			<li class="listo">Guardar Serie (campo requerido) (8:00pm-8:44 pm,0:44)</li>
			<li class="listo">Al cambiar/seleccionar almac&eacute;n, seleccionar serie default en automático (8:45pm-10:13pm, 1:28)</li>
			<li>Al seleccionar serie, seleccionar folio en automático</li>
			<li>Al guardar, asignar el folio correspondiente, en caso de ser diferente al pre-asignado, notificar al usuario</li>
			<li>Si no hay folios disponibles,  impedir guardar</li>
		</ul>
	</li>
	<li class="enproceso">Pedido Interno - Permitir buscar articulos por codigo.</li>
</ul>


<h3>Sprint 2 </h3> (##/##/####)<br/>
<ul>
	<li></li>
</ul>


<p class="pendiente">Configuraci&oacute;n - Crear un modo de configuraci&oacute;n para jalar la serie y el folio que le sigue por almac&eacute;n.</p>
<p class="pendiente">Al Logear preguntar la sucursal y el almac&eacute;n si se puede almacenar por default el &uacute;ltimo seleccionado.</p>
<p class="pendiente">Formatos de Impresi&oacute;n para pedido interno.</p> 
<h3>Bugs</h3>
<ul>
	<li>Edicion Pedido: Aveces, los headers del grid articulos se muestran colapsados (con un ancho muy pequeño que no deja ver ni el texto)</li>
	<li>Cuando seleccionas manualmente una serie, deja de funcionar la seleccion automatica desde el combo almacen</li>
</ul>





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