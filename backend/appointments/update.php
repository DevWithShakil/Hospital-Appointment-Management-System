<?php
header("Content-Type: application/json");
include("../config/db.php");

$data = json_decode(file_get_contents("php://input"), true);

if(isset($data['id'])){
    try {
        $sql = "UPDATE appointments 
                SET patient_id=:patient_id, doctor_name=:doctor_name, date=:date, status=:status
                WHERE id=:id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ":patient_id" => $data['patient_id'],
            ":doctor_name" => $data['doctor_name'],
            ":date" => $data['date'],
            ":status" => $data['status'],
            ":id" => $data['id']
        ]);

        $rowCount = $stmt->rowCount(); // check affected rows
        if($rowCount > 0){
            echo json_encode(["message"=>"Appointment updated successfully"]);
        } else {
            echo json_encode(["message"=>"No appointment found with this id"]);
        }

    } catch(PDOException $e){
        echo json_encode(["error"=>$e->getMessage()]);
    }
} else {
    echo json_encode(["error"=>"Invalid input"]);
}
?>