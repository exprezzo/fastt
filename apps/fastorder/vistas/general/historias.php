<h3>Bugs</h3>
<ul>
	<li>Edicion Pedido: Aveces, los headers del grid articulos se muestran colapsados (con un ancho muy peque&ntilde;o que no deja ver ni el texto)</li>
	<li>Cuando seleccionas manualmente una serie, deja de funcionar la seleccion automatica desde el combo almacen</li>
</ul>

<script>
	$(function(){
		var tabId="<?php echo $_REQUEST['tabId']; ?>";
		var selectorTab='#'+tabId;	
		
		$(selectorTab + " .tareas_sprint").wijgrid();
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
<h3>Sprint </h3>
2013 02 05 Minuta
<table class="tareas_sprint">
	<thead>
		<tr>
			<?php 
			$tareas=array();
			
			
			
			
			$tareas[]=array(				
				'tarea'		 	=>'Pedido, el nombre correcto del primer m&oacute;dulo es "Pedido Interno" para que se corriga en las pantallas.
			<br>Agrege el folio y la serie al encabezado.',				
				'responsable'	=>'',
				'estimado' 		=>'',				
				'modulo' 		=>'Pedido Interno',
				'h_inicio'	 	=>'10:10',
				'h_fin'	 		=>'10:55',
				'duracion'  	=>'00:45',
				'diferencia'	=>''				
			);
			
			$tareas[]=array(				
				'tarea'		 	=>'En los filtros de Pedido Interno Cuando no se estable fecha final pero si vencimiento mostrar todos a partir de fecha vencimiento.',				
				'responsable'	=>'',
				'estimado' 		=>'',				
				'modulo' 		=>'Pedido Interno',
				'h_inicio'	 	=>'10:57',
				'h_fin'	 		=>'11:07',
				'duracion'  	=>'00:10',
				'diferencia'	=>''				
			);
			
			
			$tareas[]=array(				
				'tarea'		 	=>'Agregar titulo al estado en la lista de pedidos internos',
				'responsable'	=>'',
				'estimado' 		=>'',				
				'modulo' 		=>'Pedido Interno',
				'h_inicio'	 	=>'11:08',
				'h_fin'	 		=>'11:17',
				'duracion'  	=>'00:09',
				'diferencia'	=>''				
			);
				
			$tareas[]=array(				
				'tarea'		 	=>'Solo se puede modificar pedidos internos que esten en estado solicitado, se pudiera abrir de solo lectura pero no modificar',				
				'responsable'	=>'',
				'estimado' 		=>'',				
				'modulo' 		=>'Pedido Interno',
				'h_inicio'	 	=>'11:19',
				'h_fin'	 		=>'11:29',
				'duracion'  	=>'00:10',
				'diferencia'	=>''				
			);
			
			$tareas[]=array(				
				'tarea'		 	=>'El Inventario Inical se almacenr&aacute; en su registro corresponidente del stock del almacen una vez que se guarde el pedido interno',				
				'responsable'	=>'',
				'estimado' 		=>'',				
				'modulo' 		=>'Pedido Interno',
				'h_inicio'	 	=>'11:29',
				'h_fin'	 		=>'12:25',
				'duracion'  	=>'00:56',
				'diferencia'	=>''				
			);
			
			$tareas[]=array(				
				'tarea'		 	=>'sugerido = max - Inv_ini,  Si Inv_Ini <= Punto Reorden.
			<br>Al modificar el campo Inv_ini o Pedido, recalcular',				
				'responsable'	=>'',
				'estimado' 		=>'',				
				'modulo' 		=>'Pedido Interno',
				'h_inicio'	 	=>'12:30',
				'h_fin'	 		=>'01:10',
				'duracion'  	=>'00:40',
				'diferencia'	=>''				
			);
			
			$tareas[]=array(				
				'tarea'		 	=>'Agregar boton al lado del combo almacen, al presionar, pre - cargar en el grid todos los articulos manejados por ese almacen',				
				'responsable'	=>'',
				'estimado' 		=>'',				
				'modulo' 		=>'Pedido Interno',
				'h_inicio'	 	=>'13:24',
				'h_fin'	 		=>'14:16',
				'duracion'  	=>'00:52',
				'diferencia'	=>''				
			);
			
			$tareas[]=array(				
				'tarea'		 	=>'Pedido Interno - Permitir buscar articulos por codigo. (ligar con el combo articulo)',				
				'responsable'	=>'',
				'estimado' 		=>'',				
				'modulo' 		=>'Pedido Interno',
				'h_inicio'	 	=>'16:07',
				'h_fin'	 		=>'18:21',
				'duracion'  	=>'02:14',
				'diferencia'	=>''				
			);
			
			$tareas[]=array(				
				'tarea'		 	=>'Navegacion con la tecla enter: <br />enter para captura ràpida y que se pase a la siguiente lìnea en la misma columna y si ya es la última automáticamente agregue un nuevo registro',				
				'responsable'	=>'',
				'estimado' 		=>'2:00',				
				'modulo' 		=>'Pedido Interno',
				'h_inicio'	 	=>'10:30-13:14',
				'h_fin'	 		=>'14:00-14:46',
				'duracion'  	=>'03:28',
				'diferencia'	=>''				
			);
			
			$tareas[]=array(				
				'tarea' 		=>'Navegacion con tecla <b>Tab</b>:<br /> Si utilizó tabs en la captura que al llegar al final de una fila, automáticamente se pase a la siguiente y habilite captura de registro si hay uno sino que agregue un registro en blanco',				
				'responsable'	=>'',
				'estimado' 		=>'01:00',
				'modulo' 		=>'Pedido Interno',
				'h_inicio'	 	=>'14:51',
				'h_fin'	 		=>'16:09',
				'duracion'  	=>'1:18',
				'diferencia'	=>''				
			);
			
			$tareas[]=array(				
				'tarea'		 	=>'Permitir agregar nuevos varias veces',				
				'responsable'	=>'',
				'estimado' 		=>'00:20',
				'modulo' 		=>'Pedido Interno',
				'h_inicio'	 	=>'16:45',
				'h_fin'	 		=>'16:52',
				'duracion'  	=>'00:08',
				'diferencia'	=>''
			);
			
			$tareas[]=array(				
				'tarea'		 	=>'teclas ràpidas.<ul>				
				
				<li style="display:inline-block;"><h4>Crud</h4></li>				
				<li class="listo">Ctrl + Alt + N: Nuevo Registro</li>
				<li class="listo">Ctrl + G: guardar</li>				
				<li class="listo">Del: eliminar</li>				
				<li>Ctrl + P: imprimir</li>
				<li>Ctrl + D: Duplicar</li>
				<li>Ctrl + E: Enviar por correo</li>				
				<li>Tecla Esc, para salir del editor</li>				
				<li>Ctrl + A: Agregar nuevo detalle</li>								
								
				<li style="display:inline-block;"><h4>Navegacion en tabs</h4></li>
				<li class="listo">Ctrl + Alt + W: para cerrar pestaña</li>				
				<li>Ctrl + P: Sig Tab</li>
				<li>Ctrl + P: Tab Anterior</li>
				
				
				</ul>',				
				'responsable'	=>'',
				'estimado' 		=>'04:00',				
				'modulo' 		=>'Pedido Interno',
				'h_inicio'	 	=>'18:09',
				'h_fin'	 		=>'21:47',
				'duracion'  	=>'xx:xx',
				'diferencia'	=>''
			);
			
			$tareas[]=array(				
				'tarea'		 	=>'cuando se modifique registro y se pretenda cerrar registro que te pregunte si deseas guardar los cambios, si, no y cancelar',				
				'responsable'	=>'',
				'estimado' 		=>'03:00',				
				'modulo' 		=>'Pedido Interno',
				'h_inicio'	 	=>'09:51',
				'h_fin'	 		=>'13:19',
				'duracion'  	=>'03:28',
				'diferencia'	=>''				
			);
			
			$tareas[]=array(				
				'tarea'		 	=>'Se mostrará una lista de los pedidos internos sin surtir(solicitado) se le permitirá al usuario seleccionar y correr el proceso
			<br/>	de concentración que mostrará una ventana agrupando por grupo y por producto todos los registros de productos sim	ilares.
			<br/>	Al final se tendrá una lista de productos que suman todos los requerimientos de los pedidos internos solicitados.
			<br/>sugerido en concentración es:    Max - (Suma Can pedido Interno -  Inv Ini)   si (suma can pedido interno - Inv Ini) <= Punto Reorden',				
				'responsable'	=>'',
				'estimado' 		=>'30:00',
				'modulo' 		=>'Concentraci&oacute;n',
				'h_inicio'	 	=>'',
				'h_fin'	 		=>'',
				'duracion'  	=>'',
				'diferencia'	=>''
			);
			
			$tareas[]=array(				
				'tarea'		 	=>'optimizar para resolución de 1024',
				'responsable'	=>'',
				'estimado' 		=>'03:00',
				'modulo' 		=>'Ped Int',
				'h_inicio'	 	=>'09/02/12 09:00',
				'h_fin'	 		=>'09/02/12 01:58',
				'duracion'  	=>'04:58',
				'diferencia'	=>''
			);
			
			$tareas[]=array(				
				'tarea'		 	=>'Detalles del pedido: procesar en el cliente
				<ul>
				<li class="listo">Agregar Nuevo Articulo</li>
				<li class="listo">Precargar Articulos</li>
				<li class="listo">Guardar</li>
				<li>Eliminar Articulo</li>
				<li>Actualizar producto al seleccionar codigo (considerar la cancelacion de edicion para devolver el estado a todas las celdas modificadas)</li>
				<li>Actualizar codigo al seleccionar producto</li>
				<li>Actualizar sugerido y pendiente al modificar existencia o pedido</li>
				<li class="listo">Al guardar, actualizar la existencia en la tabla </li>
				</ul>
				',
				'responsable'	=>'',
				'estimado' 		=>'06:00',
				'modulo' 		=>'Ped Int',
				'h_inicio'	 	=>'13/02/12 09:00',
				'h_fin'	 		=>'23/02/12 15:00',
				'duracion'  	=>'',
				'diferencia'	=>''
			);
			
			$tareas[]=array(				
				'tarea'		 	=>'Navegacion con tabs
				<ul><li class="listo">Que funcione con shift tab para retroceder</li>				
				<li class="listo">Que navege entre paginas (hacia atras y adelante)</li>
				</ul>',
				'responsable'	=>'',
				'estimado' 		=>'06:00',
				'modulo' 		=>'Ped Int',
				'h_inicio'	 	=>'14/02/12 9:00',
				'h_fin'	 		=>'15/02/12 5:58',
				'duracion'  	=>'12',
				'diferencia'	=>'6'
			);
			$tareas[]=array(				
				'tarea'		 	=>'Navegacion con enter
				<ul><li>Cambiar de pagina cuando sea necesario</li>
				</ul>',
				'responsable'	=>'',
				'estimado' 		=>'06:00',
				'modulo' 		=>'Ped Int',
				'h_inicio'	 	=>'14/02/12 9:00',
				'h_fin'	 		=>'14/02/12 01:10',
				'duracion'  	=>'',
				'diferencia'	=>''
			);
			
			$tareas[]=array(				
				'tarea'		 	=>'Crear accesos directos a los catálogos
				<ul><li>Ctrl P: Pedidos Internos</li>
				</ul>',
				'responsable'	=>'',
				'estimado' 		=>'',
				'modulo' 		=>'Usabilidad',
				'h_inicio'	 	=>'',
				'h_fin'	 		=>'',
				'duracion'  	=>'',
				'diferencia'	=>''
			);
			
			$tareas[]=array(				
				'tarea'		 	=>'Documentar solución al bug del toolbar',				
				'responsable'	=>'',
				'estimado' 		=>'',
				'modulo' 		=>'Nucleo',
				'h_inicio'	 	=>'',
				'h_fin'	 		=>'',
				'duracion'  	=>'',
				'diferencia'	=>''
			);
			
			
			$tareas[]=array(				
				'tarea'		 	=>'Lista de orden de compra',				
				'responsable'	=>'Cesar Octavio',
				'estimado' 		=>'6:00',
				'modulo' 		=>'Orden de compra',
				'h_inicio'	 	=>'15:00 pm',
				'h_fin'	 		=>'19:36 pm',
				'duracion'  	=>' 4:36 pm',
				'diferencia'	=>' +2:00 '
			);
			$tareas[]=array(				
				'tarea'		 	=>'orden de compra manual
					<ul>
						<li>Precarga de articulos</li>
					</ul>
				',				
				'responsable'	=>'Cesar Octavio',
				'estimado' 		=>'6:00',
				'modulo' 		=>'Orden de compra',
				'h_inicio'	 	=>'17:00 pm',
				'h_fin'	 		=>'21:00 PM',
				'duracion'  	=>'',
				'diferencia'	=>''
			);
			
			
			?>		
			<td>Tarea</td>
			<td>Responsable</td>
			<td>Estimaci&oacute;n</td>			
			<td>M&oacute;dulo</td>
			<td>Hora Inicio</td>
			<td>Hora Final</td>
			<td>Duraci&oacute;n</td>
			<td>Diferencia de estimación</td>
		</tr>
	</thead>
		<?php 
			foreach($tareas as $tarea){
				echo '<tr>
			<td>'.$tarea['tarea'].'</td>
			<td>'.$tarea['responsable'].'</td>
			<td>'.$tarea['estimado'].'</td>			
			<td>'.$tarea['modulo'].'</td>
			<td>'.$tarea['h_inicio'].'</td>
			<td>'.$tarea['h_fin'].'</td>
			<td>'.$tarea['duracion'].'</td>
			<td>'.$tarea['diferencia'].'</td>
					</tr>';
			}
		?>
		
</table>

<ul>
	<li>Definir teclas de acceso rápido     luiguiok</li>
	<li>Al final del renglón cachar el shift tab y prevenir el saldo línea.</li>
	<li>Al modificar valores de inventario inicial y pedidos no se actualiza al regresar del servidor.</li>
	<li>La resolución predeterminado por el momento será 1024x800px... el navegador a utilizar es el chrome</li>
	<li>autoGuardar automático de documentos u objetos.</li>
	<li>Separar la versión desarrollo de una versión estable y de pruebas o beta.</li>
	<li><h4>Orden de Compra:</h4>
		<ul>
			<li>Campos Filtro:   Folio+serie, Fecha Inicial Docto, Fecha Final Docto, Fecha Vence, Estado, Proveedor.</li>
			<li>Campos de captura:  Folio + Serie, automaticos configurable desde panel. *Panel Pendiente Back Log, Fecha Docto:, Proveedor</li>
			<li>Estados (auto): Borrador, Enviado, Cancelado, Surtido, Parcialmente Surtido, Vencido.</li>			
			<li>Detalle: Agrupado x grupo
                Agrupado x Articulo     ---> Campos: aticulo id, nombre/Descripcion, Unidad Base, //Presentación, Factor  //, Max, Min, P. Reor, Inv ini, suma ped int, sugerido, pedido
                Lista de Pedidos Interno Detalle relacionado si lo hay   --->  artículo de linea o wakal(compuesto), almacen pedido interno, cantidad solicitada.
			</li>
			<li>
				Bandera de pendiente de concentrar para los pedidos internos.
				Pedidos, Ordenes de Compra o Requisiciones se concentrarán a partir de la cantidad pendiente por concentrar.
			</li>
		</ul>                             
   </li>
	<li>Concentración de pedidos internos: Definir como se hará</li>
	
</ul>

<ul>
	
	<li><h4>Revisado: 05/feb/2013</h4><hr /><li>
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
			<li >Al cambiar/seleccionar almac&eacute;n, seleccionar serie default en autom&aacute;tico (8:45pm-10:13pm, 1:28)</li>
			<li>Al seleccionar serie, seleccionar siguiente folio en autom&aacute;tico (9:07-9:20, 0:20)</li>
			<li>Al guardar, asignar el folio correspondiente (impedir folios duplicados), en caso de ser diferente al pre-asignado, notificar al usuario (10:38-12:50, 2:12)</li>
			<li>Si no hay folios disponibles,  impedir guardar</li>
		</ul>
	</li>
	
</ul>




<br>
<h3>Backlog: </h3>
<ul>	
	<li>Crear Interface de Artículos, para poder modificar almacenes prioridades y proveedores.</li>
	<li>Permitir configurar si la información en un módulo se almacena en el cliente hasta que se de guardar o temporalmente en el servidor cada vez que cambias algún valor.</li>
	<li>Agrupar las opciones en módulos de acuerdo a su uso por parte del usuario p ej. si soy almacenista veo info de articulso, pedidos, entradas y salida y si soy cobrador, nada más veo clientes y saldos.</li>
	<li>Configuraci&oacute;n - Crear un modo de configuraci&oacute;n para jalar la serie y el folio que le sigue por almac&eacute;n.</li>	
	<li>Al Logear preguntar la sucursal y el almac&eacute;n si se puede almacenar por default el &uacute;ltimo seleccionado.</li>
	<li>Formatos de Impresi&oacute;n para pedido interno.</li>
	<li>Quiero poder entrar al sistema, usando mi cuenta de twiter, facebook, gmail, o con la contrase&ntilde;a del sitio.</li>
	<li>Como desarrollador, quiero documentacion que me ayude a desarrollar en el framework</li>
	<li>Como usuario, quiero que el sistema mantenga un historial de mensajes (en especial los de error).</li>
	<li>Como usuario, quiero manipular el orden de las columnas en los grids y que asi se queden.</li>
	<li>Como usuario, cuando modifico un parametro de busqueda, quiero que asi permanezca aunque salga del sistema.</li>
	<li>Como usuario, quiero que el tama&ntilde;o de grids se adapte a los diferentes dispositivos y orientaciones de pantalla.</li>
	<li>Como usuario, quiero poder configurar el tama&ntilde;o de grids dependiendo del dispositivo y orientacion de pantalla.</li>
	<li>Como webmaster, quiero un historial de sucesos en especial de error, para supervisar y dar seguimiento.</li>
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




