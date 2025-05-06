<?php
require_once 'PharmacyDatabase.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userName = $_POST['userName'];
    $contactInfo = $_POST['contactInfo'];
    $userType = $_POST['userType'];

    $db = new PharmacyDatabase();
    $db->addUser($userName, $contactInfo, $userType);

    echo "User added successfully! <a href='index.php'>Go back</a>";
} else {
    echo "Invalid request.";
}
?>
