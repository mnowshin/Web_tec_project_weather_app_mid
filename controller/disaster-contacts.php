<?php
require_once "check_auth.php";
require_once "../config.php";
require_once "../model/emergency_model.php";

$categories = get_contact_categories();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emergency Contacts - Weather App</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/views/dashboard.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/views/disaster-contacts.css">
</head>
<body>
    <div class="top-bar">
        <h2>Emergency & Disaster Management Contacts</h2>
        <?php include '../views/shared_dropdown.php'; ?>
    </div>
    <div class="main-layout">
        <div class="sidebar" id="sidebar">
            <?php include '../views/side_bar.php'?>
        </div>
        <div class="content-area">
            <div class="dashboard-container">
                <div class="export-button-container">
                    <a href="<?= BASE_URL ?>/export/export-contacts.php" class="export-btn">
                        <img src="<?= BASE_URL ?>/assets/Export.png" alt="Export"> Export
                    </a>
                </div>
                <div class="emergency-contacts">
                    <?php 
                    while ($category = $categories->fetch_assoc()): 
                        $contacts = get_emergency_contacts_by_category($category['category']);
                    ?>
                        <div class="contact-section">
                            <h3><?= htmlspecialchars($category['category']) ?></h3>
                            <div class="contact-grid">
                                <?php while ($contact = $contacts->fetch_assoc()): ?>
                                    <div class="contact-card <?= strtolower(str_replace(' ', '-', $category['category'])) ?>">
                                        <h4><?= htmlspecialchars($contact['organization']) ?></h4>
                                        <?php if ($contact['contact_name']): ?>
                                            <p>👤 <?= htmlspecialchars($contact['contact_name']) ?></p>
                                        <?php endif; ?>
                                        
                                        <?php if ($contact['phone1']): ?>
                                            <p>📞 <?= htmlspecialchars($contact['phone1']) ?></p>
                                        <?php endif; ?>
                                        
                                        <?php if ($contact['phone2']): ?>
                                            <p>📱 <?= htmlspecialchars($contact['phone2']) ?></p>
                                        <?php endif; ?>
                                        
                                        <?php if ($contact['email']): ?>
                                            <p>📧 <?= htmlspecialchars($contact['email']) ?></p>
                                        <?php endif; ?>
                                        
                                        <?php if ($contact['website']): ?>
                                            <p>🌐 <?= htmlspecialchars($contact['website']) ?></p>
                                        <?php endif; ?>
                                        
                                        <?php if ($contact['location']): ?>
                                            <p>📍 <?= htmlspecialchars($contact['location']) ?></p>
                                        <?php endif; ?>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer">
        <p>Powered by webTec_Project_aiub</p>
    </footer>
    <script src="<?= BASE_URL ?>/views/dashboard.js"></script>
</body>
</html>
