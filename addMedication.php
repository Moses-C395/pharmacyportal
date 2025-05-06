<?php
require_once 'PharmacyDatabase.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $medicationName = $_POST['medicationName'];
    $dosage = $_POST['dosage'];
    $manufacturer = $_POST['manufacturer'];

    $db = new PharmacyDatabase();
    $db->addMedication($medicationName, $dosage, $manufacturer);

    echo "Medication added successfully! <a href='index.php'>Go back</a>";
} else {
    echo "Invalid request.";
}
?>
