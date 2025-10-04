<?php
session_start();
require 'db_connect.php';
include 'check_login.php'; // Ensures user is logged in

// Fetch active offers
$stmt = $pdo->query("SELECT * FROM offers WHERE status = 'active' ORDER BY id DESC");
$offers = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Special Offers</title>
  <style>
    body { margin: 0; font-family: 'Segoe UI', sans-serif; background-color: #f4f4f4; }
    .header { background-color: #0066cc; color: white; text-align: center; padding: 25px 0; font-size: 30px; font-weight: bold; }
    .offer-container { display: flex; flex-wrap: wrap; justify-content: center; gap: 20px; padding: 30px; }
    .offer-card { background-color: #fff; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); overflow: hidden; width: 320px; transition: transform 0.3s ease; }
    .offer-card:hover { transform: scale(1.03); }
    .offer-info { padding: 20px; }
    .offer-name { font-size: 22px; font-weight: bold; color: #333; margin-bottom: 8px; }
    .offer-description { color: #666; margin-bottom: 12px; }
    .offer-discount { font-size: 24px; color: #d32f2f; font-weight: bold; margin-bottom: 10px; }
    .book-button { display: inline-block; margin-top: 12px; padding: 10px 20px; background-color: #ff6f00; color: white; border: none; border-radius: 5px; text-decoration: none; font-weight: bold; }
    .book-button:hover { background-color: #e65100; }
    .no-offers { text-align: center; font-size: 1.2em; color: #666; }
    .home-link { display: block; text-align: center; margin-top: 20px; }
  </style>
</head>
<body>
  <div class="header">🏨 Hot Hotel Deals Just for You!</div>
  <div class="offer-container">
    <?php if ($offers): ?>
        <?php foreach ($offers as $offer): ?>
            <div class="offer-card">
                <div class="offer-info">
                    <div class="offer-name"><?php echo htmlspecialchars($offer['offerName']); ?></div>
                    <div class="offer-discount"><?php echo htmlspecialchars($offer['discountPercent']); ?>% OFF</div>
                    <p class="offer-description"><?php echo htmlspecialchars($offer['offerDescription']); ?></p>
                    <a href="booking.html" class="book-button">Book Now</a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="no-offers">No special offers are available at the moment. Please check back later!</p>
    <?php endif; ?>
  </div>
  <a href="index.php" class="home-link">Back to Home</a>
</body>
</html>
