<?php
header('Content-Type: application/json');
include("../../../Database/db.php");

function validate_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
session_start();
$id = validate_input($_POST['id']);
$userid = validate_input($_SESSION['userid']);
$service = validate_input($_POST['service']);
$description = validate_input($_POST['description']);
$link = validate_input($_POST['link']);

$sql = "UPDATE users_service SET service=?, description=?, service_link=? WHERE userid = ? AND id = ?;";
$stmt = mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt, $sql) ){
    echo json_encode([
        'code' => '400'
    ]);
}

mysqli_stmt_bind_param($stmt, "sssii", $service, $description, $link, $userid, $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_close($stmt);

if($result){
    echo json_encode([
        'code' => '201'
    ]);
}else{
    echo json_encode([
        'code' => '400'
    ]);
}
    

?>