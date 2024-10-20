<?php
session_start();
include 'includes/connection.php'; // Include the database connection

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: signup.php"); // Redirect to login if not logged in
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Virtual Assistant Services</title>
    <link rel="stylesheet" href="css/h.css">
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
    
    <header>
        <div class="border">
            <h1>Simplify your Work. Maximize Your Time.</h1>
            <p>Providing top-notch virtual assistant services to streamline your business needs.</p>
            <h2>Welcome,<?php echo htmlspecialchars($_SESSION['name']); ?>!</h2>
        </div>

        <nav>
        <div class="logo-container">
                <img src="pics/click.svg" alt="Logo">
            </div>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="services.php">Services</a></li>
                <li><a href="calender.html">Calendar Management</a></li>  
                <li><a href="document_creation.php">Document Creation</a></li>
                <li><a href="live_chat.php">Live Chat</a></li>
                <li><a href="project_management.php">Project Management</a></li>
                <li><a href="social_media_management.php">Social Media Management</a></li>
                <li><a href="ticket_system.php">Ticket System</a></li>
            </ul>

            
        </nav>
    </header>
    <div class="cards-container">
    <div class="card image-card">
        <img src="pics/type.jpg" alt="Virtual Assistance Image">
    </div>
    <div class="card text-card">
        <img src="pics/bait.svg" alt="Bait Image">
    </div>
</div>
    <div class="banner">
    <img src="pics/Frame 33.svg" alt="Virtual Assistant Services Banner">
    
    <div class="banner-text">
    <div class="click">
        <h1>:/CLICKBAIT..</h1>
        <p>Let us handle your tasks while you focus on growth.</p>
    </div>
    
</div>

        
    
</div>

    <main>
    <section>
        <figure>
            <img src="pics/vin.jpg" alt="Admin">
            <figcaption>Administrative Support</figcaption>
            
        </figure>
    </section>

        <section>
            <figure>
                <img src="pics/books.jpg" alt="mouse">
                <figcaption>Customer Service Support</figcaption>
            </figure>  
        </section>

        <section>
            <figure>
                <img src="pics/cof.jpg" alt="car">
                <figcaption>Social Media Management</figcaption>
            </figure>    
        </section>

        <section>
            <figure>
                <img src="pics/day.jpg" alt="camera">
                <figcaption>Project Management</figcaption>
            </figure>
        </section>

        <section>
            <figure>
                <img src="pics/do.jpg" alt="point">
                <figcaption>Specialized Support</figcaption>
            </figure>
        </section>

        <div class="cta">
            <a href="contactus.php" class="cta-button">Book a Consultation</a>
        </div>
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
