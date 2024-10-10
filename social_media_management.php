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
    $scheduled_for = $conn->real_escape_string($_POST['scheduled_for']); // Use the new field name
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
</head>
<body>
    <h1>Schedule a Social Media Post</h1>

    <!-- Form to schedule a new social media post -->
    <form method="POST" action="" enctype="multipart/form-data">
        <select name="platform">
            <option value="Instagram">Instagram</option>
            <option value="LinkedIn">LinkedIn</option>
            <option value="Facebook">Facebook</option>
        </select>
        <textarea name="postContent" placeholder="Your post content" required></textarea>
        <input type="datetime-local" name="scheduled_for" required placeholder="Scheduled Time"> <!-- Updated field name -->
        <input type="file" name="image" accept="image/*"> <!-- Image upload input -->
        <button type="submit">Schedule Post</button>
    </form>

    <!-- Success message after a post is scheduled -->
    <?php
    if (isset($_GET['success']) && $_GET['success'] == 'true') {
        echo "<h2>Post Scheduled Successfully!</h2>";
    }
    ?>

    <!-- Display all scheduled posts for the logged-in user -->
    <h2>Your Scheduled Posts</h2>
    <?php
    if ($result->num_rows > 0) {
        // Loop through and display each scheduled post
        while ($row = $result->fetch_assoc()) {
            echo "<div>";
            echo "<h3>Platform: " . htmlspecialchars($row['platform']) . "</h3>";
            echo "<p><strong>Post Content:</strong> " . nl2br(htmlspecialchars($row['post_content'])) . "</p>";
            echo "<p><strong>Scheduled For:</strong> " . htmlspecialchars($row['scheduled_for']) . "</p>"; // Updated field name
            echo "<p><strong>Image:</strong> " . ($row['image_path'] ? "<img src='" . htmlspecialchars($row['image_path']) . "' alt='Post Image' width='100'>" : "No image uploaded") . "</p>"; // Display image if uploaded
            echo "<p><strong>Created At:</strong> " . htmlspecialchars($row['created_at']) . "</p>";
            echo "<hr>";
            echo "</div>";
        }
    } else {
        echo "<p>No scheduled posts found.</p>";
    }

    // Close the database connection
    $conn->close();
    ?>
</body>
</html>
