<?php
class User extends Controlador{
	function logout(){
		header ('Location: /login');exit;
	}
}
?>