<?php
// save_document.php

// Database connection
$servername = "localhost"; // Replace with your server details
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$dbname = "virtual_assistance";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve document content and user_id (assuming you have a logged-in user with a session)
    $documentContent = $conn->real_escape_string($_POST['documentContent']);
    $userId = 1; // Replace with the actual logged-in user's ID, possibly from a session variable

    // Insert into the database
    $sql = "INSERT INTO documents (user_id, document_content, created_at) VALUES ($userId, '$documentContent', NOW())";

    if ($conn->query($sql) === TRUE) {
        // Get the created_at timestamp of the last inserted document
        $created_at = $conn->query("SELECT created_at FROM documents WHERE document_id = " . $conn->insert_id)->fetch_assoc()['created_at'];

        // Redirect to document_creation.php with user_id and created_at
        header("Location: document_creation.php?user_id=$userId&created_at=$created_at");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
