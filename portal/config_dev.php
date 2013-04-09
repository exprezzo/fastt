<?php
//$APP_URL='http://'.$_SERVER['SERVER_NAME']; 
$DB_CONFIG=array(
	'DB_SERVER'	=>'localhost',
	'DB_NAME'	=>'elrinco1_fastdev',
	'DB_USER'	=>'elrinco1_fastdev',
	'DB_PASS'	=>'1234asdf',
	'PASS_AES'=>'faztA3s'
);

$APP_CONFIG=array(
	'nombre'=>'Fast Order',
	'tema'=>'cobalt'
);

$_DEFAULT_CONTROLLER='general';
$_DEFAULT_ACTION='index';

$_LOGIN_REDIRECT_PATH = '/'.$_DEFAULT_APP.'/'.$_DEFAULT_CONTROLLER.'/'.$_DEFAULT_ACTION;
?>