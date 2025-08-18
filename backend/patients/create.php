<?php 
header("Content-Type: application/json");
include("../config/db.php");

// Get post data

$data = json_decode(file_get_contents("php://input"));

if(isset($data->name) && isset($data->email)){
    $sql = "INSERT INTO patients (name, age, email, phone) VALUES(:name, :age, :email, :phone)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ":name" => $data->name,
        ":age" => $data->age,
        ":email" => $data->email,
        ":phone" => $data->phone
    ]);

    echo json_encode(["message" => "Patient added successfully"]);
}else{
    echo json_encode(["message" => "Invalid input"]);
}
?>