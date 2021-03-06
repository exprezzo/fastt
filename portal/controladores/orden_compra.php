<?php

require_once '../'.$_PETICION->modulo.'/modelos/orden_compra_model.php';
require_once '../'.$_PETICION->modulo.'/modelos/orden_compra_producto_model.php';
require_once '../'.$_PETICION->modulo.'/modelos/orden_compra_serie_model.php';
// require_once '../'.$_PETICION->modulo.'/modelos/articulo_stock_model.php';
 require_once '../'.$_PETICION->modulo.'/modelos/proveedor_model.php';
// require_once '../'.$_PETICION->modulo.'/modelos/serie_compra_model.php';
 require_once '../'.$_PETICION->modulo.'/modelos/estado_orden_compra_model.php';
 require_once '../'.$_PETICION->modulo.'/modelos/articulo_model.php';
// require_once '../'.$_PETICION->modulo.'/modelos/um_model.php';

class Orden_Compra extends Controlador{	

	function getModel(){		
		if ( !isset($this->modObj) ){						
			$this->modObj = new OrdenCompraModel();	
		}	
		return $this->modObj;
	}
	
	function getCodigos(){		
		$mod=new ArticuloModel();				
		$start=0;		
		$idalmacen=empty($_REQUEST['idalmacen'])? 0 :$_REQUEST['idalmacen'];
		$res=$mod->paginar($start,90, $idalmacen, $codigo='');				
		
		echo json_encode($res);	
	}
	
	function getSeries(){
		$idAlmacen=$_GET['idalmacen'];
		$mod=new OrdenCompraSerieModel();
		$res=$mod->getSeries($start=0, $limit=9, $idAlmacen);
		if ( !$res['success'] ){
			echo json_encode($res);	exit;
		}
		$respuesta=array(
			'rows'=>$res['datos'],
			'totalRows'=> $res['total']
		);
		echo json_encode($respuesta);
	}
	
	function eliminar(){
		$modObj= $this->getModel();
		$params=array();
		
		if ( !isset($_POST['id']) ){
			$id=$_POST['datos'];
		}else{
			$id=$_POST['id'];
		}
		$params['id']=$id;
		
		$res=$modObj->borrar($params);
		
		$response=array(
			'success'=>$res,
			'msg'=>'Orden de compra Eliminada'
		);
		echo json_encode($response);
		exit;
	}
		
		
	function getArticulos(){
		$mod=new ArticuloModel();		
		// $paging=$_GET['paging'];
		// $start=intval($paging['pageIndex'])*9;		
		$start=0;		
		$idalmacen=empty($_REQUEST['idalmacen'])? 0 :$_REQUEST['idalmacen'];
		$res=$mod->paginar($start,90, $idalmacen);				
		
		echo json_encode($res);	
	}
	
	function getUnidadesMedida(){
	
	
	
		$mod=new UMModel();		
		// $paging=$_GET['paging'];
		// $start=intval($paging['pageIndex'])*9;		
		$start=0;		
		$res=$mod->paginar($start,90);				
		
		$respuesta=array(	
			'rows'=>$res['datos'],
			'totalRows'=> $res['total']
		);
		echo json_encode($respuesta);	
	}
	
	function nuevo(){		
		if ( $_SERVER['REQUEST_METHOD'] == 'GET' ){
			
			$vista= $this->getVista();					
			return $vista->mostrar( 'orden_compra/edicion' );
		}
		 $mod=$this->getModel();
		 $mod->indexTabla=1;
		 $pedido=$mod->nuevo();
		 // print_r($pedido);exit;
		 $vista=$this->getVista();
		 $vista->pedido =$pedido['datos'];
		 $vista->mostrar('orden_compra/edicion');
	}
	
	function editar(){
		$idPedido=empty($_REQUEST['id'])? 0 : $_REQUEST['id'];		
		$pedido=$this->getOC();		
	}
	function getProveedores(){
		
		$provMod= new ProveedorModel();
		$res=$provMod->paginar();
		
		if ( !$res['success']) echo json_encode($res);
		
		
		echo json_encode( array(
			'success'=>true,
			'rows'=>$res['datos'],
			'totalRows'=>$res['total'],
		) );
	}
	function getOC($id = null){
		if ($id==null){
			$idPedido=$_REQUEST['id'];
			$mostrar=true;
		}else{
			$idPedido=$id;
			$mostrar=false;
		}
		$mod=$this->getModel();
		
		$pedido = $mod->obtener( $idPedido );
		
		
		if ( empty($pedido) ){
			$pedido['id']=0;
			$pedido['fk_almacen']=0;
			$pedido['idproveedor']=0;
		}
		$mod=new OrdenCompraProductoModel();
		
		$params=array(	//Se traducen al lenguaje sql
			'limit'		=>$pageSize=50000,
			'start'		=>0,
			'fk_orden_compra'	=>$pedido['id'],
			'idalmacen'	=>$pedido['fk_almacen'],
			'idproveedor'	=>$pedido['idproveedor'],
		);
		
		$res=$mod->paginar($params);
		
		
		$vista=$this->getVista();
		
		 
		if ($res['success']) $pedido['articulos']=$res['rows'];	
				
		$vista->pedido=$pedido;
		
		
		 	// print_r($pedido);exit;
		
		if ($mostrar==true){
			$vista->mostrar('/orden_compra/edicion');
		}else{
			return $vista;
		}
	}
	
	function index(){
		
		global $_PETICION;
		$PETICION=$_PETICION;
		
		
		$mod=$this->getModel();
		$res=$mod->paginar(array());
		
		$vista=$this->getVista();
		$vista->pedidos=$res['datos'];
		$vista->total=$res['total'];
		
		//Esto debe ir en el nucleo
		if ( $_SERVER['REQUEST_METHOD'] == 'GET' ){		
			$vista= $this->getVista();					
			return $vista->mostrar( '/index' );
		}
		$estados=array();
		
		$almMod= new ProveedorModel();
		$res=$almMod->paginar();
		$vista->proveedores=$res['datos'];
		
		$estMod= new EstadoOrdenCompraModel();
		$res=$estMod->paginar();
		$vista->estados=$res['datos'];
		
		return $this->mostrarVista($PETICION->controlador.'/lista');
	}
	
	function paginar(){
		$mod=$this->getModel();
		
		$fi='';
		if ( !empty($_GET['fechai']) ){
			$fechai=DateTime::createFromFormat ( 'd/m/Y' ,$_GET['fechai']);
			$fi=$fechai->format('Y-m-d').' 00:00:00';
		}
		
		$ff='';
		if ( !empty($_GET['fechaf']) ){
			$fechaf=DateTime::createFromFormat ( 'd/m/Y' ,$_GET['fechaf']);
			$ff=$fechaf->format('Y-m-d').' 23:59:59';
		}
		
		$fv='';
		if ( !empty($_GET['vencimiento']) ){
			$vencimiento=DateTime::createFromFormat ( 'd/m/Y' ,$_GET['vencimiento']);
			$fv=$vencimiento->format('Y-m-d').' 00:00:00';
		}								
		
		$paging=$_GET['paging']; //Datos de paginacion enviados por el componente js
		if ($paging['pageSize']<0) $paging['pageSize']=0;
		$params=array(	//Se traducen al lenguaje sql
			'pageSize'=>$pageSize=intval($paging['pageSize']),
			'start'=>intval($paging['pageIndex'])*$pageSize,
			'fechai'=>$fi,
			'fechaf'=>$ff,
			'vencimiento'=>$fv,			
			'idproveedor'=>$_GET['idproveedor'],
			'idestado'=>$_GET['idestado']
		);
		
		$res=$mod->paginar($params);				
		if ( !$res['success'] ){
			echo json_encode($res); exit;
		}
		
		
		$respuesta=array(
			'rows'=>$res['datos'],
			'totalRows'=> $res['total']
		);
		echo json_encode($respuesta);
	}
	
	function getAlmacenes(){
		$mod=new AlmacenModel();
		// $paging=$_GET['paging'];
		// $start=intval($paging['pageIndex'])*9;
		$start=0;		
		$res=$mod->paginar($start,9);				
		
		$respuesta=array(	
			'rows'=>$res['datos'],
			'totalRows'=> $res['total']
		);
		echo json_encode($respuesta);		
	}
	function guardar(){
		$pedido= $_POST['pedido'];
		
		if ( empty($_POST['pedido']) ){
			$res=array(
				'success'=>false,
				'msg'=>'No se recibieron datos para almacenar'
			);
			echo json_encode($res); exit;
		}
		if ( empty($_POST['pedido']['almacen']) ){
			$res=array(
				'success'=>false,
				'msg'=>'Debe seleccionar un almac&eacute;n de origen'
			);
			echo json_encode($res); exit;
		}
		
		if ( empty($_POST['pedido']['fk_serie']) ){
			$res=array(
				'success'=>false,
				'msg'=>'Debe seleccionar una serie'
			);
			echo json_encode($res); exit;
		}
		
		if ( !isset($_POST['pedido']['folio']) || !is_numeric($_POST['pedido']['folio']) ){
			$res=array(
				'success'=>false,
				'msg'=>'Debe asignar un <b>Folio</b> v&aacute;lido'
			);
			echo json_encode($res); exit;
		}
		
		 
		
		$fecha = DateTime::createFromFormat('d/m/Y', $pedido['fecha']);
		$pedido['fecha']= $fecha->format('Y-m-d H:i:s');
		
		$vencimiento = DateTime::createFromFormat('d/m/Y', $pedido['vencimiento']);
		$pedido['vencimiento']= $vencimiento->format('Y-m-d H:i:s');
		
		$model=$this->getModel();		
		
		$res = $model->guardar($pedido);
		
		if (!$res['success']) {			
			echo json_encode($res); exit;
		}
		$pk=$res['datos']['id'];
		
		$pedido=$res['datos'];
		
		//----------------
		$mod=new OrdenCompraProductoModel();
		
		$params=array(	//Se traducen al lenguaje sql
			'limit'=>$pageSize=50000,
			'start'=>0,
			'fk_orden_compra'=>$pedido['id'],
			'idalmacen'=>$pedido['fk_almacen']
		);
		
		$resArts=$mod->paginar($params);		
		
		
		
		if (!$resArts['success']) {
			echo json_encode($resArts); exit;		
		} 
		// print_r($resArts);
		$pedido['articulos']=$resArts['rows'];		
		
		
		$res['datos']=$pedido;		
		echo json_encode($res);
	}
	function cerrar(){
		$fk_tmp	=$_POST['id'];
		$mod	=$this->getModel();
		return $mod->cerrar($fk_tmp);
	}
}
?>