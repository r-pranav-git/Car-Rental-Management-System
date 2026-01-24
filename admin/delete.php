<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userid = $_POST["userid"];

    $conn = mysqli_connect("localhost", "root", "", "vehicle");
    if ($conn->connect_error) {
        die("connection failed:" . $conn->connect_error);
    }

    // Prepare the DELETE statement
    $sql = "DELETE FROM register WHERE userid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userid);

    // Execute the DELETE statement
    if ($stmt->execute()) {
        $message="Record deleted successfully";
    //}else {
    //     echo "Error deleting record: " . $conn->error;
    // }

        if ($_SESSION['userid']==$userid) {
            session_destroy();
        }
    }else {
        $messagemessage="Error deleting record:".$conn->error;
    }




    $stmt->close();
    $conn->close();

    // Redirect back to the main page after deletion
    header("Location: delete_confirmation.php? message=".urlencode($message));
    exit();
} else {
    echo "Invalid request method";
}
?>