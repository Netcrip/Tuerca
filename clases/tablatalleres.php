<?php
include('../config/config.php');
$db   = getDB();
$stmt = $db->prepare("select tid, nombre, telefono, calle, nro from talleres where estado!=0");
$stmt->execute();
$data = array();
while( $rows = $stmt->fetchall(PDO::FETCH_ASSOC)) {
array_push($data, $rows);
}
$results = array(
"sEcho" => 1,
"iTotalRecords" => count($data),
"iTotalDisplayRecords" => count($data),
"aaData"=>$data);
echo json_encode($results);
?>