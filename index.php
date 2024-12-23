<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Career Planning</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Chatbot icon styles */
        .chatbot-icon {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 60px;
            height: 60px;
            background-color: #007bff;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            z-index: 1000;
        }

        .chatbot-icon img {
            width: 35px;
            height: 35px;
        }

        /* Chatbot iframe styles (initially hidden) */
        iframe.chatbot-iframe {
            position: fixed;
            bottom: 90px;
            right: 20px;
            width: 350px;
            height: 500px;
            border: none;
            z-index: 1000;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            display: none; /* Initially hidden */
        }


/* Hero Section */
@media (max-width: 768px) {
    .hero {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .hero-content {
        margin-bottom: 20px;
    }
}

/* Footer responsiveness */
@media (max-width: 768px) {
    footer .footer-content {
        text-align: center;
    }
}

/* General adjustments for small screens */
@media (max-width: 480px) {
    .cta-btn {
        font-size: 14px;
        padding: 10px 20px;
    }

    h2 {
        font-size: 1.5rem;
    }

    .explore-button {
        font-size: 14px;
    }
}

    </style>
</head>
<body>
    <header>
        <nav class="navbar">
            <a href="#" class="logo">
                <img src="https://media.istockphoto.com/id/1250007150/vector/emotional-intelligence-coaching-icon-teacher-sign-coach-symbol.jpg?s=612x612&w=0&k=20&c=UzOnbibU6V-Ldg9TT8uIEaQJuKukCKzeijrZ2JCYse0=" alt="Career Planning Logo">
            </a>
            <ul class="nav-links">
                <li><a href="about.html">About</a></li>
                
                <li><a href="job.html">Jobs</a></li>
                <li><a href="mentorship.html">Mentorship</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Career Planning <span>Progress</span></h1>
            <p>Empower your career path with our tools, resources, and support to achieve success.</p>
            <button class="cta-btn">Get started!</button>
        </div>
        <div class="hero-image">
            <img src="c.jpg" alt="Career Planning Illustration">
        </div>
    </section>

    <!-- Main Content Section -->
    <section class="main-content">
        <h2>Our Services</h2>
        <div class="services">
            <div class="service">
                <img src="https://brainstorminternational.co.in/wp-content/uploads/2024/03/Career-Guidance-1.png" alt="Service 1">
                <h3>Personalized Guidance</h3>
                <p>Explore different career paths with personalized guidance and expert advice.</p>
                <a href="select.html" class="explore-button">Explore</a>
            </div>
            <div class="service">
                <img src="https://img.freepik.com/free-photo/college-woman-library_23-2147678894.jpg" alt="Service 2">
                <h3>Resource Library</h3>
                <p>Access a wide range of resources to enhance your skills and knowledge in your field.</p>
                <a href="resourcelibrary.html" class="explore-button">Explore</a>
            </div>
            <div class="service">
                <img src="https://media.licdn.com/dms/image/v2/D4D12AQGzMac8oVfuXw/article-cover_image-shrink_720_1280/article-cover_image-shrink_720_1280/0/1706762567258?e=1736985600&v=beta&t=rMMIDE4cSb2JICEscycM7QdzTNcqSiW4WrXdjUbSVeE">
                <h3>Mentorship</h3>
                <p>Connect with mentors to gain real-world insights and grow your skills.</p>
                <a href="mentorship.html" class="explore-button">Explore</a>
            </div>
            <div class="service">
                <img src="https://www.shutterstock.com/image-photo/community-support-connection-togetherness-society-260nw-392406010.jpg" alt="Service 3">
                <h3>Community Support</h3>
                <p>Connect with like-minded individuals, mentors, and industry experts for guidance.</p>
                <a href="#career-counseling" class="explore-button">Explore</a>
            </div>
        </div>
    </section>
    <div class="content">
        <!-- notification message -->
        <?php if (isset($_SESSION['success'])) : ?>
        <div class="error success">
            <h3>
                <?php 
                echo $_SESSION['success']; 
                unset($_SESSION['success']);
                ?>
            </h3>
        </div>
        <?php endif ?>

        <!-- logged in user information -->
        <?php if (isset($_SESSION['username'])) : ?>
        <p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
        <p> <a href="index.php?logout='1'" style="color: red;">Logout</a> </p>
        <?php endif ?>
    </div>

    <!-- Chatbot Icon -->
    <div class="chatbot-icon" onclick="toggleChatbot()">
        <img src="https://cdn-icons-png.flaticon.com/512/4712/4712027.png" alt="Chatbot Icon">
    </div>

    <!-- Chatbot Iframe -->
    <iframe
        class="chatbot-iframe"
        src="https://www.chatbase.co/chatbot-iframe/F_vrgqVJwzJ4t5tjnUjR-"
        frameborder="0"
    ></iframe>

    <footer>
        <div class="footer-content">
            <p>&copy; 2024 Career Planning. All Rights Reserved.</p>
        </div>
    </footer>

    <script>
        // Function to toggle chatbot visibility
        function toggleChatbot() {
            const iframe = document.querySelector('.chatbot-iframe');
            iframe.style.display = iframe.style.display === 'block' ? 'none' : 'block';
        }
    </script>
</body>
</html>
