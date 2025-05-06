<?php
require_once 'PharmacyDatabase.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patientUserName = $_POST['patientUserName'];
    $medicationId = $_POST['medicationId'];
    $dosageInstructions = $_POST['dosageInstructions'];
    $quantity = $_POST['quantity'];

    $db = new PharmacyDatabase();
    $db->addPrescription($patientUserName, $medicationId, $dosageInstructions, $quantity);

    echo "Prescription added successfully! <a href='index.php'>Go back</a>";
} else {
    echo "Invalid request.";
}
?>
