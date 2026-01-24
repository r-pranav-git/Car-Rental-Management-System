<?php
// Include database connection
include 'database.php';

// Initialize response array
$response = ['success' => false];

// Check if license number is provided
if (isset($_GET['license_number'])) {
    $license_number = $_GET['license_number'];

    // Prepare and execute the query
    $stmt = $conn->prepare("SELECT * FROM drivers WHERE license_number = ?");
    $stmt->bind_param("s", $license_number);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if any driver is found
    if ($result->num_rows > 0) {
        $driver = $result->fetch_assoc();
        $response['success'] = true;
        $response['driver'] = $driver;
    }

    $stmt->close();
}

// Close the database connection
$conn->close();

// Return the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
