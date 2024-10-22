<?php
session_start();
include 'includes/connection.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$conn = Database::connect();

// Fetch events for the logged-in user
$stmt = $conn->prepare("SELECT * FROM calendar_events WHERE user_id = :user_id");
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$events = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Calendar</title>
    <link rel="stylesheet" href="css/event.css">
    <link rel="icon" href="pics/CLlogo.svg" type="image/x-icon">
    <style>
        /* Basic styles for the calendar */
        #calendar {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            grid-gap: 10px;
            margin-top: 20px;
        }
        .day {
            border: 1px solid #ccc;
            padding: 10px;
            min-height: 100px;
            position: relative;
        }
        .event {
            background-color: #152500;
            color: white;
            padding: 5px;
            margin: 5px 0;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Calendar</h1>
        <nav>
        <div class="logo-container">
                <img src="pics/click.svg" alt="Logo">
            </div>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="services.php">Services</a></li>
                <li><a href="calender.html">Calendar Management</a></li>  
                <li><a href="document_creation.php">Document Creation</a></li>
                <li><a href="live_chat.php">Live Chat</a></li>
                <li><a href="project_management.php">Project Management</a></li>
                <li><a href="social_media_management.php">Social Media Management</a></li>
                <li><a href="ticket_system.php">Ticket System</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>

            
        </nav>
    </header>

    <main>
        <div id="calendar">
            <!-- Dynamically filled with JavaScript -->
        </div>
    </main>

    <script>
        // Function to create a calendar
        function createCalendar() {
            const calendarElement = document.getElementById('calendar');
            const events = <?php echo json_encode($events); ?>; // Pass PHP events to JavaScript
            
            const date = new Date(); // Current date
            date.setDate(1); // Set to first day of the month
            
            const monthDays = new Date(date.getFullYear(), date.getMonth() + 1, 0).getDate(); // Get days in month
            const firstDayIndex = date.getDay(); // Get first day index
            
            // Fill the calendar grid
            for (let i = 0; i < firstDayIndex; i++) {
                const emptyDiv = document.createElement('div');
                calendarElement.appendChild(emptyDiv); // Empty slots for days before the first of the month
            }
            
            for (let day = 1; day <= monthDays; day++) {
                const dayDiv = document.createElement('div');
                dayDiv.classList.add('day');
                dayDiv.innerText = day;
                
                // Filter events for the current day
                const currentEvents = events.filter(event => {
                    const eventDate = new Date(event.start_time);
                    return eventDate.getDate() === day && eventDate.getMonth() === date.getMonth() && eventDate.getFullYear() === date.getFullYear();
                });
                
                // Add events to the day
                currentEvents.forEach(event => {
                    const eventDiv = document.createElement('div');
                    eventDiv.classList.add('event');
                    eventDiv.innerText = event.title + ' (' + new Date(event.start_time).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }) + ')';
                    dayDiv.appendChild(eventDiv);
                });
                
                calendarElement.appendChild(dayDiv);
            }
        }

        // Call the createCalendar function to build the calendar on page load
        window.onload = createCalendar;
    </script>
    <footer>
    <p>&copy; <?php echo date("Y"); ?> Virtual Assistant Services</p>
    <div class="social-icons">
        <a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a>
        <a href="#" title="Twitter"><i class="fab fa-twitter"></i></a>
        <a href="#" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
        <a href="#" title="Instagram"><i class="fab fa-instagram"></i></a>
    </div>
    <small>Designed by Virtual Assistant Services</small>
</footer>
</body>
</html>
