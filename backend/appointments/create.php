<?php
header("Content-Type: application/json");
include("../config/db.php");

$data = json_decode(file_get_contents("php://input"), true);

if(isset($data['patient_id'], $data['doctor_name'], $data['date'], $data['status'])){
    try {
        $sql = "INSERT INTO appointments (patient_id, doctor_name, date, status)
                VALUES(:patient_id, :doctor_name, :date, :status)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ":patient_id" => $data['patient_id'],
            ":doctor_name" => $data['doctor_name'],
            ":date" => $data['date'],
            ":status" => $data['status']
        ]);

        // Get last inserted id
        $lastId = $conn->lastInsertId();

        echo json_encode([
            "message"=>"Appointment added successfully",
            "id"=>$lastId
        ]);
    } catch(PDOException $e){
        echo json_encode(["error"=>$e->getMessage()]);
    }
} else {
    echo json_encode(["error"=>"Invalid input"]);
}
?>