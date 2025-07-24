<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'student') {
    header("Location: login.php");
    exit();
}

$internship_id = $_POST['internship_id'] ?? null;
$user = $_SESSION['user'];

if (!$internship_id) {
    header("Location: dashboard_student.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Apply Internship</title>
    <style>
        body { font-family: Arial; padding: 30px; background-color: #f9f9f9; }
        form {
            background-color: #fff; padding: 20px; max-width: 600px; margin: auto;
            border-radius: 10px; border: 2px solid #400D54;
        }
        input, textarea { width: 100%; padding: 10px; margin-top: 10px; }
        button { background-color: #400D54; color: white; padding: 10px; border: none; margin-top: 15px; }
    </style>
</head>
<body>

<form method="post" action="submit_application.php" enctype="multipart/form-data">
    <h3 style="color:#400D54;">Permohonan Internship</h3>
    <input type="hidden" name="internship_id" value="<?= $internship_id ?>">
    <label>Nama:</label>
    <input type="text" value="<?= htmlspecialchars($user['name']) ?>" readonly>

    <label>Email:</label>
    <input type="email" value="<?= htmlspecialchars($user['email']) ?>" readonly>

    <label>Muat Naik Resume (PDF):</label>
    <input type="file" name="resume" accept=".pdf" required>

    <button type="submit">Hantar Permohonan</button>
</form>

</body>
</html>
