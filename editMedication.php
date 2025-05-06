<?php
$conn = new mysqli("localhost", "root", "", "pharmacy_portal_db", 3306);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $medicationId = $_POST['medicationId'];
    $medicationName = $_POST['medicationName'];
    $dosage = $_POST['dosage'];
    $manufacturer = $_POST['manufacturer'];

    $stmt = $conn->prepare("UPDATE Medications SET medicationName = ?, dosage = ?, manufacturer = ? WHERE medicationId = ?");
    $stmt->bind_param("sssi", $medicationName, $dosage, $manufacturer, $medicationId);
    $stmt->execute();
    $stmt->close();
    header("Location: viewMedications.php");
    exit();
} else if (isset($_GET['id'])) {
    $medicationId = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM Medications WHERE medicationId = ?");
    $stmt->bind_param("i", $medicationId);
    $stmt->execute();
    $result = $stmt->get_result();
    $med = $result->fetch_assoc();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head><title>Edit Medication</title></head>
<body>
    <h2>Edit Medication</h2>
    <form method="POST" action="editMedication.php">
        <input type="hidden" name="medicationId" value="<?= htmlspecialchars($med['medicationId']) ?>">
        <label>Name: <input type="text" name="medicationName" value="<?= htmlspecialchars($med['medicationName']) ?>" required></label><br>
        <label>Dosage: <input type="text" name="dosage" value="<?= htmlspecialchars($med['dosage']) ?>" required></label><br>
        <label>Manufacturer: <input type="text" name="manufacturer" value="<?= htmlspecialchars($med['manufacturer']) ?>"></label><br>
        <input type="submit" value="Update Medication">
    </form>
    <p><a href="viewMedications.php">Cancel</a></p>
</body>
</html>
