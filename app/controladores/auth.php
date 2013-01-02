<?php
require_once '../mvc/modelos/user_model.php';
require_once('../traducciones/user_widget.php');
require_once('../php_libs/recaptcha-php-1.11/recaptchalib.php');
class Auth extends Controlador{ 
	var $validarCaptcha=true;
	/*
		logout: Limpia los datos de la sesion.
	*/
	function logout(){
		$model=$this->getModel();
		$model->logout();
		header ('Location: /index.php');
	}
	
	/*
		emailUnico: Revisa si el email proporcionado está disponible para registrarse. (emailDisponible)		
	*/
	function emailUnico( $email = null){
	
		if ( $email != null ){
			$imprimir=false;
		}else{
			$imprimir=true;
			$email=$_POST['email'];
		}
		
		$userMod=$this->getModel();		
		$user=$userMod->findByEmail($email);
		
		$unico=false;
		if ( empty($user) ){
			$unico=true;
		}
		
		$resp= array(
			'success'=>true,
			'data'=>array(
				'unico'=>$unico
			)
		);
		if ( $imprimir ){
			echo json_encode($resp);
		}else{
			return $imprimir;
		}		
	}
			
	/*
		login: inicia la sesion del usuario
		
		Para el caso de redireccionaniemto desde el mismo sistema ¿Puedo saber desde que pagina llege hasta aqui?
	*/
		
	function login($nick_email=null, $pass=null){			
		
		if (  isset($_SESSION['isLoged']) && $_SESSION['isLoged']===true ){			
			if ($_SESSION['userInfo']['rol']==2){
				header('Location: /users/admin');
			}else{
				header('Location: /user.php');
			}
			
		}
		if ($_SERVER['REQUEST_METHOD']!='POST'){
			return $this->mostrarVista();
		}
		
		//cuando la peticion es POST, llegamos aca
				
		//Primero se revisan los datos recibidos
		global $user_w_msg;
		
		if ($nick_email == null && $pass==null){
			$imprimir=true;
			$nick_email = $_POST['username'];
			$pass = $_POST['password'];
		}else{
			$imprimir=false;
		}
		
		$errores=array();
		
		if ( empty($nick_email) ){
			$errores['nick_email']=$user_w_msg['USERNAME_EMAIL_REQUERIDO']; //'This field is required';
		}
		
		if ( empty($pass) ){
			$errores['pass']=$user_w_msg['PASS_REQUERIDO']; //'This field is required';			
		}
		
		$params=array(
			'nick_email'=>$nick_email
		);
		
		if (!empty($errores) ){
			//Devolver la misma pagina mostrando los errores de validación
			$vista= $this->getVista();					
			global $_PETICION;
			$vista->errores=$errores;
			$vista->valores=$params;
			
			return $vista->mostrar($_PETICION->controlador.'/'.$_PETICION->accion);	
		}
		
		$mod=$this->getModel();
		$resp = $mod->login($nick_email, $pass);
		
		if ($resp['success']==true){
			if ($_SESSION['userInfo']['rol']==2){
				header('Location: /users/admin');
			}else{
				header('Location: /user.php');
			}
			exit;
		}else{
			$vista = $this->getVista();
			global $_PETICION;
			$errores=array('nick_email'=>$user_w_msg['LOGIN_ERROR'] ); // Nombre de usuario y/o contraseña incorrecta
			$vista->errores=$errores;
			$vista->valores=$params;
			return $vista->mostrar($_PETICION->controlador.'/'.$_PETICION->accion);
		}
	}
	
	function signup(){	
		global $user_w_msg;
		// http://php.net/manual/es/filter.examples.validation.php		
		if ($_SERVER['REQUEST_METHOD']=='GET'){
			$vista= $this->getVista();					
			global $_PETICION;
			
			return $vista->mostrar($_PETICION->controlador.'/'. $_PETICION->accion);		
		}				
		$errores=array();
		//-------------------------------------------------------------
		//		VALIDACION DE LOS PARAMETROS POST
		//-------------------------------------------------------------
		if ( empty($_POST['nick']) ){
			$errores['nick'] = $user_w_msg['USERNAME_REQUERIDO'];
		}else {
			$nick_size=strlen( $_POST['nick'] );			
			if ($nick_size>255 || $nick_size < 6) {
				$errores['nick'] = $user_w_msg['USERNAME_SIZE']; //
			}
		}
		//-------------------------------------------------------------		
		if ( empty($_POST['email']) ){
			$errores['email'] = $user_w_msg['EMAIL_REQUERIDO']; //'this field is required';			
		}else if ( !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ) {
			$errores['email'] = $_POST['email']. $user_w_msg['EMAIL_INVALID']; //' is not a valid email address'
		}
		
		if ( empty($_POST['name']) ){
			$errores['name'] = $user_w_msg['REQUERIDO']; //'this field is required';			
		}
		//-------------------------------------------------------------
		if ( empty($_POST['pass']) ){
			$errores['pass'] =$user_w_msg['PASS_REQUERIDO']; // 'this field is required'
		}else{
			$pass_size=strlen( $_POST['pass'] );			
			if ($pass_size>20 || $pass_size < 6) {
				$errores['pass'] = $user_w_msg['PASS_SIZE']; // 'debe usar entre 6 y 20 caracteres';
			}
		}
		//-------------------------------------------------------------
		if ( empty($_POST['retype']) ){
			$errores['retype'] =$user_w_msg['RETYPE_REQUERIDO']; //'this field is required';			
		}else{
			$pass_size=strlen( $_POST['retype'] );			
			if ($pass_size>20 || $pass_size < 6) {
				$errores['retype'] = $user_w_msg['RETYPE_SIZE']; //'debe usar entre 6 y 20 caracteres';
			}
		}
		//-------------------------------------------------------------
		if ( ( !empty($_POST['retype']) && !empty($_POST['pass']) ) && ( empty($errores['retype']) && empty($errores['pass']) ) ){
			if ($_POST['retype'] != $_POST['pass'] ){
				$errores['pass'] = $user_w_msg['CONTRAS_DIFERENTES'];  //'las contraseñas no coinciden';				
			}
		}
		//-------------------------------------------------------------
		$params=array(
			'nick'	=> $_POST['nick'],
			'email'	=> $_POST['email'],
			'pass'	=> $_POST['pass'],
			'name'	=> $_POST['name'],
			'retype'	=> $_POST['retype']
		);
		
		$userMod = $this->getModel();
		if (empty($errores) ){
			//Las validacione basicas han pasado, ahora revisaré que el usuario y correo no existan
			$user=$userMod->findByEmail($_POST['email']);
			if ( !empty($user) ){
				$errores['email'] = $user_w_msg['EMAIL_REGISTRADO']; //'El email ya está registrado';
			 }
			
			$user=null;
			$user=$userMod->findByNick($_POST['nick']);
			if ( !empty($user) ){
				$errores['nick'] = $user_w_msg['NICK_REGISTRADO']; //'El nick ya está registrado';
			 }
		}
		
		if ( isset($this->validarCaptcha)  )
			if ($this->validarCaptcha){
				$privatekey = "6LeCftgSAAAAAI5vbS6R6YS3_bPMXzxexs3HJoh0";
				$resp = recaptcha_check_answer ($privatekey,
										$_SERVER["REMOTE_ADDR"],
										$_POST["recaptcha_challenge_field"],
										$_POST["recaptcha_response_field"]);
				if (!$resp->is_valid) {
					$errores['captcha']=$user_w_msg['CAPTCHA_INCORRECTO']; //'The reCAPTCHA wasn\'t entered correctly. Go back and try it again.';			
				 } 
			}

		if (!empty($errores) ){
			//Devolver la misma pagina con errores,
			$vista= $this->getVista();					
			global $_PETICION;
			$vista->errores=$errores;
			$vista->valores=$params;
			return $vista->mostrar($_PETICION->controlador.'/'. $_PETICION->accion);		
		}
		//------------------------------------------------
		$nick	= $_POST['nick'];
		$email	= $_POST['email'];
		$pass	= $_POST['pass'];
		$nombre = $_POST['name'];
		$resp = $userMod->registrar($nick, $email, $pass, $nombre);
		if ($resp['success']==true){			
			header('Location: /user.php');
		}else{
			//Devolver la misma pagina mostrando un error, ya no en un campo sino en una seccion talvez arriba o abajo del formulario.
			echo 'ERROR';
			exit;
		}			
	}
	
	function fblogin(){
		global $FB_APP_ID;
		global $FB_APP_SECRET;
		global $FB_MY_URL;
		global $FB_LOGOUT_ABSOLUTE;
		global $FB_VINCULAR_ABSOLUTE;
		//$FB_APP_ID = '134398456707585';
		//$app_secret = '366da0a53f61f804fc8c9c427cc09c26';		
		//$my_url 		= 'http://memez.dolcemami.com/users/fblogin';
		//$logoutAbsolute = 'http://memez.dolcemami.com/users/logout';
		
		require '../php_libs/facebook-php-sdk-master/src/facebook.php';

	   if(empty($_REQUEST["code"])) {
		 $_SESSION['state'] = md5(uniqid(rand(), TRUE)); // CSRF protection
		 $dialog_url = "https://www.facebook.com/dialog/oauth?client_id=" 
		   . $FB_APP_ID . "&redirect_uri=" . urlencode($FB_MY_URL) . "&state="
		   . $_SESSION['state'].'&scope=email'; 

		 echo("<script> top.location.href='" . $dialog_url . "'</script>");
	   }else{
			$code = $_REQUEST["code"];
			if( $_SESSION['state'] && ($_SESSION['state'] === $_REQUEST['state']) ){
				$token_url = "https://graph.facebook.com/oauth/access_token?"
				. "client_id=" . $FB_APP_ID . "&redirect_uri=" . urlencode($FB_MY_URL)
				. "&client_secret=" . $FB_APP_SECRET . "&code=" . $code;

				$response = file_get_contents($token_url);
				$params = null;
				parse_str($response, $params);
				$_SESSION['access_token'] = $params['access_token'];
				
				$graph_url = 'https://graph.facebook.com/me?access_token='. $params['access_token'];
				$fb_user = json_decode(file_get_contents($graph_url));
				
				$config = array(
					'appId'  => $FB_APP_ID,
					'secret' => $FB_APP_SECRET,
				 );
				 
				 $logoutUrl='https://www.facebook.com/logout.php/?next='.urlencode($FB_LOGOUT_ABSOLUTE).'&access_token='.$params['access_token'];
				 $_SESSION['logoutUrl'] = $logoutUrl;
				 
				 $fbid= $fb_user->id;
				 $model = $this->getModel();
				 $userDB=$model->findByFbId($fbid);
				 if ( empty($userDB) ){
					/*
					   No fue encontrado un usuario con esta cuenta de facebook.
					
					   El sistema busca una coincidencia contra los datos de facebook, en cuyo caso, tratará de vincular las cuentas, 
					   para eso se solicita la contraseña almacenada en el sistema.
					*/
					   $resp=$model->buscarCoincidencias($fb_user->username, $fb_user->email );					   
					   $view_params=array(
							'nick'	=> $fb_user->username,
							'email'	=> $fb_user->email,
							'fbid'	=> $fb_user->id,
							'name'	=> $fb_user->name
						);
					   if ( $resp['success']==true ){														
							
							$errores=array();
							if ( isset($resp['coincidencias']['email']) ){
								//$errores['email']='El email ya está registrado en el sistema';
							}
							if ( isset($resp['coincidencias']['nick']) ){
								//$errores['nick']='El username ya está registrado en el sistema';
							}							
							$url='https://www.facebook.com/logout.php/?next='.urlencode($FB_VINCULAR_ABSOLUTE).'&access_token='.$params['access_token'];
							header('Location: '.$url);
							return false;							
					   }
					
					// cargar vista fb_signup
					// $user = $model->fb_signup($fbid, $username, $email);					
					//-------------------------------------------------		
					$mod=$this->getModel();
					$mod->registrarFb($fb_user->username, $fb_user->name, $fb_user->email, $fb_user->id);
					
					$vista= $this->getVista();					
					global $_PETICION;
					$vista->errores=$errores;
					$vista->valores=$view_params;
					return $vista->mostrar('users/upload');		
					//return $vista->mostrar($_PETICION->controlador.'/'. $_PETICION->accion);		
					//-------------------------------------------------
				 }else{
					$resp = $model->fbLogin( $fbid );
					if ($resp['success']==true){			
						if ($_SESSION['userInfo']['rol']==2){
							header('Location: /users/admin');
						}else{
							header('Location: /user.php');
						}
						//header('Location: /users/upload');
					}
				 }		 				 
			}else {
				//  CARGAR ESTO EN UNA VISTA, PARA NO PERDER EL ESTILO CLARO
				echo("The state does not match. You may be a victim of CSRF.");
			}
		}
	}
	
	function fbsignup(){
		global $user_w_msg;
		//Recibe la confirmación del usuario con los datos de facebook y los almacena en la bd, luego se inicia la sesion automatica
		if ($_SERVER['REQUEST_METHOD']=='GET'){
			$vista= $this->getVista();					
			global $_PETICION;
			//return $vista->mostrar('fblogin');		
			return $vista->mostrar($_PETICION->controlador.'/fblogin');		
		}
		$errores=array();
		//-------------------------------------------------------------
		//		VALIDACION DE LOS PARAMETROS POST
		//-------------------------------------------------------------
		if ( empty($_POST['nick']) ){
			$errores['nick'] = $user_w_msg['REQUERIDO']; //'this field is required';
		}else {
			$nick_size=strlen( $_POST['nick'] );			
			if ($nick_size>255 || $nick_size < 6) {
				$errores['nick'] = $user_w_msg['NICK_SIZE']; //'debe usar entre 6 y 255 caracteres';
			}
		}
		//-------------------------------------------------------------		
		if ( empty($_POST['email']) ){
			$errores['email'] = 'this field is required';			
		}else if ( !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ) {
			$errores['email'] = $_POST['email']. $user_w_msg['EMAIL_INVALID']; //' is not a valid email address';							
		}
		//-------------------------------------------------------------
		
		//-------------------------------------------------------------
		$params=array(
			'nick'	=> $_POST['nick'],
			'email'	=> $_POST['email'],
			'fbid'	=> $_POST['fbid']
		);
		
		$userMod = $this->getModel();
		if (empty($errores) ){
			/*//Las validacione basicas han pasado, ahora revisaré que el usuario y correo no existan
			*/
		}
	
		if (!empty($errores) ){
			//Devolver la misma pagina con errores,
			$vista= $this->getVista();					
			global $_PETICION;
			$vista->errores=$errores;
			$vista->valores=$params;
			//return $vista->mostrar('fblogin');				
			return $vista->mostrar($_PETICION->controlador.'/fblogin');		
		}
		//------------------------------------------------
		$nick	= $_POST['nick'];
		$email	= $_POST['email'];		
		$fbid	= $_POST['fbid'];
		
		$resp = $userMod->registrarFb($nick,$name, $email, $fbid);
		if ($resp['success']==true){			
			header('Location: /user.php');
		}
		
		if ($resp['success']==false){
			$vista= $this->getVista();					
			global $_PETICION;
			$vista->errores=array('error'=>$resp['msg']);
			$vista->valores=$params;
			//return $vista->mostrar('fblogin');			
			return $vista->mostrar($_PETICION->controlador.'/fblogin');					
			exit;
		}
	}
	
	function getModel(){		
		if ( !isset($this->modObj) ){						
			$this->modObj = new UserModel();	
		}	
		return $this->modObj;
	}	
	function changepass(){
		if ( empty($_POST['old']) ){
			$errores['old']='This field is required';			
		}		
		$oldPass=$_POST['old'];
		
		if ( empty($_POST['nuevo']) || empty($_POST['retype']) ){
			$errores['new']='This fields are required';			
		}
		$new=$_POST['nuevo'];
		$retype=$_POST['retype'];
		
		if (!empty($errores)){		
			echo json_encode(array(
				'success'=>false,
				'errors'=>$errores
			));
			exit;
		}
		//comprueba que los pass coincidan
		if ( $new != $_POST['retype'] ){
			$errores['new']='Passwords did not match';
			echo json_encode(array(
				'success'=>false,
				'errors'=>$errores
			));
			exit;
		}
		
		//comprueba que la contraseña sea la misma que la de la base de datos
		$mod=$this->getModel();		
		$id=$_SESSION['userInfo']['id'];
		$pass=$oldPass;
		$comprobado=$mod->compruebaPass($id,$pass);
		if (!$comprobado['success'] ){
			$errores['old']=$comprobado['msg'];
			echo json_encode(array(
				'success'=>false,
				'errors'=>$errores
			));
			exit;
		}
		$pass=$new;
		$res=$mod->updatePass($id,$pass);
		if ($res['success']){
			echo json_encode(array(
					'success'=>true,
					'msg'=>'Password has been changed.'
			));
		}else{
			echo json_encode(array(
				'success'=>false,
				'msg'=>$res['msg']
			));
		
		}
		
		
		
	}
	
	function forgot(){


		$vista = $this->getVista();

		if(isset($_GET['hash']) && isset($_GET['email'])) {
			$valores = array();
			$userMod = $this->getModel();
			$model = $userMod->findByEmail($_GET['email']);



			if ($_SERVER['REQUEST_METHOD']=='POST') {
				$userMod = $this->getModel();
				$user = $userMod->findByEmail($_GET['email']);

				$sql='UPDATE system_users SET
				pass=AES_ENCRYPT("'.$_POST['new_password'].'", "m3me1234z") WHERE id = '.$user['id'];

				$con = $userMod->getConexion();
				$sth = $con->prepare($sql);
				$res = $sth->execute();

				$valores['reset_succesfull'] = true;
				$valores['reset'] = true;
				$vista->valores = $valores;
				return $vista->mostrar();
			}

			if(empty($model)) {
				$valores['404'] = true;
				$vista->valores = $valores;
				return $vista->mostrar();
			} else {

				if(md5($model["request"]) != $_GET['hash']){
					$valores['404'] = true;
				$vista->valores = $valores;
					$vista->valores = $valores;
					return $vista->mostrar();
				} else {
					$valores['reset'] = true;
					$vista->valores = $valores;
					return $vista->mostrar();
				}

			}



		} else {

			if ($_SERVER['REQUEST_METHOD']=='POST') {
					if ( isset($this->validarCaptcha)  )
						if ($this->validarCaptcha){
							$privatekey = "6LeCftgSAAAAAI5vbS6R6YS3_bPMXzxexs3HJoh0";
							$resp = recaptcha_check_answer ($privatekey,
													$_SERVER["REMOTE_ADDR"],
													$_POST["recaptcha_challenge_field"],
													$_POST["recaptcha_response_field"]);
							if (!$resp->is_valid) {
								$res=array();
								global $user_w_msg;
								$res['captcha_error']=$user_w_msg['CAPTCHA_INCORRECTO']; //'The reCAPTCHA wasn\'t entered correctly. Go back and try it again.';			
								echo json_encode($res);exit;
							 }
							 
						}
						
					$data = $_POST;
					
					$userMod = $this->getModel();
					$user = $userMod->findByEmail($data['email']);
					if ( empty($user) ){
						$user = $userMod->findByNick($data['email']);
					}
					$result = array();

					if(empty($user)){
						$result['error'] = "Sorry, we can't found the user with the email " . $data['email'] .", please check and try again";
					} else {



						$requested_time = time();

						$sql='UPDATE system_users SET
								request=:request WHERE id = '.$user['id'];

						$update_user = $this->getModel();
						$con = $update_user->getConexion();
						$sth = $con->prepare($sql);
						$sth->bindValue(':request', $requested_time, PDO::PARAM_STR);
						$res = $sth->execute();

						$url_hashed = "http://".$_SERVER['SERVER_NAME']."/reset.php?hash=".md5($requested_time)."&email=".$user["email"];
						ob_start();						
						/*$message = <<<MSG
								Hi {$user["name"]},<br /><br />

								You recently asked to reset your Memez password.<br /><br />

								<a href="{$url_hashed}">Click here to change your password.</a><br /><br />

								Didn't request this change?<br />
								If you didn't request a new password, let us know immediately.
MSG;
						*/
						require_once '../mvc/vistas/auth/email.php';
						$message = ob_get_contents();
						 ob_end_clean();
						$to = $user["email"];
						$from = "noreply@memez.com";
						$subject = 'You requested a new Memez password? ';

						$headers  = "From: $from\r\n";
						$headers .= "Content-type: text/html\r\n";
						$headers .= "MIME-Version: 1.0\r\n";
						$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
						$x = mail($to, $subject, $message, $headers);

						$result['success'] = "Ok, We sent a email to your email account with a link to reset your password";
					}

					echo json_encode($result);
			} else {

				return $vista->mostrar();
			}

		}
	}
}
?>