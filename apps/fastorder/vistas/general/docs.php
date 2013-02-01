<h2>Documentaci&oacute;n:</h2>

<h4>TabManager</h4>
Encapsula al objeto tab de Wijmo, con el proposito de agregar el comportamiento requerido por nuestro backend.<br />
<br />
Ejemplo de uso: <br/> <br/>
<span>
var tabm = new TabManager();<br />
tabm.init('#tabs');<br />

tabm.add('/usuarios/perfil/5');<br />
tabm.add('/paginas/ayuda','Ayuda',0,'iconAyuda');<br />
</span>
<ul>
	<li>init( selector )</li>
	<li>add( url,[titulo],[objId],[iconCls] )</li>
</ul>

