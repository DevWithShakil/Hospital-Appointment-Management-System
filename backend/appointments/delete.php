<?php
header("Content-Type: application/json");
include("../config/db.php");

// Read JSON input
$data = json_decode(file_get_contents("php://input"), true);

if(isset($data['id'])){
    try {
        $sql = "DELETE FROM appointments WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([":id" => $data['id']]);

        $rowCount = $stmt->rowCount(); // check affected rows
        if($rowCount > 0){
            echo json_encode(["message" => "Appointment deleted successfully"]);
        } else {
            echo json_encode(["message" => "No appointment found with this id"]);
        }
    } catch(PDOException $e){
        echo json_encode(["error" => $e->getMessage()]);
    }
} else {
    echo json_encode(["error" => "Invalid input"]);
}
?>