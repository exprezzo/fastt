<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/>
		<title>Fast Order</title>
		<link rel="shortcut icon" href="/favicon.ico"/>		
		<!--jQuery References-->
		<!--link href="/js/jquery-ui-1.9.2.custom/css/flick/jquery-ui-1.9.2.custom.css" rel="stylesheet"-->	
		<script src="/js/libs/jquery-1.8.3.js"></script>
		<script src="/js/libs/jquery-ui-1.9.2.custom/jquery-ui-1.9.2.custom.js"></script>  
		<!--Theme-->
		<!--link href="http://cdn.wijmo.com/themes/rocket/jquery-wijmo.css" rel="stylesheet" type="text/css" title="rocket-jqueryui" /-->
		<!--link href="/css/themes/rocket/jquery-wijmo.css" rel="stylesheet" type="text/css" title="rocket-jqueryui" /-->
		<link href="/css/themes/cobalt/jquery-wijmo.css" rel="stylesheet" type="text/css" title="rocket-jqueryui" />		
		<!--Wijmo Widgets CSS-->	
		<link href="/js/libs/Wijmo.2.3.2/Wijmo-Complete/css/jquery.wijmo-complete.2.3.2.css" rel="stylesheet" type="text/css" />
		<link href="/js/libs/Wijmo.2.3.2/Wijmo-Open/css/jquery.wijmo-open.2.3.2.css" rel="stylesheet" type="text/css" />		
		<!--Wijmo Widgets JavaScript-->
		<script src="/js/libs/Wijmo.2.3.2/Wijmo-Complete/js/jquery.wijmo-complete.all.2.3.2.min.js" type="text/javascript"></script>
		<script src="/js/libs/Wijmo.2.3.2/Wijmo-Open/js/jquery.wijmo-open.all.2.3.2.min.js" type="text/javascript"></script>		
		<script type="text/javascript">
			$(document).ready(function () {
				var errorPass="<? echo !empty($this->errores['pass'])? $this->errores['pass'] : ''; ?>";
				var errorUsername="<? echo !empty($this->errores['username'])? $this->errores['username'] : ''; ?>";
				
				
				$(":input[type='text'],:input[type='password']").wijtextbox();
				if (errorPass!=''){
					var ttip=$("input[name='pass']").wijtooltip({content:errorPass,position:{my: 'left bottom',at: 'right center'}});
					ttip=$("input[name='pass']").wijtooltip('show');				
				}
				if (errorUsername!=''){
					var ttip=$("input[name='username']").wijtooltip({content:errorUsername,position:{my: 'left bottom',at: 'right center'}});
					ttip=$("input[name='username']").wijtooltip('show');				
				}
				$('button').click(function(){
					$(this).addClass('activo');
				});
				
			});
		</script>
		<style type="text/css">
			body{
				font-family: Lucida Grande, Lucida Sans, Arial, sans-serif;
				background: #F8E088 url(/images/stripe2.png);
			}
			
			form {
				border-top: 1px solid #B83A1F;
				border-radius: 4px 4px 5px 5px;
				width:400px;	
				position:absolute;
				left:50%;
				margin-left:-200px;
				top:50%;
				margin-top:-200px;
				padding:0;					
				background-color:white;				
				-webkit-box-shadow: rgba(0, 0, 0, 0.2) 0px 0px 5px;
				-moz-box-shadow: rgba(0,0,0,0.2) 0px 0px 5px;
				-o-box-shadow: rgba(0,0,0,0.2) 0px 0px 5px;
				box-shadow: rgba(0, 0, 0, 0.2) 0px 0px 5px;
			}			
			
			.contenido{
				padding:30px;
				border-left: 1px solid #DEDEDE;
				
			}
			.inputBox input{
				width:300px;
				border:1px solid #CCC !important;				
			}
			label{
				width:100px;
				display:inline-block;
			}
			.inputBox{
				margin-top:5px;
			}
			.error{
				width:auto;
				color:red;
				position:absolute;
			}
			
			.header{
				border-top: 1px solid #B83A1F;
				border-radius: 4px 4px 0 0;
				color:white;
				padding:0;
				margin:0;
				background-color:#CF3B19;
				font-weight:bold;
				padding:5px 5px 5px 5px;
				font-size:20px;
			}
			
			.titulo{
				font-weight:bold;
			}
			button:hover{
				box-shadow: rgba(0, 0, 0, 0.4) 0px 1px 3px;
			}
			button.activo{ 
			  background: green !important;
			  color:white;
			}
			button{
				display: inline-block;
				margin: 0 .7em 0 0;
				padding: 5px 10px 6px 10px;
				border: 1px solid #DEDEDE;
				border-right: 1px solid #BBB;
				border-bottom: 1px solid #BFBFBF;
				background-color: white;
				background: -webkit-gradient(linear, left top, left bottom, from(white), to(#E9E9E9));
				background: -webkit-linear-gradient(top, white, #E9E9E9);
				background: -moz-linear-gradient(top, white, #E9E9E9);
				background: -ms-linear-gradient(top, white, #E9E9E9);
				background: -o-linear-gradient(top, white, #E9E9E9);
				font-family: "Lucida Grande", Tahoma, Arial, sans-serif;
				font-size: 100%;
				line-height: 130%;
				color: #464646;
				cursor: pointer;
				text-decoration: none;
				-webkit-border-radius: 11px;
				-moz-border-radius: 11px;
				border-radius: 11px;
				-moz-background-clip: padding;
				-webkit-background-clip: padding-box;
				background-clip: padding-box;
				-webkit-box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 1px;
				-moz-box-shadow: rgba(0,0,0,0.1) 0px 1px 1px;
				box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 1px;
			}
			
			.ui-widget-content{
				border-radius: 11px;
				-webkit-box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 1px;
				-moz-box-shadow: rgba(0,0,0,0.1) 0px 1px 1px;
				box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 1px;
				border-color:red;
			}
			.wijmo-wijtooltip-pointer{
				border-radius: 0;
			
			}
		</style>
	</head>

	<body onload="" style="">		
		<form id="forLogin" action="/user/login" method="POST" >
			<div class="header">Bienvenidos al sistema FastOrder</div>			
			
			<div class="contenido">
				<div class="titulo">Login</div>
				
				<? if (!empty($this->errores['general']) ) echo $this->errores['general']; ?><br/>
				
				<div class="inputBox">
					<label>Usuario:</label><br>
					<input id="txtLogUsu" name="username" type="text" placeholder="Nombre de usuario" value="<? if (!empty($this->valores['username']) ) echo $this->valores['username']; ?>"/>				
				</div>
				<br>
				<div class="inputBox">
					<label>Contrase&ntilde;a:</label><br>
					<input id="txtLogCon" name="pass" Type="password" placeholder="Contrase&ntilde;a de Usuario" />				
				</div>
				
								<br />
				<div style="text-align:center;">
					<button id="botLogAce" type="submit" name="submit" value="Iniciar" >Entrar</button>
				</div>
			</div>			
		</form>			
	</body>
</html>