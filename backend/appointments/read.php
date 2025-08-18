<?php
header("Content-Type: application/json");
include("../config/db.php");

try {
    $stmt = $conn->query("SELECT * FROM appointments ORDER BY id ASC");
    $appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($appointments);
} catch(PDOException $e){
    echo json_encode(["error" => $e->getMessage()]);
}
?>