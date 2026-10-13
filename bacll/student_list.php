<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "login.php";</script>';
    exit();
}

// បង្កើត Session សម្រាប់ເກັບបញ្ជីសិស្ស Demo ពេលគ្មាន Database
if (!isset($_SESSION['demo_students'])) {
    $_SESSION['demo_students'] = [
        ['id' => 1, 'name' => 'Nary Pon', 'email' => 'nary@example.com', 'track' => 'Science Class Track'],
        ['id' => 2, 'name' => 'Dara Chan', 'email' => 'dara@example.com', 'track' => 'Social Class Track']
    ];
}

// មុខងារលុបសិស្ស (Delete)
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    if ($conn) {
        $stmt = $conn->prepare("DELETE FROM students WHERE id = ?");
        $stmt->bind_param("i", $delete_id);
        $stmt->execute();
        $stmt->close();
    } else {
        // លុបចេញពី Session Demo វិញ
        foreach ($_SESSION['demo_students'] as $key => $student) {
            if ($student['id'] == $delete_id) {
                unset($_SESSION['demo_students'][$key]);
            }
        }
        $_SESSION['demo_students'] = array_values($_SESSION['demo_students']);
    }
    echo '<script>window.location.href = "student_list.php";</script>';
    exit();
}

$students = [];
if ($conn) {
    $result = $conn->query("SELECT * FROM students");
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $students[] = $row;
        }
    }
} else {
    $students = $_SESSION['demo_students'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student List - CRUD</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; background-color: #f9fafb; }
        h2 { color: #1f2937; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; background: white; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
        th, td { border: 1px solid #e5e7eb; padding: 12px; text-align: left; }
        th { background-color: #2563eb; color: white; }
        .btn { padding: 6px 12px; text-decoration: none; border-radius: 4px; color: white; display: inline-block; font-size: 14px; }
        .btn-add { background: #10b981; margin-bottom: 15px; }
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
        <?php if (!empty($students)): ?>
            <?php foreach($students as $row): ?>
            <tr>
                <td><?= htmlspecialchars($row['id']); ?></td>
                <td><?= htmlspecialchars($row['name']); ?></td>
                <td><?= htmlspecialchars($row['email']); ?></td>
                <td><?= htmlspecialchars($row['track']); ?></td>
                <td>
                    <a href="student_edit.php?id=<?= $row['id']; ?>" class="btn btn-edit">Edit</a>
                    <a href="student_list.php?delete=<?= $row['id']; ?>" class="btn btn-delete" onclick="return confirm('តើអ្នកពិតជាចង់លុបមែនទេ?')">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" style="text-align: center; color: #6b7280;">មិនមានទិន្នន័យសិស្សទេ</td>
            </tr>
        <?php endif; ?>
    </table>

</body>
</html>


