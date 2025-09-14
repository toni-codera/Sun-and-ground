<?php
require_once 'config_session.inc.php';
require_once 'dbh.inc.php';
header('Content-Type: application/json');

if(!isset($_SESSION["user_id"])){
    echo json_encode((['error' => 'User not logged in!']));
    die();
}

$user_id = $_SESSION["user_id"];
$query = "SELECT firstname, lastname, email, city, home_address, phone 
FROM users WHERE id = :id";
$stmt = $pdo->prepare($query);
$stmt->bindParam(":id", $user_id);
$stmt->execute();
$userData = $stmt->fetch(PDO::FETCH_ASSOC);

if($userData){
    echo json_encode($userData);
}else {
    echo json_encode(['error' => 'User data not found!']);
}
?>