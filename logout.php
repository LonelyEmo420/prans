<?php
session_start();  // Start session
session_unset();  // Unset session variables
session_destroy(); // Destroy session

// Show an alert before redirecting
echo "<script>
    alert('Successfully logged out!');
    window.location.href = 'login.html';
</script>";

exit();
?>
