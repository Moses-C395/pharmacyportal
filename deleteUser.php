<?php
$conn = new mysqli("localhost", "root", "", "pharmacy_portal_db", 3306);
if (isset($_GET['id'])) {
    $userId = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM Users WHERE userId = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->close();
}
header("Location: viewUsers.php");
exit();
?>
