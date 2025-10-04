<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Hotel Booking - Home</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f5f6fa;
      margin: 0;
      padding: 0;
    }
    /* Navigation Bar Styles */
    .navbar {
      background: #0984e3;
      padding: 0 30px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      height: 60px;
      box-shadow: 1px 2px 8px rgba(0,0,0,0.5);
      text-decoration: none;
    }
    .navbar .logo {
      color: #fff;
      font-size: 1.5em;
      font-weight: bold;
      letter-spacing: 1px;
      text-decoration: none;
      margin-right: 40px;
    }
    .navbar-links {
      display: flex;
      gap: 25px;
    }
    .navbar-links a {
      color: #fff;
      text-decoration: none;
      font-size: 1em;
      padding: 8px 14px;
      border-radius: 4px;
    }
    .navbar-links a:hover {
      background: #74b9ff;
      color: #2d3436;
    }
    center {
      margin-top: 60px;
    }
    h1 {
      color: #2d3436;
      margin-bottom: 10px;
    }
    p {
      color: #636e72;
      font-size: 1.2em;
      margin-bottom: 40px;
    }

    /* --- CSS FOR PROFILE SECTION --- */
    .profile-container {
        position: relative;
        display: inline-block;
    }
    .profile-icon {
        cursor: pointer;
        font-size: 24px;
        color: white;
    }
    .profile-dropdown {
        display: none;
        position: absolute;
        right: 0;
        background-color: white;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
        border-radius: 5px;
        padding: 12px 16px;
        color: #333;
    }
    .profile-dropdown a {
        color: black;
        padding: 8px 0;
        text-decoration: none;
        display: block;
    }
    .profile-dropdown a:hover {
        background-color: #f1f1f1;
    }
    
    /* --- CSS FOR MULTI-ITEM IMAGE SLIDER --- */
    .slider-container {
        width: 90%;
        max-width: 1200px;
        margin: auto;
        overflow: hidden;
        position: relative;
    }
    .slider-wrapper {
        display: flex;
        gap: 15px;
        transition: transform 0.5s ease-in-out;
    }
    .slider-wrapper img {
        flex: 0 0 calc((100% / 3) - 10px);
        width: calc((100% / 3) - 10px);
        aspect-ratio: 16 / 10;
        object-fit: cover;
        border-radius: 8px;
    }
    .slider-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background-color: rgba(255, 255, 255, 0.7);
        border: none;
        border-radius: 50%;
        cursor: pointer;
        width: 40px;
        height: 40px;
        font-size: 24px;
        font-weight: bold;
        color: #2d3436;
        z-index: 10;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        transition: background-color 0.3s;
        padding-bottom: 4px;
    }
    .slider-btn:hover {
        background-color: #fff;
    }
    #prev-btn { left: 15px; }
    #next-btn { right: 15px; }
    .navbar-links a.admin-link { background-color: #d35400; }
    .navbar-links a.admin-link:hover { background-color: #e67e22; }
  </style>
</head>
<body>
  <nav class="navbar">
    <a href="index.php" class="logo">Hotel Booking</a>
    <div class="navbar-links">
      <a href="hotels.html">View Hotels</a>
      <a href="location.html">Find Hotels by City</a>
      <a href="booking.html">Book a Room</a>
      <!-- MODIFIED: Link to user_offers.php -->
      <a href="user_offers.php">Offers</a>
      <a href="byplace.html">Near Tourist Place</a>
      <a href="hotel-360.html">View hotel in 360°</a>
      <a href="aboutUS.html">About Us</a>
      <a href="FAQs.html">FAQs</a>
      
      <!-- NEW: Admin-only link to manage offers -->
      <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
        <a href="manage_offers.php" class="admin-link">Manage Offers</a>
        <a href="manage_users.php" class="admin-link">Manage Users</a>
      <?php endif; ?>
    </div>
    <div class="profile-section">
        <?php if (isset($_SESSION['user'])): ?>
            <div class="profile-container">
                <span class="profile-icon" onclick="toggleDropdown()">👤</span>
                <div class="profile-dropdown" id="profileDropdown">
                    <p id="username">Loading...</p>
                    <!-- --- NEW: Link to the profile page --- -->
                    <a href="profile.php">My Profile</a>
                    <a href="logout.php">Logout</a>
                </div>
            </div>
        <?php else: ?>
            <a href="SingUp.php" style="color: white; text-decoration: none;">Sign Up</a>
        <?php endif; ?>
    </div>
  </nav>

  <center>
    <h1>Welcome to Hotel Booking Website</h1>
    <p>Find and book your perfect stay!</p>
    
    <div class="slider-container">
        <div class="slider-wrapper">
             <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MnwzNjUyOXwwfDF8c2VhcmNofDN8fGhvdGVsfGVufDB8fHx8MTY3OTg2OTYyOQ&ixlib=rb-4.0.3&q=80&w=1080" alt="Luxury Hotel Pool">
            <img src="https://images.unsplash.com/photo-1582719508461-905c673771fd?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MnwzNjUyOXwwfDF8c2VhcmNofDEwfHxob3RlbHxlbnwwfHx8fDE2Nzk4Njk2Mjk&ixlib=rb-4.0.3&q=80&w=1080" alt="Hotel Bedroom">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSCOBIqkOz82-lNlRZ87DbGf842my51StiODg&s" alt="Hotel Exterior">
            <img src="https://images.unsplash.com/photo-1618773928121-c32242e63f39?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MnwzNjUyOXwwfDF8c2VhcmNofDEyfHxob3RlbHxlbnwwfHx8fDE2Nzk4Njk2Mjk&ixlib=rb-4.0.3&q=80&w=1080" alt="Modern Hotel Room">
            <img src="https://images.unsplash.com/photo-1596436889106-be35e843f974?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MnwzNjUyOXwwfDF8c2VhcmNofDE3fHxob3RlbHxlbnwwfHx8fDE2Nzk4Njk2Mjk&ixlib=rb-4.0.3&q=80&w=1080" alt="Hotel Resort Pool Area">
            <img src="https://images.unsplash.com/photo-1571896349842-33c89424de2d?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MnwzNjUyOXwwfDF8c2VhcmNofDR8fGhvdGVsfGVufDB8fHx8MTY3OTg2OTYyOQ&ixlib=rb-4.0.3&q=80&w=1080" alt="Hotel with Pool">
            <img src="https://assets.minorhotels.com/image/upload/q_auto,f_auto,c_limit,w_1045/media/minor/anantara/images/anantara-jewel-bagh-jaipur-hotel/mhg/01_hotel-teaser/anantara_jewel-bagh_jaipur_hotel_teaser_01_880x620.jpg" alt="Hotel Lobby">
            <img src="https://3.imimg.com/data3/JV/KJ/MY-15827078/hotels-booking.jpg" alt="Hotel Restaurant">
        </div>
        <button id="prev-btn" class="slider-btn">&lt;</button>
        <button id="next-btn" class="slider-btn">&gt;</button>
    </div>
  </center>

  <script>
    // --- Profile Dropdown Logic ---
    function toggleDropdown() {
        var dropdown = document.getElementById("profileDropdown");
        if (dropdown.style.display === "block") {
            dropdown.style.display = "none";
        } else {
            dropdown.style.display = "block";
            fetchUsername();
        }
    }

    function fetchUsername() {
        fetch('get_username.php')
            .then(response => response.json())
            .then(data => {
                if (data.username) {
                    document.getElementById('username').innerText = 'Hi, ' + data.username;
                } else {
                    document.getElementById('username').innerText = 'Could not find username.';
                }
            })
            .catch(error => {
                console.error('Error fetching username:', error);
                document.getElementById('username').innerText = 'Error loading username.';
            });
    }

    // --- Image Slider Logic ---
    const sliderWrapper = document.querySelector('.slider-wrapper');
    const slides = document.querySelectorAll('.slider-wrapper img');
    const prevBtn = document.getElementById('prev-btn');
    const nextBtn = document.getElementById('next-btn');
    
    const itemsPerPage = 3; 
    let currentIndex = 0;
    let slideInterval;

    function updateSlider() {
        if (!slides.length) return; // Prevent error if no slides
        const firstSlide = slides[0];
        const gap = parseInt(window.getComputedStyle(sliderWrapper).gap) || 0;
        const slideMoveDistance = firstSlide.offsetWidth + gap;
        sliderWrapper.style.transform = `translateX(-${currentIndex * slideMoveDistance}px)`;
    }

    function moveToNextSlide() {
        currentIndex++;
        if (currentIndex > slides.length - itemsPerPage) {
            currentIndex = 0;
        }
        updateSlider();
    }

    function moveToPrevSlide() {
        currentIndex--;
        if (currentIndex < 0) {
            currentIndex = slides.length - itemsPerPage;
        }
        updateSlider();
    }

    function startSliderInterval() {
        clearInterval(slideInterval);
        slideInterval = setInterval(moveToNextSlide, 3000);
    }
    
    if (slides.length > itemsPerPage) {
        nextBtn.addEventListener('click', () => {
            moveToNextSlide();
            startSliderInterval();
        });

        prevBtn.addEventListener('click', () => {
            moveToPrevSlide();
            startSliderInterval();
        });
        
        window.addEventListener('resize', updateSlider);
        startSliderInterval();
    } else {
        prevBtn.style.display = 'none';
        nextBtn.style.display = 'none';
    }
  </script>
</body>
</html>

