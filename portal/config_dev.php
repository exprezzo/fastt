<?php
//$APP_URL='http://'.$_SERVER['SERVER_NAME']; 
$DB_CONFIG=array(
	'DB_SERVER'	=>'localhost',
	'DB_NAME'	=>'elrinco1_fastdev',
	'DB_USER'	=>'elrinco1_fastdev',
	'DB_PASS'	=>'1234asdf' //'#fsE8x^sUNyd'
);

if (!defined('DEFAULT_APP') ) define('DEFAULT_APP','fastorder');
if (!defined('DEFAULT_CONTROLLER') ) define('DEFAULT_CONTROLLER','general');
if (!defined('DEFAULT_ACTION') ) define('DEFAULT_ACTION','index');

$_LOGIN_REDIRECT_PATH = '/'.DEFAULT_APP.'/'.DEFAULT_CONTROLLER.'/'.DEFAULT_ACTION;
// Configuracion del ssitio
define ("NOMBRE_APL",'Fast Order');
define ("PASS_AES",'faztA3s');

define ("TEMA",'cobalt');
// define ("TEMA",'black-tie');

define ("PATH_MVC",'../mvc/');
//define ("DEFAULT_CONTROLLER",'general');
// CONFIGURA LA RUTA DEL NUCLEO
define ("PATH_NUCLEO",'../mvc_core/');

?>