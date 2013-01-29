<script>
	$(function(){
		var tabId="<?php echo $_REQUEST['tabId']; ?>";
		tabId = '#' + tabId;
		this.tabId = tabId;
		
		// $('div'+tabId).css('padding','0px 0 0 0');
		// $('div'+tabId).css('margin-top','0px');
		// $('div'+tabId).css('border','0 1px 1px 1px');

		$('div'+tabId).addClass('ui-widget-content');
		
		
		var tab=$('a[href="'+tabId+'"]');
		tab.html('Bienvenido');
		tab.addClass('welcome');
		
	});
	
</script>
<div style="margin-top:-29px;">
<h1>Bienvenido</h1>
<h2>Consultas o Preguntas</h2>
<br />
<h2>Bugs</h2>
<br />
<h2>En desarrollo</h2>
<h3>Sprint</h3>
<p class="pendiente">Pedido Interno - Agregar en el filtro el almacén.</p>
<p class="pendiente">Pedido Interno - Agregar en el filtro la fecha vencimiento ( un solo campo y filtrará de acuerdo a los pedidos internos cuya fecha de venccimiento sea mayor o igual a la fecha.)</p>
<p class="pendiente">Pedido Interno - Agregar en el filtro Estado de Documentos.</p>
<p class="pendiente">Pedido Interno - Las fechas pueden quedar vacías en los filtros de búsqueda.</p>
<p class="pendiente">Pedido Interno - La lista de la Búsqueda tiene que tener lo siguiente, Folio y serie; Almacen, Fecha, Fecha Vencimiento, Estado.</p>
<p class="pendiente">Pedido Interno - Estados: Solicitado, Concentrado, Parcialmente Surtido, Surtido, Cancelado, Cadudaco.</p>
<p class="pendiente">Pedido Interno - Folio y serie de acuerdo a almacén y al dar nuevo y empezar la captura sugerirá el siguiente y si hay un cambio al momento de guardar se le avisará al usuario.</p>
<p class="pendiente">Pedido Interno - El grid del listado de insumos se agrupa por grupo y se ordena de acuerdo a campo articulostock.grupoposicion y los que sean sugeribles.</p>
<p class="pendiente">Pedido Interno - El grid: Listar los campos como sigue: Codigo articulo, Nombre Articulo, Unidad Medida, Máximo, Mínimo, P Reorden, Inventario Inicial, Sugerido x Sistema, Pedido, Pendiente.</p> 
<p class="pendiente">Pedido Interno - Campos a modificiar: Codigo Articulo <-> Nombre Articulo, Inventario inicial, Pedido.</p>


<h3>Back Log</h3>
<p class="pendiente">Configuración - Crear un modo de configuración para jalar la serie y el folio que le sigue por almacén.</p>
<p class="pendiente">Al Logear preguntar la sucursal y el almacén si se puede almacenar por default el último seleccionado.</p>
<p class="pendiente">Formatos de Impresión para pedido interno.</p> 

<p class="pendiente">Guardar Configuración de búsquedas por usuario, módulo y sucursal</p>
<p class="pendiente">Cambiar tamaño de grids (todos) de acuerdo a la configuración hecha por el usuario en un determinado dispositivo.</p>
<p class="pendiente">Poder en todos los grids manipular el orden de las columnas y que se almacene de acuerdo al usuario.</p>
<p class="pendiente">Historial de Mensajes del sistema al usuario por sesión no se necesita guardar en servidor ni en cliente.</p>
<p class="pendiente">Historial de Errores graves del sistema crear un log para supervisar y dar seguimiento.</p>


<br><br><br><br><br><br><br><br><br><br><br>
</div>