<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'student') {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user']['id'];
$internship_id = $_POST['internship_id'];

if (isset($_FILES['resume']) && $_FILES['resume']['type'] == "application/pdf") {
    $resumePath = "uploads/resume_" . $user_id . ".pdf";
    move_uploaded_file($_FILES['resume']['tmp_name'], $resumePath);

    // Simpan permohonan
    $stmt = $conn->prepare("INSERT INTO bookings (user_id, internship_id, internship_date, status) VALUES (?, ?, NOW(), 'pending')");
    $stmt->bind_param("ii", $user_id, $internship_id);
    $stmt->execute();

    // Hantar notifikasi
    $msg = "Your Application is already sent! Status: Pending.";
    $stmt2 = $conn->prepare("INSERT INTO notifications (user_id, message) VALUES (?, ?)");
    $stmt2->bind_param("is", $user_id, $msg);
    $stmt2->execute();
}

header("Location: dashboard_student.php");
exit();
