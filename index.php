<?php
require_once 'PharmacyDatabase.php';
$db = new PharmacyDatabase();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pharmacy Portal</title>
</head>
<body>
    <h1>Welcome to the Pharmacy Portal</h1>

    <nav>
        <p><a href="viewUsers.php">Manage Users</a></p>
        <p><a href="viewMedications.php">Manage Medications</a></p>
        <p><a href="viewPrescriptions.php">Manage Prescriptions</a></p>
    </nav>

    <h2>Add New User</h2>
    <form action="addUser.php" method="post">
        <label>Username: <input type="text" name="userName" required></label><br>
        <label>Contact Info: <input type="text" name="contactInfo" required></label><br>
        <label>User Type: 
            <select name="userType">
                <option value="pharmacist">Pharmacist</option>
                <option value="patient">Patient</option>
            </select>
        </label><br>
        <input type="submit" value="Add User">
    </form>

    <h2>Add New Medication</h2>
    <form action="addMedication.php" method="post">
        <label>Name: <input type="text" name="medicationName" required></label><br>
        <label>Dosage: <input type="text" name="dosage" required></label><br>
        <label>Manufacturer: <input type="text" name="manufacturer"></label><br>
        <input type="submit" value="Add Medication">
    </form>

    <h2>Add New Prescription</h2>
    <form action="addPrescription.php" method="post">
        <label>Patient Username: <input type="text" name="patientUserName" required></label><br>
        <label>Medication ID: <input type="number" name="medicationId" required></label><br>
        <label>Dosage Instructions: <input type="text" name="dosageInstructions" required></label><br>
        <label>Quantity: <input type="number" name="quantity" required></label><br>
        <input type="submit" value="Add Prescription">
    </form>
</body>
</html>
