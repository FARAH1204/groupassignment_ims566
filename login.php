<?php
session_start();
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (md5($password) === $user['password']) {
            $_SESSION['user'] = $user;

            if ($user['role'] === 'admin') {
                header("Location: dashboard_admin.php");
            } else {
                header("Location: dashboard_student.php");
            }
            exit();
        } else {
            $error = "Wrong password.";
        }
    } else {
        $error = "Email is not found";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - InternMatch</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #400D54, #73259c);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .login-box {
            background-color: #fff;
            color: #400D54;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 400px;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #400D54;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 8px 0 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #FFB700;
            color: #400D54;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        button:hover {
            background-color: #e5a600;
        }

        .error {
            color: red;
            text-align: center;
            margin-bottom: 15px;
        }

        .footer {
            text-align: center;
            font-size: 13px;
            margin-top: 20px;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>InternMatch Login</h2>

        <?php if (isset($error)) echo "<div class='error'>$error</div>"; ?>

        <form method="POST" action="login.php">
            <label for="email">Email</label><br>
            <input type="email" name="email" required>

            <label for="password">Password</label><br>
            <input type="password" name="password" required>

            <button type="submit">Login</button>
            <a href="index.php" style="display: block; text-align: center; margin-top: 15px; color: #400D54;">Home</a>
        </form>

        <div class="footer">
            © 2025 InternMatch
        </div>
    </div>
</body>
</html>
