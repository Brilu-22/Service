<?php
session_start(); // Start session to retrieve logged-in user's ID

// Database connection
$conn = new mysqli('localhost', 'root', '', 'virtual_assistance');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ensure the user is logged in and we have a user_id
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id']; // Retrieve logged-in user's user_id
} else {
    die("Error: User is not logged in. Please log in first.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data and sanitize it
    $task_name = $conn->real_escape_string($_POST['task_name']);
    $task_description = $conn->real_escape_string($_POST['task_description']);
    $deadline = $conn->real_escape_string($_POST['deadline']);

    // Insert task into the database
    $query = "INSERT INTO tasks (user_id, task_name, description, deadline, status, created_at) 
              VALUES ('$user_id', '$task_name', '$task_description', '$deadline', 'Pending', NOW())";

    if ($conn->query($query) === TRUE) {
        // Redirect to avoid form resubmission and show success message
        header("Location: project_management.php?success=true");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

// Fetch all tasks related to the logged-in user
$query = "SELECT task_name, description, deadline, status, created_at FROM tasks WHERE user_id='$user_id' ORDER BY created_at DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Management</title>
</head>
<body>
    <h1>Project Task Tracking</h1>

    <!-- Task creation form -->
    <form method="POST" action="">
        <input type="text" name="task_name" placeholder="Task Name" required>
        <input type="date" name="deadline" placeholder="Deadline" required>
        <textarea name="task_description" placeholder="Task Description" required></textarea>
        <button type="submit">Create Task</button>
    </form>

    <!-- Display success message if a task is successfully created -->
    <?php
    if (isset($_GET['success']) && $_GET['success'] == 'true') {
        echo "<h2>Task Created Successfully!</h2>";
    }
    ?>

    <!-- Display existing tasks -->
    <h2>Your Tasks</h2>
    <?php
    if ($result->num_rows > 0) {
        // Loop through and display each task
        while ($row = $result->fetch_assoc()) {
            echo "<div>";
            echo "<h3>Task: " . htmlspecialchars($row['task_name']) . "</h3>";
            echo "<p><strong>Description:</strong> " . nl2br(htmlspecialchars($row['description'])) . "</p>";
            echo "<p><strong>Deadline:</strong> " . htmlspecialchars($row['deadline']) . "</p>";
            echo "<p><strong>Status:</strong> " . htmlspecialchars($row['status']) . "</p>";
            echo "<p><strong>Created At:</strong> " . htmlspecialchars($row['created_at']) . "</p>";
            echo "<hr>";
            echo "</div>";
        }
    } else {
        echo "<p>No tasks found.</p>";
    }

    // Close the database connection
    $conn->close();
    ?>
</body>
</html>
