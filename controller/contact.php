<?php
require_once "check_auth.php";
require_once "../config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather App - Contact</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/views/dashboard.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/views/contact.css">
</head>
<body>
    <div class="top-bar">
        <h2>Contact Us</h2>
        <?php include '../views/shared_dropdown.php'; ?>
    </div>
    <div class="main-layout">
        <div class="sidebar" id="sidebar">
            <?php include '../views/side_bar.php'?>
        </div>
        <div class="content-area">
            <div class="contact-container">
                <!-- Only Group Information Section -->
                <div class="group-info">
                    <h2>Group Information</h2>
                    <div class="member-cards">
                        <div class="member-card">
                            <img src="<?= BASE_URL ?>/assets/mayesha.jpg" alt="Member Photo" class="member-photo">
                            <div class="member-details">
                                <h3>Mayesha Nowshin Mim Chowdhury</h3>
                                <p class="student-id">Student ID: 22-46111-1</p>
                                <p class="section">Section: C</p>
                                <div class="social-links">
                                    <a href="mailto:mnnowshin217@gmail.com" class="email-link">
                                        <img src="<?= BASE_URL ?>/assets/email.png" alt="Email">
                                    </a>
                                    <a href="https://github.com/mnowshin?tab=repositories" target="_blank" class="github-link">
                                        <img src="<?= BASE_URL ?>/assets/github.png" alt="GitHub">
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="member-card">
                            <img src="<?= BASE_URL ?>/assets/profile-placeholder.png" alt="Member Photo" class="member-photo">
                            <div class="member-details">
                                <h3>Team Member Name</h3>
                                <p class="student-id">Student ID: XX-XXXXX-X</p>
                                <p class="section">Section: X</p>
                                <div class="social-links">
                                    <a href="mailto:email@example.com" class="email-link">
                                        <img src="<?= BASE_URL ?>/assets/email.png" alt="Email">
                                    </a>
                                    <a href="https://github.com" target="_blank" class="github-link">
                                        <img src="<?= BASE_URL ?>/assets/github.png" alt="GitHub">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer">
        <p>Powered by webTec_Project_aiub</p>
    </footer>
    <script src="<?= BASE_URL ?>/views/dashboard.js"></script>
    <script src="<?= BASE_URL ?>/views/contact.js"></script>
</body>
</html>
