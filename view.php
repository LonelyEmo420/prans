<?php
// Connect to the database
$host = 'localhost';
$db = 'sports';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all bookings from the database
$sql = "SELECT * FROM bookings";
$result = $conn->query($sql);

// Handle deletion request
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_sql = "DELETE FROM bookings WHERE id = $delete_id";
    if ($conn->query($delete_sql) === TRUE) {
        echo "<script>alert('Booking deleted successfully.'); window.location.href='view.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sports Booking System</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="viewstyle.css">
    <style>
        .search-container {
            float: right;
            margin-bottom: 10px;
        }

        #searchInput {
            width: 150px;
            padding: 5px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
    </style>
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
            <li class="log"><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </nav>

    <div class="container content">
        <h2>Your Bookings</h2>

        <!-- Search Bar -->
        <div class="search-container">
            <input type="text" id="searchInput" placeholder="Search by sport..." onkeyup="filterTable()">
        </div>

        <?php if ($result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Sport</th>
                        <th>Facility</th>
                        <th>Students</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['sport']); ?></td>
                            <td><?php echo htmlspecialchars($row['facility']); ?></td>
                            <td><?php echo htmlspecialchars($row['students']); ?></td>
                            <td><?php echo htmlspecialchars($row['date']); ?></td>
                            <td><?php echo htmlspecialchars($row['time']); ?></td>
                            <td class="action-buttons">
                                <a href="javascript:void(0);" 
                                   onclick="openModal(
                                       <?php echo $row['id']; ?>, 
                                       '<?php echo addslashes($row['sport']); ?>', 
                                       '<?php echo addslashes($row['facility']); ?>', 
                                       <?php echo $row['students']; ?>, 
                                       '<?php echo $row['date']; ?>', 
                                       '<?php echo $row['time']; ?>'
                                   );">
                                    <button><i class="fas fa-edit"></i></button>
                                </a>
                                <a href="?delete_id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this booking?');">
                                    <button class="delete-btn"><i class="fas fa-trash-alt"></i></button>
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <p id="noResults" style="display: none; text-align: center; color: red; font-weight: bold;">No results found.</p>
        <?php else: ?>
            <p>No bookings found.</p>
        <?php endif; ?>
    </div>

    <div id="updateModal" class="modal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeModal()">&times;</span>
            <h2>Update Booking</h2>
            <form id="updateForm" method="POST" action="update.php">
                <input type="hidden" id="bookingId" name="id">
                
                <label for="sport">Sport</label>
                <select id="sport" name="sport" required>
                    <option>Chess</option>
                    <option>Dart</option>
                    <option>ESports</option>
                    <option>Taekwondo</option>
                    <option>Basketball</option>
                    <option>Table Tennis</option>
                </select>

                <label for="facility">Facility</label>
                <select id="facility" name="facility" required>
                    <option>Room Nimo</option>
                    <option>Room Nako</option>
                    <option>Room Niya</option>
                </select>

                <label for="students">Students</label>
                <input type="number" id="students" name="students" required>

                <label for="date">Date</label>
                <input type="date" id="date" name="date" required>

                <label for="time">Time</label>
                <input type="time" id="time" name="time" required>

                <button type="submit">Update Booking</button>
            </form>
        </div>
        <p id="noResults" style="display: none; text-align: center; color: red;">No results found.</p>

    </div>

    <?php
    // Close the database connection
    $conn->close();
    ?>

    <script>
        function openModal(bookingId, sport, facility, students, date, time) {
            document.getElementById("updateModal").style.display = "block";
            document.getElementById("bookingId").value = bookingId;
            document.getElementById("sport").value = sport;
            document.getElementById("facility").value = facility;
            document.getElementById("students").value = students;
            document.getElementById("date").value = date;
            document.getElementById("time").value = time;
        }

        function closeModal() {
            document.getElementById("updateModal").style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == document.getElementById("updateModal")) {
                closeModal();
            }
        }

        function filterTable() {
    let input = document.getElementById("searchInput").value.toLowerCase();
    let table = document.querySelector("table tbody");
    let rows = table.getElementsByTagName("tr");
    let noResults = document.getElementById("noResults");
    let found = false;

    for (let i = 0; i < rows.length; i++) {
        let sportColumn = rows[i].getElementsByTagName("td")[0]; // Sport column
        if (sportColumn) {
            let sportText = sportColumn.textContent || sportColumn.innerText;
            if (sportText.toLowerCase().startsWith(input)) { 
                // Only show if it starts with the search input
                rows[i].style.display = "";
                found = true;
            } else {
                rows[i].style.display = "none";
            }
        }
    }

    // Show "No results found" only if no matches exist
    noResults.style.display = found ? "none" : "block";
}

    </script>
</body>
</html>
