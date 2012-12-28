<?php

require_once '../app/modelos/pedido_model.php';
require_once '../app/modelos/almacen_model.php';
class Pedidoi extends Controlador{
	function getModel(){		
		if ( !isset($this->modObj) ){						
			$this->modObj = new PedidoModel();	
		}	
		return $this->modObj;
	}
	
	function getArticulos(){
		$datos=array();
		
		$datos[]=array(
			'id'=>1,
			'nombre'=>'nombre'
		);
		$datos[]=array(
			'id'=>2,
			'nombre'=>'nombre 2'
		);
		
		$datos[]=array(
			'id'=>3,
			'nombre'=>'nombre 3'
		);
		
		$respuesta=array(
			'success'=>true,
			'msg'=>'',
			'datos'=>$datos
		);
		echo json_encode( $respuesta );
		return $respuesta;
	}
	function nuevoPedido(){
		$vista=$this->getVista();
		$vista->mostrar('pedidoi/pedidoi');
	}
	
	function getPedido(){
		$mod=$this->getModel();
		$idPedido=$_REQUEST['pedidoId'];
		$pedido = $mod->getPedido( $idPedido );
		
		$vista=$this->getVista();
		$vista->pedido=$pedido;
		$vista->mostrar('pedidoi/pedidoi');
	}
	
	function verPedidos(){
		$mod=$this->getModel();
		$res=$mod->paginar();
		
		
		
		$vista=$this->getVista();
		$vista->pedidos=$res['datos'];
		$vista->total=$res['total'];
		
		$vista->mostrar('pedidoi/lista_de_pedidos');
	}
	
	function lista_de_pedidos(){
		return $this->verPedidos();		
	}
	
	function paginar(){
		$mod=$this->getModel();
		$paging=$_GET['paging'];
		$start=intval($paging['pageIndex'])*9;
		$pageSize=intval($paging['pageSize']);
		$res=$mod->paginar($start,$pageSize);				
				
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
		$model=$this->getModel();
		$res = $model->guardar($pedido);
		echo json_encode($res);
	}
}
?>