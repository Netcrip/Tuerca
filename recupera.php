<?php
	require 'funcs/conexion.php';
	include 'funcs/funcs.php';
	
	//session_start();
	
	if(isset($_SESSION["id_usuario"])){
		header("Location: Taller/index.php");
	}
	$mensaje="";
	$errors = array();
	
	if(!empty($_POST))
	{
		$email = $mysqli->real_escape_string($_POST['email']);
		
		if(!isEmail($email))
		{
			$errors[] = "Debe ingresar un correo electronico valido";
		}
		
		if(emailExiste($email))
		{			
			$user_id = getValor('uid', 'correo', $email);
			$nombre = getValor('nombre', 'correo', $email);
			
			$token = generaTokenPass($user_id);
			
			$url = 'http://'.$_SERVER["SERVER_NAME"].'/proyecto2/cambia_pass.php?user_id='.$user_id.'&token='.$token;
			
			$asunto = 'Recuperar Password - Sistema de Usuarios';
			$cuerpo = "Hola $nombre: <br /><br />Se ha solicitado un reinicio de contrase&ntilde;a. <br/><br/>Para restaurar la contrase&ntilde;a, visita la siguiente direcci&oacute;n: <a href='$url'>$url</a>";
			
			if(enviarEmail($email, $nombre, $asunto, $cuerpo)){
				$mensaje='<div class="card"><div class="bg-success"><p class="text-white text-justify">'."Hemos enviado un correo electronico a las direcion $email para restablecer tu password.".'</p></div></div>'."<br /><a class='btn' href='login.php' >Iniciar Sesion</a>";
				 
			}
			} else {
			$errors[] = "La direccion de correo electronico no existe";
		}
	}
?>
<html>
	<head>
		<?php include("head.php") ?>
		<title>Recuperar Password</title>
		
		<link rel="stylesheet" href="css/bootstrap-theme.min.css" >
		<script src="js/bootstrap.min.js" ></script>
	</head>
	
	<body class="bcolor" >
	<?php include("nav.php")?>
	<div class="fondo">
		
		<div class="container">    
			<div id="signupbox"  class="d-flex justify-content-center h-100">                    
				<div class="card" >
					<div class="card-header" >
						<div class="card-header">
							<h3>Recuperar Password</h3>
						</div>
					</div>     
					<?php echo $mensaje; ?>
					<div class="card-body" style="padding-top:10px" >
						
						<div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
						
						<form id="loginform" class="form-horizontal" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">
							
							<div style="margin-bottom: 25px" class="input-group-prepend col-md-12">
								<span class="input-group-text"><i class="fas fa-user fa-2x fa-lg"></i></span>
								<input id="email" type="email" class="form-control" name="email" placeholder="email" required>                                        
							</div>
							
							<div style="margin-top:10px" class="input-group form-group">
								<div class=" col-12">
									<button id="btn-login" type="submit" class="btn btn-success btn-block">Enviar</a>
								</div>
							</div>
							
							<div class="card-footer">
                    			<div class="d-flex justify-content-center links">
                        			¿No tienes Cuenta?<a href="./registro.php">  Registrate aqui</a>
                    			</div>
                    			
                			</div>
   
						</form>
						<?php echo resultBlock($errors); ?>
					</div>                     
				</div>  
			</div>
		</div>
	</div>
	<?php include("footer.php")?>
	</body>
</html>