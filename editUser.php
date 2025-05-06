<?php
$conn = new mysqli("localhost", "root", "", "pharmacy_portal_db", 3306);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_POST['userId'];
    $contactInfo = $_POST['contactInfo'];
    $userType = $_POST['userType'];

    $stmt = $conn->prepare("UPDATE Users SET contactInfo = ?, userType = ? WHERE userId = ?");
    $stmt->bind_param("ssi", $contactInfo, $userType, $userId);
    $stmt->execute();
    $stmt->close();
    header("Location: viewUsers.php");
    exit();
} else if (isset($_GET['id'])) {
    $userId = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM Users WHERE userId = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head><title>Edit User</title></head>
<body>
    <h2>Edit User</h2>
    <form method="POST" action="editUser.php">
        <input type="hidden" name="userId" value="<?= htmlspecialchars($user['userId']) ?>">
        <label>Contact Info: <input type="text" name="contactInfo" value="<?= htmlspecialchars($user['contactInfo']) ?>" required></label><br>
        <label>User Type: 
            <select name="userType">
                <option value="pharmacist" <?= $user['userType'] == 'pharmacist' ? 'selected' : '' ?>>Pharmacist</option>
                <option value="patient" <?= $user['userType'] == 'patient' ? 'selected' : '' ?>>Patient</option>
            </select>
        </label><br>
        <input type="submit" value="Update User">
    </form>
    <p><a href="viewUsers.php">Cancel</a></p>
</body>
</html>
