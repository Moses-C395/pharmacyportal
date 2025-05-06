<?php
$conn = new mysqli("localhost", "root", "", "pharmacy_portal_db", 3306);
if (isset($_GET['id'])) {
    $medicationId = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM Medications WHERE medicationId = ?");
    $stmt->bind_param("i", $medicationId);
    $stmt->execute();
    $stmt->close();
}
header("Location: viewMedications.php");
exit();
?>
