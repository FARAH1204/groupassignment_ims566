<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'student') {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['user'];

// Ambil semua internship
$internships = [];
$sql = "SELECT * FROM internships ORDER BY date_posted DESC";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    $internships = $result->fetch_all(MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Pelajar | InternMatch</title>
    <style>
        body {
            font-family: Arial;
            background-color: #f4f4f4;
            padding: 30px;
        }
        .container {
            max-width: 900px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 12px;
            border: 3px solid #400D54;
        }
        h2 {
            color: #400D54;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        table th, table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        table th {
            background-color: #400D54;
            color: white;
        }
        table td {
            background-color: #fafafa;
        }
        .btn {
            padding: 6px 12px;
            background-color: #FFB700;
            border: none;
            color: #400D54;
            cursor: pointer;
            border-radius: 4px;
        }
        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logout {
            background-color: #400D54;
            color: white;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 6px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="topbar">
        <h2>Welcome, <?php echo strtoupper($user['name']); ?></h2>
        <a class="logout" href="logout.php">Logout</a>
    </div>

    <h3 style="color:#FFB700;">Your Notification</h3>
    <ul style="padding-left: 20px;">
    <?php
    $sql = "SELECT message, date_sent FROM notifications WHERE user_id = ? ORDER BY date_sent DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user['id']);
    $stmt->execute();
    if ($stmt->execute()) {
    $_SESSION['message'] = "Your Application already sent!.";
} else {
    $_SESSION['message'] = "Ralat semasa menyimpan data: " . $stmt->error;
}
    $result = $stmt->get_result();

    if ($result->num_rows > 0):
        while ($row = $result->fetch_assoc()):
    ?>
        <li><?php echo htmlspecialchars($row['message']); ?> 
        <small style="color:gray;">(<?php echo $row['date_sent']; ?>)</small></li>
    <?php
        endwhile;
    else:
        echo "<li>There is no notification yet.</li>";
    endif;
    ?>
    </ul>

    <!-- STATUS OF APPLICATION DI ATAS -->
    <h3 style="color:#FFB700; margin-top:30px;">Status of Your Application</h3>
    
    <?php
    $sql = "SELECT i.company_name, i.position, b.status, b.internship_date 
            FROM bookings b
            JOIN internships i ON b.internship_id = i.id
            WHERE b.user_id = ? ORDER BY b.id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user['id']);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0): ?>
    
    <?php else: ?>
        <p>You not apply for internship yet.</p>
    <?php endif; ?>

    <!-- SENARAI INTERNSHIP DI BAWAH -->
    <h3 style="color:#FFB700; margin-top:30px;">List of Internship</h3>
    <?php if (count($internships) > 0): ?>
    <table>
        <tr>
            <th>Company name</th>
            <th>Position</th>
            <th>Location</th>
            <th>Date Posted</th>
            <th>Action</th>
        </tr>
        <?php foreach ($internships as $intern): ?>
        <tr>
            <td><?= htmlspecialchars($intern['company_name']) ?></td>
            <td><?= htmlspecialchars($intern['position']) ?></td>
            <td><?= htmlspecialchars($intern['location']) ?></td>
            <td><?= htmlspecialchars($intern['date_posted']) ?></td>
            <td>
                <form method="post" action="bookings.php" enctype="multipart/form-data">
                    <input type="hidden" name="internship_id" value="<?= $intern['id']; ?>">
                    <input type="file" name="resume" accept="application/pdf" required>
                    <button type="submit" class="btn">Apply</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php else: ?>
        <p>There is no place for internship for now.</p>
    <?php endif; ?>

    <?php
    if (isset($_SESSION['message'])) {
        echo '<p style="color:green;">' . $_SESSION['message'] . '</p>';
        unset($_SESSION['message']);
    }
    ?>
</div>
</body>
</html>
