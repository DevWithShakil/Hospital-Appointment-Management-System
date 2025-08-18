<?php
header("Content-Type: application/json");
include("../config/db.php");

$data = json_decode(file_get_contents("php://input"), true);

if(isset($data['id']) && (isset($data['name']) || isset($data['age']) || isset($data['email']) || isset($data['phone']))) {
    try {
        $sql = "UPDATE patients SET name=:name, age=:age, email=:email, phone=:phone WHERE id=:id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ":name" => $data['name'],
            ":age" => $data['age'],
            ":email" => $data['email'],
            ":phone" => $data['phone'],
            ":id" => $data['id']
        ]);
        echo json_encode(["message"=>"Patient updated successfully"]);
    } catch(PDOException $e) {
        echo json_encode(["error"=>$e->getMessage()]);
    }
} else {
    echo json_encode(["error"=>"Invalid input"]);
}
?>