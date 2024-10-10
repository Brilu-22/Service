<?php
include 'includes/connection.php'; // Ensure the correct path to connection.php

session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "User not logged in.";
    exit(); // Exit if the user is not logged in
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $title = $_POST['title'];
    $description = $_POST['description'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];

    // Connect to the database
    $conn = Database::connect(); // Use the Database class to connect

    // Check if the connection is successful
    if ($conn) {
        try {
            // Prepare the SQL statement
            $stmt = $conn->prepare("INSERT INTO calendar_events (user_id, title, description, start_time, end_time) VALUES (:user_id, :title, :description, :start_time, :end_time)");

            // Bind parameters
            $user_id = $_SESSION['user_id']; // Get the user_id from the session
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':start_time', $start_time);
            $stmt->bindParam(':end_time', $end_time);

            if ($stmt->execute()) {
                header("Location: events.php"); // Redirect to the calendar page after adding the event
                exit();
            } else {
                echo "Error adding event.";
            }

            // Execute the statement
            if ($stmt->execute()) {
                echo "Event added successfully!";
            } else {
                echo "Error: Could not execute the statement.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        // Close the connection
        $conn = null;
    } else {
        echo "Database connection failed.";
    }
} else {
    echo "Invalid request method.";
}
?>
