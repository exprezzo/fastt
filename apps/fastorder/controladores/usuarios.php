<?php
class Usuarios extends Controlador{
	
		function crear(){
			if( $_SESSION['isLoged'] && $_SESSION['userInfo']['id'] == 1 ){
				$user=$_GET['user'];
				$pass=$_GET['pass'];
				$sql='INSERT INTO system_users SET nick=:nick, pass=AES_ENCRYPT(:pass,"'.PASS_AES.'")';
				$model=$this->getModel();
				$con=$model->getConexion();
				$sth=$con->prepare($sql);
				$sth->bindValue(':nick',$user, PDO::PARAM_STR);
				$sth->bindValue(':pass',$pass, PDO::PARAM_STR);
				
				$exito=$sth->execute();
				if ($exito){
					print_r( $model->getError($sth) ); 
				}
				
				echo "creado user: $user, pass: $pass";
			}else{
				echo '-_-';
			}
			
		}
}
?>