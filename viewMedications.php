<?php
require_once 'PharmacyDatabase.php';
$db = new PharmacyDatabase();
$conn = new mysqli("localhost", "root", "", "pharmacy_portal_db", 3306);
$result = $conn->query("SELECT * FROM Medications");
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Medications</title>
    <style>
        table, th, td { border: 1px solid black; border-collapse: collapse; padding: 8px; }
        th { background-color: #f2f2f2; }
        a.button { padding: 4px 8px; border: 1px solid #ccc; background: #eee; text-decoration: none; }
        a.button:hover { background: #ddd; }
    </style>
</head>
<body>
    <h1>All Medications</h1>
    <table>
        <tr>
            <th>Medication ID</th>
            <th>Name</th>
            <th>Dosage</th>
            <th>Manufacturer</th>
            <th>Actions</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['medicationId']) ?></td>
            <td><?= htmlspecialchars($row['medicationName']) ?></td>
            <td><?= htmlspecialchars($row['dosage']) ?></td>
            <td><?= htmlspecialchars($row['manufacturer']) ?></td>
            <td>
                <a class="button" href="editMedication.php?id=<?= $row['medicationId'] ?>">Edit</a>
                <a class="button" href="deleteMedication.php?id=<?= $row['medicationId'] ?>" onclick="return confirm('Are you sure you want to delete this medication?');">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    <p><a href="index.php">Back to Home</a></p>
</body>
</html>
