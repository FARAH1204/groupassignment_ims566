<?php
session_start();
require 'db.php';

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $student_id = $_POST['student_id'];
    $email = $_POST['email'];
    $course = $_POST['course'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Insert ke dalam DB
    $sql = "INSERT INTO users (name, student_id, email, password, role) 
            VALUES (?, ?, ?, ?, 'student')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("siss", $name, $student_id, $email, $password);

    if ($stmt->execute()) {
        $message = "Register successfully. Please login.";
    } else {
        $message = "Ralat: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>InternMatch | Register</title>
    <style>
        body {
            font-family: Arial;
            background-color: #f4f4f4;
            padding: 40px;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border: 2px solid #400D54;
            border-radius: 10px;
            max-width: 400px;
            margin: auto;
        }
        input, select {
            display: block;
            width: 90%;
            padding: 10px;
            margin-top: 10px;
        }
        button {
            background-color: #400D54;
            color: #fff;
            padding: 10px;
            border: none;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <h2 style="text-align:center;color:#400D54;">InternMatch</h2>
    <form method="post" action="">
        <h3 style="color:#FFB700;">Register as Student</h3>
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="text" name="student_id" placeholder="Student ID" required>
        <input type="email" name="email" placeholder="Email UiTM" required>
        <select name="course" required>
            <option value="">-- Choose your Course --</option>
            <option value="Diploma Sains Komputer">Diploma Sains Komputer</option>
            <option value="Diploma Pengurusan Maklumat">Diploma Pengurusan Maklumat</option>
            <option value="Diploma Perakaunan">Diploma Perakaunan</option>
            <!-- Tambah lagi jika perlu -->
        </select>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Register</button>
        <p style="color:green;"><?php echo $message; ?></p>
        <p>Already have account? <a href="login.php">Login here</a></p>
    </form>
</body>
</html>
