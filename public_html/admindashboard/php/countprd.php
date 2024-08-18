<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once '../php/dbase_utiles.php';

$conn = connect_db_apprw();

$query = "SELECT COUNT(*) as total FROM producto";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

echo json_encode($data);

close_db($conn);



function base(){

    $data = connect_db_apprw();
return $data;

}


?>
