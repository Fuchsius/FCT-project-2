<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName     = $_POST['first_name'] ?? '';
    $lastName      = $_POST['last_name'] ?? '';
    $email         = $_POST['email'] ?? '';
    $phone         = $_POST['phone'] ?? '';
    $startDay      = $_POST['start_day'] ?? '';
    $startMonth    = $_POST['start_month'] ?? '';
    $startYear     = $_POST['start_year'] ?? '';
    $duration      = $_POST['duration'] ?? '';
    $destination   = $_POST['destination'] ?? '';
    $insurance     = isset($_POST['insurance']) ? 1 : 0;
    $agree         = isset($_POST['agree']) ? 1 : 0;

    if (!$agree) {
        die("You must agree to the terms & conditions.");
    }

    $startDate = "$startYear-$startMonth-$startDay";

    $stmt = $pdo->prepare("
        INSERT INTO bookings (first_name, last_name, email, phone, start_date, duration, destination,insurance)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)
    ");

    try {
        $stmt->execute([$firstName, $lastName, $email, $phone, $startDate, $duration, $destination,$insurance]);
        echo "Booking successful!";
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
