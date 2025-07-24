<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'student') {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['internship_id'])) {
    $internship_id = intval($_POST['internship_id']);
    $user_id = $_SESSION['user']['id'];
    $resume_filename = null;

    // Pastikan folder uploads wujud
    if (!is_dir('uploads')) {
        mkdir('uploads', 0777, true);
    }

    // ✅ Semak jika fail dimuat naik
    if (isset($_FILES['resume']) && $_FILES['resume']['error'] == 0) {
        $allowed_ext = ['pdf'];
        $file_name = $_FILES['resume']['name'];
        $file_tmp = $_FILES['resume']['tmp_name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        if (in_array($file_ext, $allowed_ext)) {
            $resume_filename = 'resume_' . $user_id . '_' . time() . '.' . $file_ext;
            if (!move_uploaded_file($file_tmp, 'uploads/' . $resume_filename)) {
                $_SESSION['message'] = "Failed to upload the file.";
                header("Location: dashboard_student.php");
                exit();
            }
        } else {
            $_SESSION['message'] = "File is only accept in PDF.";
            header("Location: dashboard_student.php");
            exit();
        }
    } else {
        $_SESSION['message'] = "Please upload the file in PDF first.";
        header("Location: dashboard_student.php");
        exit();
    }

    // ❗ Semak jika pelajar sudah memohon
    $stmt = $conn->prepare("SELECT * FROM bookings WHERE user_id = ? AND internship_id = ?");
    $stmt->bind_param("ii", $user_id, $internship_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        // ✅ Simpan permohonan
        $stmt = $conn->prepare("INSERT INTO bookings (user_id, internship_id, status, internship_date, resume) VALUES (?, ?, 'pending', NOW(), ?)");
        $stmt->bind_param("iis", $user_id, $internship_id, $resume_filename);
        if ($stmt->execute()) {
            $_SESSION['message'] = "Application already sent.";
        } else {
            $_SESSION['message'] = "Ralat semasa menyimpan data.";
        }
    } else {
        $_SESSION['message'] = "Anda telah memohon tempat ini.";
    }
}

header("Location: dashboard_student.php");
exit();
