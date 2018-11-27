<?php
	require 'funcs/conexion.php';
	include 'funcs/funcs.php';
	//session_start();
	
	if(empty($_GET['user_id'])){
		header('Location: index.php');
	}
	
	if(empty($_GET['token'])){
		header('Location: index.php');
	}
	
	$user_id = $mysqli->real_escape_string($_GET['user_id']);
	$token = $mysqli->real_escape_string($_GET['token']);
	
	if(!verificaTokenPass($user_id, $token))
	{
		echo 'No se pudo verificar los Datos';
		exit;
	} 
?>
<html>
	<head>
		<?php include("head.php") ?>
		<title>Cambiar Password</title>
		
		<link rel="stylesheet" href="css/bootstrap.min.css" >
		<link rel="stylesheet" href="css/bootstrap-theme.min.css" >
		<script src="js/bootstrap.min.js" ></script>
		
	</head>
	
	<body>
	<?php include("nav.php")?>
	<div class="fondo">
		
		<div class="container">    
			<div id="signupbox"  class="d-flex justify-content-center h-100">                    
				<div class="card" >
					<div class="card-header">
						<div class="card-title">
							<h3>Cambiar Password</h3>
						</div>
						<div style="float:right; font-size: 100%; position: relative; top:-35px"><a href="index.php">Iniciar Sesi&oacute;n</a></div>
					</div>     
					
					<div style="padding-top:30px" class="card-body" >
						
						<form id="signupform" class="form-horizontal" role="form" action="guarda_pass.php" method="POST" autocomplete="off">
							
							<div id="signupalert" style="display:none" class="alert alert-danger">
                                <p>Error:</p>
								<span></span>
							</div>
							<input type="hidden" id="user_id" name="user_id" value ="<?php echo $user_id; ?>" />
							
							<input type="hidden" id="token" name="token" value ="<?php echo $token; ?>" />
							
							<div class="input-group form-group">
								<div class="input-group-prepend col-md-12">
									<span class="input-group-text"><i class="fas fa-key fa-2x fa-lg" for="usuario"></i></span>
									<input type="password" class="form-control" name="password" placeholder="Ingresar Password" required>
									
								</div>
							</div>
							
							<div class="input-group form-group">
								<div class="input-group-prepend col-md-12">
									<span class="input-group-text"><i class="fas fa-key fa-2x fa-lg" for="usuario"></i></span>
									<input type="password" class="form-control" name="con_password" placeholder="Confirmar Password" required>
								</div>
							</div>
							
							<div style="margin-top:10px" class="input-group form-group">
								<div class="col-md-offset-9 col-md-3">
									<button id="btn-login" type="submit" class="btn btn-success">Modificar</a>
								</div>
							</div>   
						</form>
					</div>                     
				</div>  
			</div>
		</div>
	</div>
	</body>
	<?php include("footer.php")?>
</html>