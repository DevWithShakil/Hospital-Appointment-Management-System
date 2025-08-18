<?php 
$host = "localhost";
$port = "5432";
$dbname = "hospital_appointment_management_system";
$user = "postgres";
$password = "12345";

try{
    $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connection Successful!";
} catch(PDOException $e) {
    echo "Connection Failed: " . $e->getMessage();
}
?>