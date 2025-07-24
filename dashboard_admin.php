<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard | InternMatch</title>
    <style>
        body {
            font-family: Arial;
            background-color: #f4f4f4;
            padding: 30px;
        }
        .container {
            max-width: 1000px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 12px;
            border: 3px solid #400D54;
        }
        h2, h3 {
            color: #400D54;
        }
        table {
            width: 90%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        table th, table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        table th {
            background-color: #400D54;
            color: white;
        }
        .btn {
            padding: 5px 10px;
            margin: 2px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .approve {
            background-color: #4CAF50;
            color: white;
        }
        .reject {
            background-color: #f44336;
            color: white;
        }
        .logout {
            float: right;
            background-color: #400D54;
            color: white;
            padding: 6px 12px;
            text-decoration: none;
            border-radius: 6px;
        }
        .internship-form {
            margin-top: 50px;
            padding: 20px;
            background-color: #fdfdfd;
            border: 2px solid #FFB700;
            border-radius: 10px;
        }
        .internship-form input {
            width: 95%;
            padding: 10px;
            margin-top: 8px;
        }
        .internship-form button {
            margin-top: 12px;
            padding: 10px;
            background-color: #400D54;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Welcome, <?php echo htmlspecialchars($user['name']); ?> 
        <a class="logout" href="logout.php">Logout</a>
    </h2>

    <h3>Applications Received</h3>

    <?php
    $sql = "SELECT b.id AS booking_id, u.name AS student_name, u.email, i.company_name, i.position, b.status, b.internship_date, b.resume
            FROM bookings b
            JOIN users u ON b.user_id = u.id
            JOIN internships i ON b.internship_id = i.id
            ORDER BY b.internship_date DESC";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0): ?>
        <table>
            <tr>
                <th>Student Name</th>
                <th>Email</th>
                <th>Company</th>
                <th>Position</th>
                <th>Date Applied</th>
                <th>Resume</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['student_name']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= htmlspecialchars($row['company_name']) ?></td>
                    <td><?= htmlspecialchars($row['position']) ?></td>
                    <td><?= htmlspecialchars($row['internship_date']) ?></td>
                    <td>
                        <?php if ($row['resume']): ?>
                            <a href="uploads/<?= htmlspecialchars($row['resume']) ?>" target="_blank">View</a>
                        <?php else: ?>
                            No File
                        <?php endif; ?>
                    </td>
                    <td><?= ucfirst($row['status']) ?></td>
                    <td>
                        <?php if ($row['status'] == 'pending'): ?>
                        <form method="post" action="update_status.php" style="display:inline;">
                            <input type="hidden" name="booking_id" value="<?= $row['booking_id'] ?>">
                            <button type="submit" name="action" value="approve" class="btn approve">Approve</button>
                        </form>
                        <form method="post" action="update_status.php" style="display:inline;">
                            <input type="hidden" name="booking_id" value="<?= $row['booking_id'] ?>">
                            <button type="submit" name="action" value="reject" class="btn reject">Reject</button>
                        </form>
                        <?php else: ?>
                            No Action
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No applications have been received yet.</p>
    <?php endif; ?>

    <!-- Borang Tambah Tempat Internship -->
    <div class="internship-form">
        <h3>Add New Internship Placement</h3>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_internship'])) {
            $company_name = $_POST['company_name'];
            $position = $_POST['position'];
            $location = $_POST['location'];

            $stmt = $conn->prepare("INSERT INTO internships (company_name, position, location) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $company_name, $position, $location);

            if ($stmt->execute()) {
                echo '<p style="color: green;">Internship placement added successfully!</p>';
            } else {
                echo '<p style="color: red;">Error: ' . $stmt->error . '</p>';
            }
        }
        ?>

        <form method="post" action="">
            <input type="hidden" name="add_internship" value="1">
            <label>Company Name:</label>
            <input type="text" name="company_name" required>

            <label>Position:</label>
            <input type="text" name="position" required>

            <label>Location:</label>
            <input type="text" name="location" required>

            <button type="submit">Add Internship</button>
        </form>
    </div>
</div>
</body>
</html>
