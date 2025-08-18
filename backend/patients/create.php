<?php
header("Content-Type: application/json");
include("../config/db.php");

$data = json_decode(file_get_contents("php://input"), true);

if(isset($data['name']) && isset($data['email'])){
    try {
        $sql = "INSERT INTO patients (name, age, email, phone) VALUES(:name, :age, :email, :phone)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ":name" => $data['name'],
            ":age" => $data['age'],
            ":email" => $data['email'],
            ":phone" => $data['phone']
        ]);
        echo json_encode(["message" => "Patient added successfully"]);
    } catch(PDOException $e){
        echo json_encode(["error" => $e->getMessage()]);
    }
} else {
    echo json_encode(["error" => "Invalid input"]);
}
?>