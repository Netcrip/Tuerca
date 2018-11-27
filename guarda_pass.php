<?php
	require 'funcs/conexion.php';
	include 'funcs/funcs.php';

	$msj;
	if(!isset($_POST['user_id'])){
		$msj="<p class='text-white'>Error utilice el correspondient Link </p>";
	}
	else{
		$user_id = $mysqli->real_escape_string($_POST['user_id']);
		$token = $mysqli->real_escape_string($_POST['token']);
		$password = $mysqli->real_escape_string($_POST['password']);
		$con_password = $mysqli->real_escape_string($_POST['con_password']);
		if(validaPassword($password, $con_password))
		{
			
			$pass_hash = hashPassword($password);
			
			if(cambiaPassword($pass_hash, $user_id, $token))
			{
				$msj= "<p class='text-white'>Contrase&ntilde;a Modificada </p><br> <a href='login.php' >Iniciar Sesion</a>";
			}
			else 
			{
				$msj = "Error al modificar contrase&ntilde;a";
			}
		}
		else
		{
			$msj = "Las contraseñas no coinciden";
		}
	}
	
?>

<html>
	<head>
		<?php include("head.php") ?>
		<title>Guardar Password</title>
		<link rel="stylesheet" href="css/bootstrap-theme.min.css" >
		<script src="js/bootstrap.min.js" ></script>
		<script src='https://www.google.com/recaptcha/api.js'></script>

	</head>

	<body>
		<?php include("nav.php")?>
		<div class="fondo">
			<div class="container">
			<div id="signupbox" style="margin-top:0px" class="d-flex justify-content-center h-100">
				<div class="card">
					<div class="card-header ">
						<div class="card-header">               
                            <h4 class="text-white">Informacion de Contraseña: <a style="float:right; font-size: 60%; position: relative; top:-50px" id="signinlink" href="login.php">Iniciar Sesi&oacute;n</a></h4>
						</div>
					</div>
					
					<div class="card-body">
						<h4><?php echo $msj; ?></h4>
					</div>
				</div>
			
			</div>
			</div>
		</div>

		

	</body>
</html>