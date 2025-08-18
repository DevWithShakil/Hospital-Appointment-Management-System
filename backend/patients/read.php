<?php
header("Content-Type: application/json");
include("../config/db.php");

try {
    $stmt = $conn->query("SELECT * FROM patients ORDER BY id ASC");
    $patients = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($patients);
} catch(PDOException $e){
    echo json_encode(["error" => $e->getMessage()]);
}
?>