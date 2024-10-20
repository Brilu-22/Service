<?php
session_start();
include 'includes/connection.php';  // Include the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);  // Hash the password for security

    $conn = Database::connect();
    if ($conn) {
        try {
            // Prepare the SQL statement to insert user
            $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);

            // Execute the statement
            if ($stmt->execute()) {
                // Store the user ID and name in the session
                $_SESSION['user_id'] = $conn->lastInsertId();
                $_SESSION['name'] = $name;

                // Redirect to the home page after successful signup
                header("Location: home.php");
                exit();
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
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/home.css">
    <title>Signup</title>
</head>
<body>
<div class="page">
  <div class="container">
    <div class="left">
      <div class="login">Signup</div>
      <div class="eula">
        By signing up, you agree to the ridiculously long terms that you didn't bother to read.
      </div>
    </div>
    <div class="right">
      <svg viewBox="0 0 320 300">
        <defs>
          <linearGradient
            id="linearGradient"
            x1="13"
            y1="193.49992"
            x2="307"
            y2="193.49992"
            gradientUnits="userSpaceOnUse"
          >
            <stop style="stop-color: #152500" offset="0"/>
            <stop style="stop-color: #000" offset="1"/>
          </linearGradient>
        </defs>
        <path
          id="path"
          d="m 40,120.00016 239.99984,-3.2e-4 c 0,0 24.99263,0.79932 25.00016,35.00016 0.008,34.20084 -25.00016,35 -25.00016,35 h -239.99984 c 0,-0.0205 -25,4.01348 -25,38.5 0,34.48652 25,38.5 25,38.5 h 215 c 0,0 20,-0.99604 20,-25 0,-24.00396 -20,-25 -20,-25 h -190 c 0,0 -20,1.71033 -20,25 0,24.00396 20,25 20,25 h 168.57143"
          stroke="url(#linearGradient)" fill="none" stroke-width="2" stroke-dasharray="240 1386" stroke-dashoffset="0"
        />
      </svg>
      <div class="form">
        <form method="POST" action="">
          <label for="name">Name</label>
          <input type="text" name="name" id="name" required />
         
          <label for="email">Email</label>
          <input type="email" name="email" id="email" required />

          <label for="password">Password</label>
          <input type="password" name="password" id="password" required />

          <input type="submit" id="submit" value="Submit" />
        </form>
        <p>Already have an account? <a href="login.php">Login here</a>.</p>
      </div>
    </div>
  </div>
</div>

<script>
// JavaScript for SVG path animation
var current = null;

// Helper function for easing (easeOutQuart)
function easeOutQuart(t) {
  return 1 - --t * t * t * t;
}

// Animate function to replace anime.js functionality
function animatePath(targets, props, duration) {
  var start = null;
  var element = document.querySelector(targets);
  var initialStrokeDashoffset = parseFloat(
    getComputedStyle(element).strokeDashoffset
  );
  var initialStrokeDasharray = getComputedStyle(element)
    .strokeDasharray.split(" ")
    .map(Number);

  function animateStep(timestamp) {
    if (!start) start = timestamp;
    var progress = Math.min((timestamp - start) / duration, 1); // Normalize progress to 0-1
    var easedProgress = easeOutQuart(progress); // Apply easing

    // Animate strokeDashoffset
    if (props.strokeDashoffset) {
      var offsetValue =
        initialStrokeDashoffset +
        easedProgress *
          (props.strokeDashoffset.value - initialStrokeDashoffset);
      element.style.strokeDashoffset = offsetValue;
    }

    // Animate strokeDasharray
    if (props.strokeDasharray) {
      var dasharrayValue = [
        initialStrokeDasharray[0] +
          easedProgress *
            (props.strokeDasharray.value[0] - initialStrokeDasharray[0]),
        initialStrokeDasharray[1],
      ];
      element.style.strokeDasharray = dasharrayValue.join(" ");
    }

    if (progress < 1) {
      requestAnimationFrame(animateStep);
    }
  }

  requestAnimationFrame(animateStep);
}

// Event listeners for input focus

document.querySelector("#name").addEventListener("focus", function (e) {
  if (current) cancelAnimationFrame(current); // Stop previous animation
  current = animatePath(
    "#path",
    {
      strokeDashoffset: { value: 0 },
      strokeDasharray: { value: [240, 1386] },
    },
    700
  );
});

document.querySelector("#email").addEventListener("focus", function (e) {
  if (current) cancelAnimationFrame(current); // Stop previous animation
  current = animatePath(
    "#path",
    {
      strokeDashoffset: { value: -336 },
      strokeDasharray: { value: [240, 1386] },
    },
    700
  );
});

document.querySelector("#password").addEventListener("focus", function (e) {
  if (current) cancelAnimationFrame(current); // Stop previous animation
  current = animatePath(
    "#path",
    {
      strokeDashoffset: { value: -663 },
      strokeDasharray: { value: [240, 1386] },
    },
    700
  );
});

document.querySelector("#submit").addEventListener("focus", function (e) {
  if (current) cancelAnimationFrame(current); // Stop previous animation
  current = animatePath(
    "#path",
    {
      strokeDashoffset: { value: -730 },
      strokeDasharray: { value: [530, 1386] },
    },
    700
  );
});
</script>

</body>
</html>
