<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sports Booking System</title>
    <link rel="stylesheet" href="style.css">\
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <nav class="nav">
        <div class="hamburger" onclick="toggleMenu()">
            <div></div>
            <div></div>
            <div></div>
        </div>
        <ul>
            <li><a href="index.php"><i class="fas fa-home"></i>&nbsp; Home</a></li>
            <li><a href="reserve.php"><i class="fas fa-calendar-check"></i>&nbsp; Reserve</a></li>
            <li><a href="view.php"><i class="fas fa-eye"></i>&nbsp; View</a></li>
            <li class="log"><a href="logout.php"><i class="fas fa-sign-out-alt"></i>&nbsp; Logout</a></li>
        </ul>
    </nav>
    <div class="container">
        <br><br><br><br><br><br>
        <center><h1>Welcome to the Sports Booking System</h1>
        <p>Our sports booking system allows you to easily reserve your favorite sports facilities, schedule games, and book coaching sessions with just a few clicks. Whether you're looking for a football field, a tennis court, or a swimming lane, we have you covered!</p>
        </center></div>
    <script>
        function toggleMenu() {
            const nav = document.querySelector('.nav');
            nav.classList.toggle('active');
        }
    </script>
</body>
</html>
