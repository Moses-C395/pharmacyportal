<?php
class PharmacyDatabase {

    private $host = "localhost";
    private $port = "3306";
    private $database = "pharmacy_portal_db";
    private $user = "root";
    private $password = "";
    private $connection;

    public function __construct() {
        $this->connection = new mysqli(
            $this->host,
            $this->user,
            $this->password,
            $this->database,
            $this->port
        );

        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function addUser($userName, $contactInfo, $userType) {
        $stmt = $this->connection->prepare(
            "INSERT INTO Users (userName, contactInfo, userType) VALUES (?, ?, ?)"
        );
        $stmt->bind_param("sss", $userName, $contactInfo, $userType);
        $stmt->execute();
        $stmt->close();
    }

    public function addMedication($medicationName, $dosage, $manufacturer) {
        $stmt = $this->connection->prepare(
            "INSERT INTO Medications (medicationName, dosage, manufacturer) VALUES (?, ?, ?)"
        );
        $stmt->bind_param("sss", $medicationName, $dosage, $manufacturer);
        $stmt->execute();
        $stmt->close();
    }

    public function addPrescription($patientUserName, $medicationId, $dosageInstructions, $quantity) {
        $stmt = $this->connection->prepare("SELECT userId FROM Users WHERE userName = ?");
        $stmt->bind_param("s", $patientUserName);
        $stmt->execute();
        $stmt->bind_result($patientId);
        $stmt->fetch();
        $stmt->close();

        if ($patientId) {
            $stmt = $this->connection->prepare(
                "INSERT INTO Prescriptions (userId, medicationId, dosageInstructions, quantity) VALUES (?, ?, ?, ?)"
            );
            $stmt->bind_param("iisi", $patientId, $medicationId, $dosageInstructions, $quantity);
            $stmt->execute();
            $stmt->close();
        }
    }

    public function getAllPrescriptions() {
        $result = $this->connection->query(
            "SELECT * FROM prescriptions JOIN medications ON prescriptions.medicationId = medications.medicationId"
        );
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getUserDetails($userId) {
        $stmt = $this->connection->prepare("SELECT * FROM Users WHERE userId = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $userDetails = $result->fetch_assoc();
        $stmt->close();
        return $userDetails;
    }
}
?>
