<?php
require_once 'PharmacyDatabase.php';

$db = new PharmacyDatabase();
$prescriptions = $db->getAllPrescriptions();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Prescriptions</title>
    <style>
        table, th, td { border: 1px solid black; border-collapse: collapse; padding: 8px; }
        th { background-color: #f2f2f2; }
        a.button { padding: 4px 8px; border: 1px solid #ccc; background: #eee; text-decoration: none; }
        a.button:hover { background: #ddd; }
    </style>
</head>
<body>
    <h1>All Prescriptions</h1>
    <table>
        <tr>
            <th>Prescription ID</th>
            <th>User ID</th>
            <th>Medication ID</th>
            <th>Prescribed Date</th>
            <th>Dosage Instructions</th>
            <th>Quantity</th>
            <th>Refill Count</th>
            <th>Medication Name</th>
            <th>Dosage</th>
            <th>Manufacturer</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($prescriptions as $row): ?>
        <tr>
            <td><?= htmlspecialchars($row['prescriptionId']) ?></td>
            <td><?= htmlspecialchars($row['userId']) ?></td>
            <td><?= htmlspecialchars($row['medicationId']) ?></td>
            <td><?= htmlspecialchars($row['prescribedDate']) ?></td>
            <td><?= htmlspecialchars($row['dosageInstructions']) ?></td>
            <td><?= htmlspecialchars($row['quantity']) ?></td>
            <td><?= htmlspecialchars($row['refillCount']) ?></td>
            <td><?= htmlspecialchars($row['medicationName']) ?></td>
            <td><?= htmlspecialchars($row['dosage']) ?></td>
            <td><?= htmlspecialchars($row['manufacturer']) ?></td>
            <td>
                <a class="button" href="editPrescription.php?id=<?= $row['prescriptionId'] ?>">Edit</a>
                <a class="button" href="deletePrescription.php?id=<?= $row['prescriptionId'] ?>" onclick="return confirm('Are you sure you want to delete this prescription?');">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <p><a href="index.php">Back to Home</a></p>
</body>
</html>
