<?php
include 'includes/connection.php'; // Include the database connection
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Services</title>
    <link rel="stylesheet" href="css/vice.css">
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
    <header class="header-container">
        <h1>:/Click-Us</h1>
        <p>Try Clickbait today , a virtual assistance service that works for you and your business. Let us help you with making your brand move more efficiently</p>
        <nav>
            <div class="logo-container">
                <a href="home.php"><img src="pics/click.svg" alt="Logo"></a> 
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
                <li><a href="contactus.php">Contact Us</a></li>

            </ul>
        </nav>
    </header>

    
    
     <!--Hero Section -->
    <section class="hero-banner">
        <div class="hero-content">
            <div class="hero-left">
                <h2>Welcome to :/Clickbait </h2>
                <h3>The Virtual Assistance Platform made for you.</h3>
                <p>Providing you with the administrative, customer service, social media, and project management support you need.</p>
                <button onclick="location.href='contact.php'">Get Started</button>
            </div>
            <div class="hero-right">
                <img src="pics/meet.jpg" alt="Hero Image">
            </div>
        </div>
    </section>

    

    <!-- Meet the Team Section -->
    <section class="meet-the-team">
        <h2>Meet the Team</h2>
        <div class="team-container">

            <div class="team-member1">
                <img src="pics/E.jpg" alt="Team Member 1">
                <h3>Zech Hlongs</h3>
                <p>CEO & Founder</p>
                <p>Zech leads the team with over as many you think is best years of experience in virtual assistance and project management.</p>
            </div>

            <div class="team-member">
                <img src="pics/A.jpg" alt="Team Member 2">
                <h3>John Stith</h3>
                <p>Lead Development Strategist</p>
                <p>John helps to elevate the virtual assistance experience for all users.</p>
            </div>
            <div class="team-member1">
                <img src="pics/B.jpg" alt="Team Member 3">
                <h3>Jane Smith</h3>
                <p>Lead Project Manager</p>
                <p>Jane oversees all project management tasks and ensures smooth team coordination.</p>
            </div>
            <div class="team-member">
                <img src="pics/C.jpg" alt="Team Member 4">
                <h3>Tshwaragano Bophelo</h3>
                <p>Social Media Strategist</p>
                <p>Emily creates and manages content for social media platforms to drive engagement and growth.</p>
            </div>
            <div class="team-member1">
                <img src="pics/D.jpg" alt="Team Member 5">
                <h3>Michael Lee</h3>
                <p>Customer Support Lead</p>
                <p>Michael ensures that all customer inquiries and issues are handled promptly and professionally.</p>
            </div>
        </div>
    </section>


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
            <button onclick="location.href='ticket_system.php'">Book a Consultation</button>
        </section>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.5/gsap.min.js"></script>
<script>
    // Target each block (left and right) individually
    document.querySelectorAll('.left-block, .right-block').forEach(block => {
        // When the mouse enters a block
        block.addEventListener('mouseenter', () => {
            gsap.to(block, { 
                backgroundColor: "", 
                scale: 1.05,                 // Slightly increase size
                duration: 0.5,               // Duration of the animation
                ease: "power2.out",          // Smoothing effect
                boxShadow: "0 4px 20px rgba(0, 0, 0, 0.2)" // Apply shadow
            });
            gsap.to(block.querySelectorAll('h2, p'), { 
                color: "#fff",                // Darker text color
                duration: 0.5                 // Duration for text color change
            });
        });

        // When the mouse leaves the block
        block.addEventListener('mouseleave', () => {
            gsap.to(block, { 
                backgroundColor: "#fff",      // Return background color to white
                scale: 1,                     // Return scale to normal
                duration: 0.5,                // Duration of the animation
                ease: "power2.out",           // Smoothing effect
                boxShadow: "0 0px 0px rgba(0, 0, 0, 0)" // Remove shadow
            });
            gsap.to(block.querySelectorAll('h2, p'), { 
                color: "#000",                // Return text color to black
                duration: 0.5                 // Duration for text color change
            });
        });
    });
</script>


</html>
