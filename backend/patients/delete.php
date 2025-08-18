<?php 

header("Content-Type: application/json");
include("../config/db.php");

$data = json_decode(file_get_contents("php://input"), true);

if(isset($data['id'])){
    try{
        $sql = "DELETE FROM patients WHERE id=:id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([":id" => $data['id']]);

        echo json_encode(["message" => "Patient deleted successfully"]);
    } catch(PDOException $e){
        echo json_encode(["error" => $e->getMessage()]);
    }
} else {
    echo json_encode(["error" => "Invalid input"]);
}
?>