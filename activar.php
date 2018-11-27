<?php
	require 'funcs/conexion.php';
	include 'funcs/funcs.php';
	
	
	if(isset($_GET["uid"]) AND isset($_GET['val']))
	{	
		$idUsuario = $_GET['uid'];
		$token = $_GET['val'];
		
		$mensaje = validaIdToken($idUsuario, $token);
	}
?>
<html>
	<head>
		<?php include("head.php") ?>
		<title>Activacion</title>
		<link rel="stylesheet" href="css/bootstrap-theme.min.css" >
		<script src="js/bootstrap.min.js" ></script>
		
	</head>
	
	<body class="bcolor">
		<?php include("nav.php")?>
    	<div class="fondo">


			<div class="container">
			<div id="signupbox" style="margin-top:0px" class="d-flex justify-content-center h-100">
				<div class="card">
					<div class="card-body">
					<?php echo '<h5 class="text-white">'.$mensaje.'</h5>'; ?>
				
					<br />
					<p><a class="btn btn-primary btn-md" style="float:right" href="login.php" role="button">Iniciar Sesi&oacute;n</a></p>
					</div>
				</div>
			</div>
			</div>
		</div>
	</body>
</html>