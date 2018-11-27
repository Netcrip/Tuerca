<?php
if (!empty($_SESSION['uid'])) {
    $session_uid = $_SESSION['uid'];
    include ('clases/claseusuario.php');
    $userClass = new userClass();
}
if (empty($session_uid)) {
    $url = '../home.php';
    header("Location: $url");
}
?>
