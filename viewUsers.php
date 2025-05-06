<?php
require_once 'PharmacyDatabase.php';
$db = new PharmacyDatabase();
$conn = new mysqli("localhost", "root", "", "pharmacy_portal_db", 3306);
$result = $conn->query("SELECT * FROM Users");
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Users</title>
    <style>
        table, th, td { border: 1px solid black; border-collapse: collapse; padding: 8px; }
        th { background-color: #f2f2f2; }
        a.button { padding: 4px 8px; border: 1px solid #ccc; background: #eee; text-decoration: none; }
        a.button:hover { background: #ddd; }
    </style>
</head>
<body>
    <h1>All Users</h1>
    <table>
        <tr>
            <th>User ID</th>
            <th>Username</th>
            <th>Contact Info</th>
            <th>User Type</th>
            <th>Actions</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['userId']) ?></td>
            <td><?= htmlspecialchars($row['userName']) ?></td>
            <td><?= htmlspecialchars($row['contactInfo']) ?></td>
            <td><?= htmlspecialchars($row['userType']) ?></td>
            <td>
                <a class="button" href="editUser.php?id=<?= $row['userId'] ?>">Edit</a>
                <a class="button" href="deleteUser.php?id=<?= $row['userId'] ?>" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    <p><a href="index.php">Back to Home</a></p>
</body>
</html>
