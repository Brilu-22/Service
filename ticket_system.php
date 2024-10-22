<?php
session_start(); // Ensure session is started to retrieve the logged-in user's ID

// Database connection
$conn = new mysqli('localhost', 'root', '', 'virtual_assistance');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ensure the user is logged in and we have a user_id
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id']; // Retrieve logged-in user's user_id
    } else {
        die("User is not logged in.");
    }

    // Get form data and sanitize
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $issue = $conn->real_escape_string($_POST['issue']);
    
    // Insert ticket into the database, including user_id
    $query = "INSERT INTO tickets (user_id, name, email, issue, status, created_at) VALUES ('$user_id', '$name', '$email', '$issue', 'Open', NOW())";
    
    if ($conn->query($query) === TRUE) {
        // Redirect to avoid form resubmission and show success message
        header("Location: ticket_system.php?success=true");
        exit();
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
    <title>Submit a Support Ticket</title>
    <link rel="stylesheet" href="css/tick.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" href="pics/CLlogo.svg" type="image/x-icon">

    <style>
        .social-icons a {
            margin: 0 10px; /* Adjust spacing as needed */
            color: #333; /* Change color as needed */
            text-decoration: none;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
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
            <li><a href="#">Ticket System</a></li>
        </ul>
    </nav>
    <h1>Submit a Support Ticket</h1>

    <!-- Ticket submission form -->
    <form method="POST" action="">
        <input type="text" name="name" placeholder="Your Name" required>
        <input type="email" name="email" placeholder="Your Email" required>
        <textarea name="issue" placeholder="Describe your issue" required></textarea>
        <button type="submit">Submit Ticket</button>
    </form>

    <!-- Show success message after ticket submission -->
    <?php
    if (isset($_GET['success']) && $_GET['success'] == 'true') {
        echo "<h3>Ticket Submitted Successfully!</h3>";
    }
    ?>

    <h2>Previous Tickets</h2>

    

    <!-- Display previously submitted tickets -->
    <?php
    $query = "SELECT name, email, issue, created_at, status FROM tickets ORDER BY created_at DESC";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Loop through and display each ticket in a styled design
        while ($row = $result->fetch_assoc()) {
            echo "<div class='ticket created-by-anniedotexe'>";
            echo "<div class='left'>";
            echo "<div class='image'></div>";
            echo "<div class='ticket-info'>";
            echo "<div class='date'><span>DATE</span><span class='june-29'>" . htmlspecialchars($row['created_at']) . "</span><span>STATUS</span></div>";
            echo "<div class='show-name'><h1>Support Ticket</h1><h2>" . htmlspecialchars($row['name']) . "</h2></div>";
            echo "<div class='time'><p>" . htmlspecialchars($row['issue']) . "</p></div>";
            echo "<div class='location'><span>Email: " . htmlspecialchars($row['email']) . "</span></div>";
            echo "</div>";
            echo "</div>";
            echo "<div class='right'>";
            echo "<div class='right-info-container'>";
            echo "<div class='show-name'><h1>Status: " . htmlspecialchars($row['status']) . "</h1></div>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "<p>No tickets found.</p>";
    }

    // Close the database connection
    $conn->close();
    ?>
    
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
