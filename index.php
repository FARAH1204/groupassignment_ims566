<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>InternMatch | Internship Registration</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #400D54, #FFB700);
            height: 100vh;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            background-color: #fff;
            color: #400D54;
            text-align: center;
            padding: 50px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.3);
            width: 90%;
            max-width: 600px;
        }
        h1 {
            margin-bottom: 10px;
            font-size: 32px;
        }
        p {
            font-size: 18px;
            margin-bottom: 30px;
        }
        .btn {
            display: inline-block;
            padding: 12px 24px;
            margin: 10px;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }
        .btn-login {
            background-color: #400D54;
            color: #fff;
        }
        .btn-register {
            background-color: #FFB700;
            color: #400D54;
        }
        .btn:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Welcome to InternMatch | Internship Registration</h1>
    <p>Internship Registration for UiTM Students</p>
    <a href="login.php" class="btn btn-login">Login</a>
    <a href="register.php" class="btn btn-register">Register</a>
</div>

</body>
</html>
