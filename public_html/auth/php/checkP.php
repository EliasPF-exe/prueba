<?php
include_once 'error.php';
include_once 'conn_auth_db-ro.php';

$hw_conn = conectar_db_elprogreso_rw();

// Conectar a la base de datos y obtener los datos del usuario
$pdo = new PDO('mysql:host=localhost;dbname=database', 'username', 'password');

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
$stmt->execute(['username' => $username]);
$user = $stmt->fetch();

if ($user && password_verify($password, $user['password'])) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}
?>

