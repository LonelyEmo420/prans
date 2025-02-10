<?php
session_start();

function authenticateUser($username, $password) {
    // Example credentials (replace with database check)
    $validUser = "admin";
    $validPass = "password";

    if ($username === $validUser && $password === $validPass) {
        $_SESSION['user'] = $username;
        echo "<script>
                alert('Login successful! Redirecting...');
                window.location.href = 'index.php';
              </script>";
        exit();
    } else {
        echo "<script>
                alert('Invalid username or password. Please try again.');
                window.location.href = 'login.html';
              </script>";
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    authenticateUser($username, $password);
}
?>
