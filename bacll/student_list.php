<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "login.php";</script>';
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student List - CRUD</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #2563eb; color: white; }
        .btn { padding: 6px 12px; text-decoration: none; border-radius: 4px; color: white; display: inline-block; }
        .btn-add { background: #10b981; margin-bottom: 10px; }
        .btn-edit { background: #f59e0b; font-size: 12px; }
        .btn-delete { background: #ef4444; font-size: 12px; }
    </style>
</head>
<body>

    <h2>Student Information Management (Bacll System)</h2>
    <a href="student_add.php" class="btn btn-add">+ Add New Student</a>
    <a href="dashboard.php" class="btn" style="background:#6b7280;">Back to Dashboard</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Track</th>
            <th>Actions</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id']; ?></td>
            <td><?= htmlspecialchars($row['name']); ?></td>
            <td><?= htmlspecialchars($row['email']); ?></td>
            <td><?= htmlspecialchars($row['track']); ?></td>
            <td>
                <a href="student_edit.php?id=<?= $row['id']; ?>" class="btn btn-edit">Edit</a>
                <a href="student_list.php?delete=<?= $row['id']; ?>" class="btn btn-delete" onclick="return confirm('តើអ្នកពិតជាចង់លុបមែនទេ?')">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

</body>
</html>


