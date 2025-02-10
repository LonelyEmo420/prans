<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sports Booking System</title>
    <link rel="stylesheet" href="style.css">
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

    <div class="container content">
        <div class="booking-form">
            <h2>Book a Slot</h2>
            <form action="reserve.php" method="POST">
                <label for="sport">Choose a sport:</label>
                <select id="sport" name="sport">
                    <option>Chess</option>
                    <option>Dart</option>
                    <option>ESports</option>
                    <option>Taekwondo</option>
                    <option>Basketball</option>
                    <option>Table Tennis</option>
                </select>
                <label for="facility">Choose a facility room:</label>
                <select id="facility" name="facility">
                    <option>Room Nimo</option>
                    <option>Room Nako</option>
                    <option>Room Niya</option>
                </select>
                <label for="students">Number of Students:</label>
                <input type="number" id="students" name="students" min="1" placeholder="Enter number of students">
                <label for="date">Select Date:</label>
                <input type="date" id="date" name="date">
                <label for="time">Select Time:</label>
                <input type="time" id="time" name="time">
                <button type="submit">Book Now</button>
            </form>
        </div>
    </div>

    <script>
        function toggleMenu() {
            const nav = document.querySelector('.nav');
            nav.classList.toggle('active');
        }
    </script>
</body>
</html>
