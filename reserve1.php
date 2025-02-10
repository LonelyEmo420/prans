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

// Process form data when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sport = $_POST['sport'] ?? '';
    $facility = $_POST['facility'] ?? '';
    $students = $_POST['students'] ?? '';
    $date = $_POST['date'] ?? '';
    $time = $_POST['time'] ?? '';

    // Validate form data
    if (empty($sport) || empty($facility) || empty($students) || empty($date) || empty($time)) {
        echo "<script>alert('Please fill out all the fields.'); window.location.href = 'reserve.html';</script>";
        exit();
    }

    // Insert the booking details into the database
    $stmt = $conn->prepare("INSERT INTO bookings (sport, facility, students, date, time) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiss", $sport, $facility, $students, $date, $time);

    if ($stmt->execute()) {
        // Booking was successful
        echo "<script>alert('Booking confirmed!'); window.location.href = 'index.html';</script>";
    } else {
        // Error occurred while inserting data
        echo "<script>alert('Error occurred. Please try again later.'); window.location.href = 'reserve.html';</script>";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
