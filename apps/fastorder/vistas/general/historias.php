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
	<li>Quiero poder entrar al sistema, usando mi cuenta de twiter, facebook, gmail, o con la contrase�a del sitio.</li>
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
	<li class="listo">Pedido Interno - La lista de la B&uacute;squeda tiene que tener lo siguiente, Folio y serie; Almacen, Fecha, Fecha Vencimiento, Estado. (12:55-1:05, 0:10)</li>
	<li class="listo">Pedido Interno - Folio y serie
		<ul>			
			<li >Guardar Serie (campo requerido) (8:00pm-8:44 pm,0:44)</li>
			<li >Al cambiar/seleccionar almac&eacute;n, seleccionar serie default en autom�tico (8:45pm-10:13pm, 1:28)</li>
			<li>Al seleccionar serie, seleccionar siguiente folio en autom�tico (9:07-9:20, 0:20)</li>
			<li>Al guardar, asignar el folio correspondiente (impedir folios duplicados), en caso de ser diferente al pre-asignado, notificar al usuario (10:38-12:50, 2:12)</li>
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
	<li>Edicion Pedido: Aveces, los headers del grid articulos se muestran colapsados (con un ancho muy peque�o que no deja ver ni el texto)</li>
	<li>Cuando seleccionas manualmente una serie, deja de funcionar la seleccion automatica desde el combo almacen</li>
</ul>
<div>

<h3>01/02/2013</h3>

<ul>
	<li>Sugerido pedido interno = max - Inventario ini   Si Inv Ini <= Punto Reorden</li>
	<li>Agregar boton al lado del combo almacen, al presionar, pre - cargar en el grid todos los articulos manejados por ese almacen</li>
	<li>enter para captura ràpida y que se pase a la siguiente lìnea en la misma columna y si ya es la última automáticamente agregue un nuevo registro.</li>
	<li>teclas ràpidas.</li>
	<li>Si utilizó tabs en la captura que al llegar al final de una fila, automáticamente se pase a la siguiente y habilite captura de registro si hay uno sino que agregue un registro en blanco.</li>
	<li>cuando se modifique registro y se pretenda cerrar registro que te pregunte si deseas guardar los cambios, si, no y cancelar.</li>
	<li>Permitir agregar nuevos varias veces.</li>
	<li>Permitir configurar si la información en un módulo se almacena en el cliente hasta que se de guardar o temporalmente en el servidor cada vez que cambias algún valor.</li>
	<li>Agrupar las opciones en módulos de acuerdo a su uso por parte del usuario p ej. si soy almacenista veo info de articulso, pedidos, entradas y salida y si soy cobrador, nada más veo clientes y saldos.</li>
	<li>sugerido en concentración es:    Max - (Suma Can pedido Interno -  Inv Ini)   si (suma can pedido interno - Inv Ini) <= Punto Reorden</li>
	<li><span>Concentración:Se mostrará una lista de los pedidos internos sin surtir(solicitado) se le permitirá al usuario seleccionar y correr el proceso
		<br/>	de concentración que mostrará una ventana agrupando por grupo y por producto todos los registros de productos similares.
		<br/>	Al final se tendrá una lista de productos que suman todos los requerimientos de los pedidos internos solicitados.
	</li>
	
	
</ul>

</div>



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
