<?php
session_start();
include 'includes/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $conn = Database::connect();
    if ($conn) {
        try {
            $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['name'] = $user['name'];
                header("Location: home.php"); // Redirect to home page after login
                exit();
            } else {
                echo "Invalid email or password.";
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
    <title>Login</title>
</head>
<body>
<div class="page">
<div class="logo-container">
      <img src="pics/Frame 34.svg" alt="">
  </div>
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
      <h2>Login</h2>
    <form method="POST" action="">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required />

        <label for="password">Password</label>
        <input type="password" name="password" id="password" required />
        
        <button type="submit" id="submit" value="login">Login</button>
    </form>
    <p>Don't have an account? <a href="signup.php">Signup here</a>.</p>

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


document.querySelector("#email").addEventListener("focus", function (e) {
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

document.querySelector("#password").addEventListener("focus", function (e) {
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
