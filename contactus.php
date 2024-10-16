<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="css/contact.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
        <h1>:/Contact-Us</h1>
        <p>Ask Us and We'll help you . </p>
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

    <!-- Contact Form -->
    <div class="contact-form">
        <h2>Contact Us</h2>
        <form id="contactForm" method="POST">
            <div class="form-group">
                <label for="name">Your Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Your Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="message">Your Message</label>
                <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <!-- Company Contact Details -->
    <div class="contact-details">
        <h3>Company Contact Details</h3>
        <p><strong>Email:</strong> support@yourcompany.com</p>
        <p><strong>Phone:</strong> +123 456 7890</p>
        <p><strong>Address:</strong> 123 Business Street, City, Country</p>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="submissionModal" tabindex="-1" role="dialog" aria-labelledby="submissionModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="submissionModalLabel">Request Submitted</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Thank you for reaching out! We’ve received your message. Look out for an email from us soon.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery and Bootstrap JS (required for modal functionality) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- JavaScript for modal after form submission -->
    <script>
        // Handle form submission
        document.getElementById('contactForm').addEventListener('submit', function (event) {
            event.preventDefault();
            
            // Show the modal
            $('#submissionModal').modal('show');

            // Optionally, here you can handle form data (e.g., sending it via AJAX or saving it in a database)
        });
    </script>

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
