<?php
// Connect to the database
$host = 'localhost';  // Database host
$db = 'sports';  // Database name
$user = 'root';  // Database user
$pass = '';  // Database password

$conn = new mysqli($host, $user, $pass, $db);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the values from the form
    $bookingId = $_POST['id'];  // The booking ID to be updated
    $sport = $_POST['sport'];
    $facility = $_POST['facility'];
    $students = $_POST['students'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    // Prepare the SQL UPDATE statement
    $updateSql = "UPDATE bookings 
                  SET sport = ?, facility = ?, students = ?, date = ?, time = ? 
                  WHERE id = ?";

    // Prepare and bind the parameters
    if ($stmt = $conn->prepare($updateSql)) {
        $stmt->bind_param('sssssi', $sport, $facility, $students, $date, $time, $bookingId);

        // Execute the statement
        if ($stmt->execute()) {
            echo "<script>alert('Booking updated successfully!'); window.location.href='view.php';</script>";
        } else {
            echo "Error updating booking: " . $conn->error;
        }
    } else {
        echo "Error preparing the SQL statement: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
