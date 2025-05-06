<?php
require_once 'PharmacyDatabase.php';

if (isset($_GET['id'])) {
    $prescriptionId = $_GET['id'];

    $db = new PharmacyDatabase();
    $conn = new mysqli("localhost", "root", "", "pharmacy_portal_db", 3306);
    $stmt = $conn->prepare("DELETE FROM Prescriptions WHERE prescriptionId = ?");
    $stmt->bind_param("i", $prescriptionId);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    header("Location: viewPrescriptions.php");
    exit();
} else {
    echo "Invalid request.";
}
?>
