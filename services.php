<?php
include 'includes/connection.php'; // Include the database connection
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Services</title>
    <link rel="stylesheet" href="css/service.css">
</head>
<body>
    <header class="header-container">
        <h1>Our Virtual Assistant Services</h1>
        <nav>
            <div class="logo-container">
                <a href="home.php"><img src="pics/click.svg" alt="Logo"></a> 
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

    
    <section class="slider-section">
        <h2>Our Partners</h2>
        <div class="slider">
        <div class="slide-track">
    <!-- Existing logos -->
    <div class="slide">
        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/557257/1.png" height="100" width="250" alt="" class="bw-logo" />
    </div>
    <div class="slide">
        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/557257/2.png" height="100" width="250" alt="" class="bw-logo" />
    </div>
    <div class="slide">
        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/557257/3.png" height="100" width="250" alt="" class="bw-logo" />
    </div>
    <div class="slide">
        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/557257/4.png" height="100" width="250" alt="" class="bw-logo" />
    </div>
    <div class="slide">
        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/557257/5.png" height="100" width="250" alt="" class="bw-logo" />
    </div>
    <div class="slide">
        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/557257/6.png" height="100" width="250" alt="" class="bw-logo" />
    </div>
    <div class="slide">
        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/557257/7.png" height="100" width="250" alt="" class="bw-logo" />
    </div>

    <!-- New logos for Instagram, Twitter, Notion, and OneNote -->
    <div class="slide">
        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/557257/4.png" height="100" width="250" alt="Instagram" class="bw-logo" />
    </div>
    <div class="slide">
        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/557257/2.png" height="100" width="250" alt="Twitter" class="bw-logo" />
    </div>
    <div class="slide">
        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/557257/6.png" height="100" width="250" alt="Notion" class="bw-logo" />
    </div>
    <div class="slide">
        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/557257/3.png" height="100" width="250" alt="OneNote" class="bw-logo" />
    </div>

    <!-- Repeat slides to create a continuous loop -->
    <div class="slide">
        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/557257/1.png" height="100" width="250" alt="" class="bw-logo" />
    </div>
</div>

        </div>
    </section>

    <!-- Hero Section -->
    <section class="hero-banner">
        <div class="hero-content">
            <div class="hero-left">
                <h2>Welcome to Our Virtual Assistant Services</h2>
                <p>Providing you with the administrative, customer service, social media, and project management support you need.</p>
                <button onclick="location.href='contact.php'">Get Started</button>
            </div>
            <div class="hero-right">
                <img src="pics/meet.jpg" alt="Hero Image">
            </div>
        </div>
    </section>

    <div class="banner">
        <img src="pics/Frame 33.svg" alt="Virtual Assistant Services Banner">
    
        <div class="banner-text">
            <div class="click">
                <h1>:/CLICKBAIT..</h1>
                <p>Let us handle your tasks while you focus on growth.</p>
        </div>
    
    </div>


    <main>
    <div class="content-container">
        <section class="left-block">
            <h2>Administrative Support</h2>
            <p>Calendar management, travel planning, document creation, and data entry.</p>
        </section>
        <section class="right-block">
            <h2>Customer Service Support</h2>
            <p>Handling customer inquiries, support ticket management, phone call assistance, and live chat support.</p>
        </section>
    </div>
    <div class="content-container">
        <section class="left-block">
            <h2>Social Media Management</h2>
            <p>Creating and scheduling posts, managing engagement, and developing growth strategies for platforms like Instagram, LinkedIn, and Facebook.</p>
        </section>
        <section class="right-block">
            <h2>Project Management</h2>
            <p>Task tracking, deadline management, and team coordination through tools like Asana and Trello.</p>
        </section>
    </div>
    <div class="content-container">
        <section class="left-block">
            <h2>Specialized Support</h2>
            <p>Bookkeeping, CRM management, event planning, and market research.</p>
        </section>
        <section class="right-block">
            <button onclick="location.href='contact.php'">Book a Consultation</button>
        </section>
    </div>
</main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Virtual Assistant Services. All rights reserved.</p>
    </footer>
</body>
</html>
