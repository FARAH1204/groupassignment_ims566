<?php
session_start();
require 'db.php';
require 'mailgun_function.php'; // Untuk hantar emel

// Pastikan hanya admin boleh akses
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$booking_id = $_POST['booking_id'] ?? null;
$action = $_POST['action'] ?? null;

if ($booking_id && in_array($action, ['approve', 'reject'])) {
    // 1. Dapatkan user_id dan maklumat pelajar
    $stmt = $conn->prepare("SELECT users.id AS user_id, users.email, users.name 
                            FROM bookings 
                            JOIN users ON bookings.user_id = users.id 
                            WHERE bookings.id = ?");
    $stmt->bind_param("i", $booking_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $booking = $result->fetch_assoc();

    if ($booking) {
        $user_id = $booking['user_id'];
        $student_email = $booking['email'];
        $student_name = $booking['name'];

        // 2. Kemas kini status
        $stmt = $conn->prepare("UPDATE bookings SET status = ? WHERE id = ?");
        $stmt->bind_param("si", $action, $booking_id);
        $stmt->execute();

        // 3. Simpan notifikasi dalam DB
        $msg = "Your application is " . ($action == 'approve' ? "approved 🎉" : "rejected ❌") . ".";
        $stmt = $conn->prepare("INSERT INTO notifications (user_id, message) VALUES (?, ?)");
        $stmt->bind_param("is", $user_id, $msg);
        $stmt->execute();

        // 4. Hantar emel melalui Mailgun
        $subject = "Internship Application " . ucfirst($action);
        $message = "<p>Hi $student_name,</p>
                    <p>Your internship application has been <strong>" . strtoupper($action) . "</strong>.</p>
                    <p>Thank you,<br>InternMatch UiTM Team</p>";
        sendMailgunEmail($student_email, $subject, $message);
    }
}

header("Location: dashboard_admin.php");
exit();
?>
