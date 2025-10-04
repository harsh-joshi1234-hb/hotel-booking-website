<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize input (same as before)
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $hotel = filter_input(INPUT_POST, 'hotel', FILTER_SANITIZE_STRING);
    $checkin = filter_input(INPUT_POST, 'checkin', FILTER_SANITIZE_STRING);
    $checkout = filter_input(INPUT_POST, 'checkout', FILTER_SANITIZE_STRING);

    // Format the data (same as before)
    $booking_data = "Name: $name\n";
    $booking_data .= "Email: $email\n";
    $booking_data .= "Hotel: $hotel\n";
    $booking_data .= "Check-in: $checkin\n";
    $booking_data .= "Check-out: $checkout\n";
    $booking_data .= "------------------------\n";

    $file = 'bookings.txt';

    // --- NEW: Check if the file is writable ---
    if (is_writable($file)) {
        // If the file is writable, save the data.
        file_put_contents($file, $booking_data, FILE_APPEND | LOCK_EX);

        // Redirect to the confirmation page.
        header('Location: confirm.html');
        exit();
    } else {
        // --- NEW: Display a helpful error message ---
        // If the file is not writable, stop and show an error.
        die("Error: The file 'bookings.txt' is not writable. Please check the file permissions on your server.");
    }

} else {
    header('Location: booking.html');
    exit();
}
?>