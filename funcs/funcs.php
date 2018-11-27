<?php
    include('./config/config.php');
//Valida si es nulo los campos
    function isnull($nombre, $user, $pass, $pass_con, $email){
        if(strlen(trim($nombre))<1 || strlen(trim($user))<1 || strlen(trim($pass))<1 || strlen(trim($pass_con))<1 || strlen(trim($email))<1)
        {
            return true;            
            }else {
                return false;
            }
    }
    //valida el correo electronico que sea del tipo valido
    function isEmail($email)
    {
        if (filter_var($email,FILTER_VALIDATE_EMAIL)){
        return true;
        } else {
            return false;
        }
    }
//Valida que las dos pass sean iguales
    function validaPassword($var1, $var2)
    {
        if (strcmp($var1, $var2) !== 0){
            return false;
        }else {
            return true;
        }
    }
//Limita los elementos XD
    function minMax($min, $max, $valor){
        if(strlen(trim($valor))< $min)
        {
            return true;
        }
        else if(strlen(trim($valor))>$max)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

//verifica si el usuario existe
    function usuarioExiste($usuario)
    {
        global $mysqli;

        $stmt = $mysqli->prepare("SELECT uid FROM usuarios WHERE usuario = ? LIMIT 1");
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $stmt->store_result();
        $num = $stmt-> num_rows;
        $stmt->close();

        if ($num> 0){
            return true;
        } else {
            return false;
        }
    }

//verifica si el email existe
function emailExiste($email)
{
    global $mysqli;

    $stmt = $mysqli->prepare("SELECT uid FROM usuarios WHERE correo = ? LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $num = $stmt-> num_rows;
    $stmt->close();

    if ($num> 0){
        return true;
    } else {
        return false;
    }
}
//CONSIGUE EL HASH DEL PASSWORD
    function hashPassword($password)
    {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        return $hash;
    }

//GENERA TOKEN
    function generateToken()
    {
        //mt_rand genera un valor dependiendo la fecha y la hora del istema, uniqid le saca un identificador luego le pasa md5
        $gen =md5(uniqid(mt_rand(), false));
        return $gen;
    }


//recibe los datos y lo pasa a la base de dato
    function registraUsuario($nombre,$apellido, $usuario, $email,$pass_hash, $activo, $token){
        
        $db   = getDB();
        $stmt = $db->prepare("insert into usuarios (nombre,apellido,usuario,correo,password, activacion, token) values (:nombre,:apellido,:usuario,:email,:password, :activo,:token);");
        $stmt->bindParam("nombre",$nombre, PDO::PARAM_STR);
        $stmt->bindParam("apellido",$apellido, PDO::PARAM_STR);
        $stmt->bindParam("usuario",$usuario, PDO::PARAM_STR);
        $stmt->bindParam("email",$email, PDO::PARAM_STR);
        $stmt->bindParam("password",$pass_hash, PDO::PARAM_STR);
        $stmt->bindParam("activo",$activo, PDO::PARAM_STR);
        $stmt->bindParam("token",$token, PDO::PARAM_STR);
        $stmt->execute();
        $temp = $db->lastInsertId();
        $stmt2= $db->prepare("INSERT INTO persona (uid, nombre,apellido) values (:uid,:nombre,:apellido)");
        $stmt2->bindParam("uid",$temp, PDO::PARAM_STR);
        $stmt2->bindParam("nombre",$nombre, PDO::PARAM_STR);
        $stmt2->bindParam("apellido",$apellido, PDO::PARAM_STR);
        $stmt2->execute(); 
        $stmt3= $db->prepare("INSERT INTO `usuario-rol` (uid) values (:uid)");
        $stmt3->bindParam("uid",$temp, PDO::PARAM_STR);
        if ($stmt3->execute()){
            return $temp;
        } else {
            return 0;
        }


    }
//recibe los errores y lo agrega mediante un div con un estilo de bootstrap
    function resultBlock($errors){
        if(count($errors) > 0)
        {
            echo "<div id='error' class='alert alert-danger' role='alert'>
            <a href='#' onclick=\"showHide('error');\">[X]</a>
            <ul>";
            foreach($errors as $error)
            {
                echo "<li>".$error."</li>";
            }
            echo "</ul>";
            echo "</div>";
        }
    }

    function enviarEmail($email, $nombre, $asunto, $cuerpo){
		
		require_once 'PHPMailer/PHPMailerAutoload.php';
		
        $mail = new PHPMailer();
        $mail->SMTPOptions = array( 'ssl' => array( 'verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true ) );
		$mail->isSMTP();
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = 'tls'; //Modificar tipo de seguridad este sirve para gmail
		$mail->Host = 'smtp.gmail.com'; //Modificar
		$mail->Port = '587'; //Modificar
		
		$mail->Username = 'latuerca.2k18@gmail.com'; //Modificar
		$mail->Password = 'Latuerca2018'; //Modificar
		
		$mail->setFrom('latuerca2k18@gmail.com', 'La Tuerca'); //Modificar
		$mail->addAddress($email, $nombre);
		
		$mail->Subject = $asunto;
		$mail->Body    = $cuerpo;
		$mail->IsHTML(true);
		
		if($mail->send())
		return true;
		else
		return false;
    }

    function validaIdToken($id, $token){
        $db   = getDB();
        $stmt = $db->prepare("select activacion from usuarios where uid=:id and token =:token LIMIT 1");
        $stmt->bindParam("id",$id, PDO::PARAM_STR);
        $stmt->bindParam("token",$token, PDO::PARAM_STR);
        $stmt->execute();
        $rows = $stmt->rowCount();
        if($rows>0){
            $resul = $stmt->fetchall(PDO::FETCH_COLUMN, 0);
            $activacion=($resul[0]);

// si la activacion es igual a 1 es xq ya activo la cuenta
            if($activacion == 1){
                $msg = "La cuenta ya se activo anteriormente.";
            } else {
                if(activarUsuario($id)){
                    $msg = 'Cuenta activada.';
                } else {
                    $msg = 'Error al Activar Cuenta';
                }
            }

        } else {
            $msg = 'No existe el registro para activar';
        }
        return $msg;

    }

    function activarUsuario($id)
    {
        global $mysqli;
//lo unico que hace es un UPDATE al campo activacion y lo coloca como 1 mediante el id
        $stmt = $mysqli->prepare("UPDATE usuarios SET activacion='1' WHERE uid = ?");
        $stmt->bind_param('s', $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    function isNullLogin($usuario,$password){
        if(strlen(trim($usuario)) < 1 || strlen(trim($password)) < 1 )
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function login ($usuario, $password)
    {
        global $mysqli;

        $stmt = $mysqli->prepare("SELECT uid, password FROM usuarios WHERE usuario = ? || correo = ? LIMIT 1");
        $stmt->bind_param("ss", $usuario, $usuario);
        $stmt->execute();
        $stmt->store_result();
        $rows = $stmt->num_rows;

        if($rows> 0){
            if(isActivo($usuario)){
                $stmt->bind_result($id, $passwd);
                $stmt->fetch();

                $validaPassw = password_verify($password, $passwd);

                if($validaPassw){
                    lastSession($id);
                    $_SESSION['uid'] = $id;

                    header("location: taller/index.php");
                    } else {
                    $errors = "La Contrase&ntilde;a es incorrecta";
                }
                } else {
                    $errors = 'El Usuario no esta activo';
            }
            } else {
                $errors = "El nombre de usuario o el email no existe";
        }
        return $errors;
    } 

    function isActivo($usuario)
    {
        global $mysqli;

        $stmt =$mysqli->prepare("SELECT activacion FROM usuarios WHERE usuario = ? || correo = ? LIMIT 1");
        $stmt->bind_param('ss', $usuario, $usuario);
        $stmt->execute();
        $stmt->bind_result($activacion);
        $stmt->fetch();

        if($activacion == 1)
        {
            return true;
        }
        else
        {
            return false;
        }

    }

    function lastSession($id)
    {
        global $mysqli;

        $stmt= $mysqli->prepare("UPDATE usuarios SET last_session= NOW(), token_password='', password_request=1 WHERE uid = ?");
        $stmt->bind_param('s', $id);
        $stmt->execute();
        $stmt->close();
    }

    function generaTokenPass($user_id)
    {
        global $mysqli;

        $token = generateToken();

        $stmt = $mysqli->prepare("UPDATE usuarios SET token_password=?, password_request=1 WHERE uid = ?");
        $stmt->bind_param('ss',$token,$user_id);
        $stmt->execute();
        
        return $token;
    }

    function getValor($campo, $campoWhere, $valor)
    {
        global $mysqli;

        $stmt= $mysqli->prepare("SELECT $campo FROM usuarios WHERE $campoWhere = ? LIMIT 1");
        $stmt->bind_param('s', $valor);
        $stmt->execute();
        $stmt->store_result();
        $num=$stmt->num_rows;

        if ($num > 0)
        {
            $stmt->bind_result($_campo);
            $stmt->fetch();
            return $_campo;
        }
        else
        {

        }
    }

    function verificaTokenPass($user_id, $token){
        global $mysqli;

        $stmt = $mysqli->prepare("SELECT activacion FROM usuarios WHERE uid = ? AND token_password = ? AND password_request = 1 LIMIT 1");
        $stmt->bind_param('is', $user_id, $token);
        $stmt->execute();
        $stmt->store_result();
        $num= $stmt->num_rows;

        if ($num > 0)
        {
            $stmt->bind_result($activacion);
            $stmt->fetch();
            if ($activacion == 1)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;

        }
    }

    function cambiaPassword($password, $user_id, $token){
        global $mysqli;

        $stmt = $mysqli->prepare("UPDATE usuarios SET password = ?, token_password='', password_request=0 WHERE uid = ? AND token_password = ?");
        $stmt->bind_param('sis', $password, $user_id, $token);

        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
    }
?>