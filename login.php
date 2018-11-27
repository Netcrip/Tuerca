<!DOCTYPE html>
<html>
<head>
    <?php include("head.php") ?>
    <title>Login</title>
</head>
<body class="bcolor">
    <?php
    ///MODIFICACIONESSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSS//////////
        //Iniciar una nueva sesión o reanudar la existente
        require 'funcs/conexion.php';
        include 'funcs/funcs.php';
    ///MODIFICACIONESSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSS//////////
    ///MODIFICACIONESSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSS//////////
    if(isset($_SESSION["uid"])){ //En caso de existir la sesión redireccionamos
		header("Location: taller/index.php");
	}
//id_usuario
    $errors = array();
	
	if(!empty($_POST))
	{
		$usuario = $mysqli->real_escape_string($_POST['usuario']);
		$password = $mysqli->real_escape_string($_POST['password']);
		
		if(isNullLogin($usuario, $password))
		{
			$errors[] = "Debe llenar todos los campos";
		}
		
		$errors[] = login($usuario, $password);	
	}
    ?>
    <?php include("nav.php")?>
    <div class="fondo">
    <div class="container">
        <div class="d-flex justify-content-center h-100">
            <div class="card">
                <div class="card-header">
                    <h3>Iniciar Sesión</h3>
                </div>
                <div class="card-body">
                    <form method="post" action="" name="login">
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-at" for="usuario"></i></span>
                            </div>
                            <input type="text" class="form-control"  name="usuario" placeholder="Ingrese Email o usuario" >
            
                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">                         
                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" class="form-control" name="password" placeholder="Ingrese contraseña">
                        </div>                        
                        <div class="form-group">
                            <input type="submit" value="Login" class="btn float-right login_btn" name="loginSubmit">
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-center links">
                        ¿No tienes Cuenta?<a href="./registro.php">Crear</a>
                    </div>
                    <div class="d-flex justify-content-center">
                        <a href="recupera.php">¿Olvidaste la contraseña?</a>
                    </div>
                </div>
                <?php echo resultBlock($errors); ?>
            </div>
        </div>
    </div>
</div>    
<?php include("footer.php")?>
</body>
</html>