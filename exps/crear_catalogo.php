<?php
// http://fastt/exps/crear_catalogo.php?controlador=productos&modelo=Producto&tabla=productos
// http://fastt/exps/crear_catalogo.php?controlador=Almacenes&modelo=Almacen&tabla=almacenes
// http://fastt/exps/crear_catalogo.php?controlador=series&modelo=Serie&tabla=series
// http://fastt/exps/crear_catalogo.php?controlador=stocks&modelo=Stock&tabla=articulostock

include 'crear_controlador.php';
include 'crear_modelo.php';
include 'crear_vistas.php';
include 'crear_buscador.php';
include 'crear_buscadorjs.php';
include 'crear_editor.php';
include 'crear_editorjs.php';

$controlador = $_REQUEST['controlador'];
$modelo = $_REQUEST['modelo'];
$tabla = $_REQUEST['tabla'];
crear_catalogo($controlador,$modelo ,$tabla);
$ruta='..//apps/fastorder/controladores/';

function crear_catalogo($controlador, $modelo, $tabla){
	echo 'crear catalogo, controlador: '.$controlador.' tabla: '.$tabla.'<br/> ';
	//en la carpeta controladores crea el controlador
	crear_controlador($controlador, $modelo);
	crear_modelo($modelo, $tabla);
	crear_buscador($controlador, $modelo);
	crear_buscadorjs($controlador, $modelo);
	crear_editor($controlador, $modelo);
	crear_editorjs($controlador, $modelo);
	
}
?>

