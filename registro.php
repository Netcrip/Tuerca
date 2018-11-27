<?php
	require 'funcs/conexion.php';
	include 'funcs/funcs.php';
 
	$errors = array();
	$mitexto="";
	if(!empty($_POST))
	{
        //real_escape_string limia la cadena q vamos a recibir con el metodo POST
		$nombre = $mysqli->real_escape_string($_POST['nombre']);
		$apellido = $mysqli->real_escape_string($_POST['apellido']);
        $usuario = $mysqli->real_escape_string($_POST['usuario']);
        $email = $mysqli->real_escape_string($_POST['email']);
		$password = $mysqli->real_escape_string($_POST['password']);
		$con_password = $mysqli->real_escape_string($_POST['con_password']);		
		$captcha = $mysqli->real_escape_string($_POST['g-recaptcha-response']);
		$activo = 0;
		$tipo_usuario = 2;
		$secret = '6Lc0eHsUAAAAALwvQ9qp3URyFV22VrKzbaYpu0xb';//Modificar
		
		if(!$captcha){
			$errors[] = "Por favor verifica el captcha";
		}
		
		if(isNull($nombre, $usuario, $email, $password, $con_password))
		{
			$errors[] = "Debe llenar todos los campos";
		}
		
		if(!isEmail($email))
		{
			$errors[] = "Dirección de correo inválida";
		}
		
		if(!validaPassword($password, $con_password))
		{
			$errors[] = "Las contraseñas no coinciden";
		}		
		
		if(usuarioExiste($usuario))
		{
			$errors[] = "El nombre de usuario $usuario ya existe";
		}
		
		if(emailExiste($email))
		{
			$errors[] = "El correo electronico $email ya existe";
		}
        
        //cuenta errores
		if(count($errors) == 0)
		{
			//valida el capchat en google
			$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha");
			
			$arr = json_decode($response, TRUE);
            
            //verifica si es correcto
			if($arr['success'])
			{
				
				$pass_hash = hashPassword($password);
				$token = generateToken();
				
				$registro = registraUsuario($nombre, $apellido, $usuario, $email, $pass_hash, $activo, $token);			
				if($registro > 0)
				{				
					$url = 'http://'.$_SERVER["SERVER_NAME"].'/proyecto2/activar.php?uid='.$registro.'&val='.$token;
					
					$asunto = 'Activar Cuenta - Sistema de Usuarios';
					$cuerpo = "Estimado $nombre: <br /><br />Para continuar con el proceso de registro, es indispensable de click en la siguiente link <a href='$url'>Activar Cuenta</a>";
					
					if(enviarEmail($email, $nombre, $asunto, $cuerpo)){

						
						$mitexto= '<div class="card"><div class="bg-success"><p class="text-white text-justify">Para terminar el proceso de registro siga las instrucciones que le hemos enviado la direccion de correo electronico: '.$email.'</p></div></div>';
						} else {
						$erros[] = "Error al enviar Email";
					}
					
					} else {
					$errors[] = "Error al Registrar";
				}
				
				} else {
				$errors[] = 'Error al comprobar Captcha';
			}
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
    <?php include("head.php") ?>
    <title>Registro</title>
	<link rel="stylesheet" href="css/bootstrap-theme.min.css" >
	<script src="js/bootstrap.min.js" ></script>
	<script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body class="bcolor">
    <?php include("nav.php")?>
    <div class="fondo">
    <div class="container">
    <div id="signupbox" style="margin-top:0px" class="d-flex justify-content-center h-100">
				<div class="card">
					<div class="card-header ">
						<div class="card-header ">                    
                            <h3>Registrate: <a style="float:right; font-size: 50%; position: relative; top:-10px" id="signinlink" href="login.php">Iniciar Sesi&oacute;n</a></h3>
                        </div>
						
					</div>  
					<?php echo $mitexto; ?>
					<div class="card-body" >
						<form id="signupform" class="form-horizontal" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">
							
							<div class="input-group form-group">								
								<div class="input-group-prepend col-md-12" >
                                    <span class="input-group-text"><i class="fas fa-user fa-2x fa-lg" for="nombre"></i></span>
									<input type="text" class="form-control" name="nombre" placeholder="Ingrese Nombre" value="<?php if(isset($nombre)) echo $nombre; ?>" required >
								</div>
							</div>

							<div class="input-group form-group">								
								<div class="input-group-prepend col-md-12" >
                                    <span class="input-group-text"><i class="fas fa-user fa-2x fa-lg" for="apellido"></i></span>
									<input type="text" class="form-control" name="apellido" placeholder="Ingrese Apellido" value="<?php if(isset($apellido)) echo $apellido; ?>" required >
								</div>
							</div>
							
							<div class="input-group form-group">								
								<div class="input-group-prepend col-md-12">
                                <span class="input-group-text"><i class="fas fa-user fa-2x fa-lg" for="usuario"></i></span>
									<input type="text" class="form-control" name="usuario" placeholder="Usuario" value="<?php if(isset($usuario)) echo $usuario; ?>" required>
								</div>
							</div>

                            <div class="input-group form-group">
                                <div class="input-group-prepend col-md-12">
                                <span class="input-group-text"><i class="fas fa-at fa-2x fa-lg" for="email"></i></span>
									<input type="email" class="form-control" name="email" placeholder="Email" value="<?php if(isset($email)) echo $email; ?>" required>
								</div>
							</div>
							
							<div class="input-group form-group">
                                <div class="input-group-prepend col-md-12">
                                    <span class="input-group-text"><i class="fas fa-key fa-2x fa-lg" for="password"></i></span>
									<input type="password" class="form-control" name="password" placeholder="Password" required>
								</div>
							</div>
							
							<div class="input-group form-group">
                                <div class="input-group-prepend col-md-12">
                                    <span class="input-group-text"><i class="fas fa-key fa-2x fa-lg" for="con_password"></i></span>
									<input type="password" class="form-control" name="con_password" placeholder="Confirmar Password" required>
								</div>
							</div>
							
							
							
							<div class="input-group form-group">
								<label for="captcha" class="col-md-12 control-label"></label>
								<div class="g-recaptcha col-md-12" data-sitekey="6Lc0eHsUAAAAADMk9p8oYnXDWAKimCLGa-IKb5Wj"></div> <!-- Modificar -->
							</div>
							
							<div class="input-group form-group">                             
								<div class="col-md-offset-9 col-md-3">
									<button id="btn-signup" type="submit" class="btn btn-info"><i class="icon-hand-right"></i>Registrar</button> 
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