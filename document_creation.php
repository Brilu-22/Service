<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tiny.cloud/1/pzcb47o65hvzuzgla71g7utxnmoyahu2ev38m4hzdklu890w/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>

        tinymce.init({
            selector: '#documentEditor'
        });
    </script>
    <link rel="stylesheet" href="css/serr.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" href="pics/CLlogo.svg" type="image/x-icon">

    <style>
        .social-icons a {
            margin: 0 10px; /* Adjust spacing as needed */
            color: #333; /* Change color as needed */
            text-decoration: none;
        }
    </style>
    <title>Document Creation</title>
</head>
<body>
    <nav>
    <div class="logo-container">
                <img src="pics/click.svg" alt="Logo">
            </div>
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="services.php">Services</a></li>
            <li><a href="calendar.html">Calendar Management</a></li>  
            <li><a href="document_creation.php">Document Creation</a></li>
            <li><a href="live_chat.php">Live Chat</a></li>
            <li><a href="project_management.php">Project Management</a></li>
            <li><a href="social_media_management.php">Social Media Management</a></li>
            <li><a href="ticket_system.php">Ticket System</a></li>
            <li><a href="logout.php">LogOut</a></li>
        </ul>
    </nav>

    <header class="header-container">
        <h1>Create a Document</h1>
        <p>Come here and create your own personalized documents...</p>
    </header>

    <main>
        <!-- Event Creation Form -->
        <form method="POST" action="save_document.php">
            <label for="title">Title:</label>
            <input type="text" name="title" required /><br />

            <label for="description">Document:</label>
            <textarea id="documentEditor" name="documentContent" class="doc"></textarea><br />

            

            <button type="submit">Save Document</button>
        </form>

        <h2>Previously Saved Documents</h2>
        <?php
        // Database connection
        $servername = "localhost"; // Replace with your server details
        $username = "root"; // Replace with your MySQL username
        $password = ""; // Replace with your MySQL password
        $dbname = "virtual_assistance"; // Replace with your database name

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch all saved documents for the user
        $userId = 1; // Replace with the actual logged-in user's ID
        $sql = "SELECT document_content, created_at FROM documents WHERE user_id = $userId ORDER BY created_at DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Loop through and display each document
            while ($row = $result->fetch_assoc()) {
                echo "<div class='saved-document'>";
                echo "<h3>Document Created At: " . $row['created_at'] . "</h3>";
                echo "<div>" . $row['document_content'] . "</div>"; // Render the content as HTML
                echo "<hr>";
                echo "</div>";
            }
        } else {
            echo "<p>No documents found.</p>";
        }

        // Close the database connection
        $conn->close();
        ?>
    </main>

    <footer>
    <p>&copy; <?php echo date("Y"); ?> Clickbait . A Virtual Service Platform made for you </p>
    <div class="social-icons">
        <a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a>
        <a href="#" title="Twitter"><i class="fab fa-twitter"></i></a>
        <a href="#" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
        <a href="#" title="Instagram"><i class="fab fa-instagram"></i></a>
    </div>
    <small>Designed by Zechaniah Hlongwane.</small>
</footer>
</body>
</html>
