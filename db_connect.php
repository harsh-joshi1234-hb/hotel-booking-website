<?php
// --- DATABASE CONNECTION ---
$host = 'localhost'; // Or your database host
$dbname = 'hotel_booking'; // Your database name
$user = 'root'; // Your database username
$pass = ''; // Your database password
$charset = 'utf8mb4';

// --- Data Source Name (DSN) ---
$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

// --- Connection Options ---
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Key for error handling
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    // --- Establish the connection ---
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    // --- Secure Error Handling ---
    // In a production environment, you would log this error instead of displaying it
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>