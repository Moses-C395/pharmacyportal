<?php
require_once 'PharmacyDatabase.php';

$db = new PharmacyDatabase();
$conn = new mysqli("localhost", "root", "", "pharmacy_portal_db", 3306);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $prescriptionId = $_POST['prescriptionId'];
    $dosageInstructions = $_POST['dosageInstructions'];
    $quantity = $_POST['quantity'];

    $stmt = $conn->prepare("UPDATE Prescriptions SET dosageInstructions = ?, quantity = ? WHERE prescriptionId = ?");
    $stmt->bind_param("sii", $dosageInstructions, $quantity, $prescriptionId);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    header("Location: viewPrescriptions.php");
    exit();
} else if (isset($_GET['id'])) {
    $prescriptionId = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM Prescriptions WHERE prescriptionId = ?");
    $stmt->bind_param("i", $prescriptionId);
    $stmt->execute();
    $result = $stmt->get_result();
    $prescription = $result->fetch_assoc();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head><title>Edit Prescription</title></head>
<body>
    <h2>Edit Prescription</h2>
    <form method="POST" action="editPrescription.php">
        <input type="hidden" name="prescriptionId" value="<?= htmlspecialchars($prescription['prescriptionId']) ?>">
        <label>Dosage Instructions: <input type="text" name="dosageInstructions" value="<?= htmlspecialchars($prescription['dosageInstructions']) ?>" required></label><br>
        <label>Quantity: <input type="number" name="quantity" value="<?= htmlspecialchars($prescription['quantity']) ?>" required></label><br>
        <input type="submit" value="Update Prescription">
    </form>
    <p><a href="viewPrescriptions.php">Cancel</a></p>
</body>
</html>
