<?php

require_once '../apps/'.$_PETICION->modulo.'/modelos/pedido_model.php';
require_once '../apps/'.$_PETICION->modulo.'/modelos/articulo_stock_model.php';
require_once '../apps/'.$_PETICION->modulo.'/modelos/almacen_model.php';
require_once '../apps/'.$_PETICION->modulo.'/modelos/serie_model.php';
require_once '../apps/'.$_PETICION->modulo.'/modelos/estado_pedido_model.php';
require_once '../apps/'.$_PETICION->modulo.'/modelos/articulo_model.php';
require_once '../apps/'.$_PETICION->modulo.'/modelos/um_model.php';
require_once '../apps/'.$_PETICION->modulo.'/vistas/pedidoi/reporte_pedido_pdf.php';
class Pedidoi extends Controlador{	
	function concentrar(){
		$mod=$this->getModel();
		$res = $mod->concentrar( $params=array() );
		echo json_encode($res);
	}
	
	function imprimir(){
		//$rep=new ReportePedidoPdf();		
		//$rep->imprimir();
	}

	function verlista(){
		return $this->verPedidos();
	}
	
	function getCodigos(){
		
		$mod=new ArticuloModel();				
		$start=0;		
		$idalmacen=empty($_REQUEST['idalmacen'])? 0 :$_REQUEST['idalmacen'];
		$res=$mod->paginar($start,90, $idalmacen, $codigo='');				
		
		echo json_encode($res);	
	}
	
	
	function precargar(){
		$idalmacen=$_REQUEST['idalmacen'];
		$idTmp=$_REQUEST['idtmp'];
		$pedidoid=$_REQUEST['pedidoid'];
		
		$mod=$this->getModel();
		$res=$mod->precargar($idTmp,$pedidoid, $idalmacen);
		echo json_encode($res);
		//Borra todos los temporales, carga los articulos de la tabla articulos stock
		
	}
	function getSeries(){
		$idAlmacen=$_GET['idalmacen'];
		$mod=new SerieModel();		
		// $paging=$_GET['paging'];
		// $start=intval($paging['pageIndex'])*9;				
		$res=$mod->getSeries($start=0, $limit=9, $idAlmacen);				
		
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
			'msg'=>'Pedido Eliminado'
		);
		echo json_encode($response);
		exit;
		//return $respuesta;
	}
	function guardarArticulo(){
		$datos=$_REQUEST['datos'];				
		$mod=new PedidoProductoTmpModel();		
		$res = $mod->guardar($datos);		
		//$res['success']=false;
		if ($res['success']==true) $res['msg']='';
		echo json_encode($res);
	}
	function getModel(){		
		if ( !isset($this->modObj) ){						
			$this->modObj = new PedidoModel();	
		}	
		return $this->modObj;
	}
	
	
	function verPedido(){		
		$idPedido=empty($_REQUEST['id'])? 0 : $_REQUEST['id'];		
		$pedido=$this->getPedido($idPedido);		
	}
	function getListaArticulos(){
		$mod=new PedidoProductoTmpModel();
		$fk_tmp=$_REQUEST['fk_tmp'];
		$paging=$_REQUEST['paging'];
		$params=array(	//Se traducen al lenguaje sql
			'limit'=>$pageSize=intval($paging['pageSize']),
			'start'=>intval($paging['pageIndex'])*$pageSize,
			'idalmacen'=>$_REQUEST['idalmacen']
		);
		$params['fk_tmp']=$fk_tmp;		
		$mod->indexTabla=1;
		$res=$mod->paginar($params);
		echo json_encode( $res );				
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
	
	function index($vistaFile=''){				
		$vista= $this->getVista();					
		return $vista->mostrar( '/index' );
	}
	
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
			return $vista->mostrar( '/index' );
		}
		 $mod=$this->getModel();
		 $mod->indexTabla=1;
		 $pedido=$mod->nuevo();
		 
		 $vista=$this->getVista();
		 $vista->pedido =$pedido['datos'];
		 $vista->mostrar('pedidoi/nuevo');
	}	
	function pedido(){
		$mod=$this->getModel();
		 $mod->indexTabla=1;
		 $pedido=$mod->nuevo();
		 
		 $vista=$this->getVista();
		 $vista->pedido =$pedido['datos'];
		 $vista->mostrar();
	}
	
	function getPedido($id = null){
		if ($id==null){
			$idPedido=$_REQUEST['pedidoId'];
			$mostrar=true;
		}else{
			$idPedido=$id;
			$mostrar=false;
		}
		$mod=$this->getModel();
		
		$pedido = $mod->obtener( $idPedido );
		
		$mod=new PedidoProductoModel();
		
		$params=array(	//Se traducen al lenguaje sql
			'limit'		=>$pageSize=50000,
			'start'		=>0,
			'fk_pedido'	=>$pedido['id'],
			'idalmacen'	=>$pedido['fk_almacen']
		);
		
		$res=$mod->paginar($params);
		
		$vista=$this->getVista();
		
		if ($res['success']) $pedido['articulos']=$res['rows'];	
				
		$vista->pedido=$pedido;
		
		
		
		if ($mostrar==true){
			$vista->mostrar('pedidoi/nuevo');
		}else{
			return $vista;
		}
	}
	
	function verPedidos(){
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
		
		$almMod= new AlmacenModel();
		$res=$almMod->paginar();
		$vista->almacenes=$res['datos'];
		
		$estMod= new EstadoPedidoModel();
		$res=$estMod->paginar();
		$vista->estados=$res['datos'];
						
		$vista->mostrar('pedidoi/lista_de_pedidos');
	}
	function pedidos(){
		return $this->lista_de_pedidos();
	}
	function lista_de_pedidos(){
		return $this->verPedidos();		
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
			'idalmacen'=>$_GET['idalmacen'],
			'idestado'=>$_GET['idestado']
		);
		
		$res=$mod->paginar($params);				
		
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
		$mod=new PedidoProductoModel();
		
		$params=array(	//Se traducen al lenguaje sql
			'limit'=>$pageSize=50000,
			'start'=>0,
			'fk_pedido'=>$pedido['id'],
			'idalmacen'=>$pedido['fk_almacen']
		);
		
		$resArts=$mod->paginar($params);		
		
		
		
		if (!$resArts['success']) {
			echo json_encode($resArts); exit;		
		} 
		$pedido['articulos']=$resArts['rows'];		
		//----------------
		
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