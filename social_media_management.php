<?php
session_start(); // Start session to access user ID

// Database connection
$conn = new mysqli('localhost', 'root', '', 'virtual_assistance');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ensure the user is logged in and has a user ID
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id']; // Get logged-in user's ID
} else {
    die("Error: User is not logged in. Please log in first.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data and sanitize
    $platform = $conn->real_escape_string($_POST['platform']);
    $post_content = $conn->real_escape_string($_POST['postContent']);
    $scheduled_for = $conn->real_escape_string($_POST['scheduled_for']);
    $image_path = ""; // Initialize image_path variable

    // Check if an image was uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "uploads/"; // Directory where images will be stored
        $image_path = $target_dir . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $image_path);
    }

    // Insert the scheduled post into the database
    $query = "INSERT INTO social_media_posts (user_id, platform, post_content, scheduled_for, image_path, created_at) 
              VALUES ('$user_id', '$platform', '$post_content', '$scheduled_for', '$image_path', NOW())";

    if ($conn->query($query) === TRUE) {
        // Redirect to avoid form resubmission and show success message  
        header("Location: social_media_management.php?success=true");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

// Fetch all scheduled posts for the logged-in user
$query = "SELECT platform, post_content, scheduled_for, image_path, created_at FROM social_media_posts WHERE user_id='$user_id' ORDER BY created_at DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social Media Management</title>
    <link rel="stylesheet" href="css/create.css">
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
<nav>
        <div class="logo-container">
                <img src="pics/click.svg" alt="Logo">
            </div>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="services.php">About Us</a></li>
                <li><a href="calender.html">Calendar Management</a></li>  
                <li><a href="document_creation.php">Document Creation</a></li>
                <li><a href="live_chat.php">Live Chat</a></li>
                <li><a href="project_management.php">Project Management</a></li>
                <li><a href="social_media_management.php">Social Media Management</a></li>
                <li><a href="ticket_system.php">Ticket System</a></li>
                <li><a href="logout.php">Logout</a></li>

            </ul>

            
        </nav>

    <main>
        <h1>Schedule a Social Media Post</h1>

        <!-- Form to schedule a new social media post -->
        <form method="POST" action="" enctype="multipart/form-data">
            <label for="platform">Platform:</label>
            <select name="platform">
                <option value="Instagram">Instagram</option>
                <option value="LinkedIn">LinkedIn</option>
                <option value="Facebook">Facebook</option>
            </select>
            
            <label for="postContent">Post Content:</label>
            <textarea name="postContent" placeholder="Your post content" required></textarea>

            <label for="scheduled_for">Scheduled Time:</label>
            <input type="datetime-local" name="scheduled_for" required placeholder="Scheduled Time">
            
            <label for="image">Upload Image:</label>
            <input type="file" name="image" accept="image/*">

            <button type="submit">Schedule Post</button>
        </form>

        <!-- Success message after a post is scheduled -->
        <?php if (isset($_GET['success']) && $_GET['success'] == 'true'): ?>
            <h2>Post Scheduled Successfully!</h2>
        <?php endif; ?>

        <!-- Display all scheduled posts for the logged-in user -->
        <h2>Your Scheduled Posts</h2>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="post">
                    <h3><i class="fa fa-<?= strtolower($row['platform']) ?>"></i><?= htmlspecialchars($row['platform']) ?></h3>
                    <p><strong>Post Content:</strong> <?= nl2br(htmlspecialchars($row['post_content'])) ?></p>
                    <p><strong>Scheduled For:</strong> <?= htmlspecialchars($row['scheduled_for']) ?></p>
                    <p><strong>Image:</strong> <?= $row['image_path'] ? "<img src='" . htmlspecialchars($row['image_path']) . "' alt='Post Image' width='100'>" : "No image uploaded" ?></p>
                    <p><strong>Created At:</strong> <?= htmlspecialchars($row['created_at']) ?></p>
                    <hr>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No scheduled posts found.</p>
        <?php endif; ?>
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
